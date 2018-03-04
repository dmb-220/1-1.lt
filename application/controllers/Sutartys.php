<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ************************ CONTROLLERS ************************
 * @property Pasarai            $pasarai            Pasarai controller
 * @property Paseliai           $paseliai           Paseliai controller
 * @property Ukininkai          $ukininkai          Ukininkai controller
 * @property Galvijai           $galvijai           Galvijai controller
 * @property Sutartys           $sutartys           Sutartys controller
 * @property Auth               $auth               Auth controller
 * @property Main               $main               Main controller
 * @property Admin              $admin              Admin controller
 * ************************ MODELS *****************************
 * @property Pasarai_model      $pasarai_model      Pasarai models
 * @property Paseliai_model     $paseliai_model     Paseliai models
 * @property Ukininkai_model    $ukininkai_model    Ukininkai models
 * @property Galvijai_model     $galvijai_model     Galvijai models
 * @property Ion_auth_model     $ion_auth_model     Ion_Auth models
 * @property Main_model         $main_model         Main models
 * @property Admin_model        $admin_model        Admin models
 * @property Sutartys_model     $sutartys_model     Sutartys models
 * ************************* LIBRARY ****************************
 * @property Ion_auth           $ion_auth           Ion_auth library
 */
class Sutartys extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ERROR | E_WARNING | E_PARSE);

        //uzkraunam MODEL
        $this->load->model('ukininkai_model');
        $this->load->model('galvijai_model');
        $this->load->model('sutartys_model');
        $this->load->model('main_model');

        //$this->load->library('linksniai');

        if (!$this->ion_auth->logged_in()) {
            redirect('main/auth_error');
        }
    }

    //jei kas bandys atidaryti index puslapi bus nukreiptas i pagrindini
    public function index()
    {
        redirect('main');
    }

    //Pagrindinis visos svetaines puslapis
    public function pasirinkti_ukininka(){
        //echo'MATAu'; die;
        $ukininkas = $this->uri->segment(3);
            $uk = $this->ukininkai_model->ukininkas($ukininkas);
            $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
            $this->session->set_userdata($new);
            $this->session->set_flashdata('message', 'Ūkininkas pasirinktas: '.$uk[0]['vardas'].' '.$uk[0]['pavarde'].' !');

        redirect('sutartys/skaitciuokle');
    }

    public function sutarciu_sarasas(){
        $this->main_model->info['sarasas'] = $this->sutartys_model->sutarciu_sarasas();
        //var_dump($this->main_model->info['sarasas']); die;

        $this->main_model->info['txt']['meniu'] = "Sutartys";
        $this->main_model->info['txt']['info'] = "Sarasas";

        $this->load->view("main_view");
    }

    public function perziureti(){
        $action = $this->uri->segment(3);
        $duomenys = $this->sutartys_model->ukininko_sutartis(1, $action);
        $this->main_model->info['sutartis'] = $duomenys;

        $this->main_model->info['txt']['meniu'] = "Sutartys";
        $this->main_model->info['txt']['info'] = "Peržiūrėti";

        $this->load->view("main_view");
    }

    public function istrinti(){
        $action = $this->uri->segment(3);
        if($this->sutartys_model->istrinti_sutarti(1, $action)){
            $this->session->set_flashdata('message', "Ūkininko sutartis sėkmingai istrinta!");
        }else{
            $this->session->set_flashdata('message', "Ūkininko sutarties ištrinti nepavyko, praneškite admininstracijai!");
        }
        redirect('sutartys/sutarciu_sarasas');
    }

    public function kainos(){
        $jsonString = file_get_contents('https://1-1.lt/assets/js/kainos.json');
        $data = json_decode($jsonString, true);
        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Sutartys";
        $this->main_model->info['txt']['info'] = "Skaičiuoklės kainos";

        $this->load->view('main_view', array("data" => $data));
    }


    public function formuoti(){
        $data = $this->input->post();

        $dt = $this->session->userdata();
        $sutartis = serialize($data);

        $numeris = "ALU ".date('Y')."-".$this->sutartys_model->sutarties_nr();
        //jis reiskia kad tai paslaugu teikimo sutartis
        $ids = 1;
        $this->main_model->info['txt']['numeris'] = $numeris;
        $this->main_model->info['txt']['data'] = "2018-01-01";
        $this->main_model->info['ukininkas'] = $this->ukininkai_model->ukininkas($data['ukininkas']);
        ///var_dump($this->sutartys_model->tikrinti_sutarti($data['ukininkas'], $ids)); die;
        if($this->sutartys_model->tikrinti_sutarti($data['ukininkas'], $ids) > 0){
            $this->session->set_flashdata('message', 'Ūkininko sutartis jau įtraukta į duomenų bazę! jei notite per naują suformatuoti sutartį, galite ištrinti, jas rasite SUTARČIŲ SĄRAŠAS');
            //var_dump($this->session->flashdata('message')); die;
            redirect('sutartys/skaitciuokle');
        }else{
            //sita perkelti kai nuspaudziamas myktukas issaugoti
            $dat = array('sutarties_id' => $ids , 'sutartis' => $sutartis , 'numeris' => $numeris, 'u_id' => $data['ukininkas'], "data" => $this->main_model->info['txt']['data']);
            $this->sutartys_model->sutartis_irasyti($dat);
        }

        //var_dump(unserialize($sutartis)); exit;
        $info_uk = $this->ukininkai_model->ukininkas($dt['nr']);
        $this->main_model->info['txt']['ukis'] = $info_uk[0]['ukio_tipas'];

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Sutartys";
        $this->main_model->info['txt']['info'] = "Skaičiuoklės galutinis rezultatas";


        $this->load->view('main_view', array('data' => $data));
    }

    public function skaitciuokle(){
        $this->load->model('paseliai_model');

        $galviju = array(
            array("kodas" => "U0", "kiekis" => 10),
            array("kodas" => "U1", "kiekis" => 30),
            array("kodas" => "U2", "kiekis" => 60),
            array("kodas" => "U3", "kiekis" => 90),
            array("kodas" => "U4", "kiekis" => 120),
            array("kodas" => "U5", "kiekis" => 150),
            array("kodas" => "U6", "kiekis" => 180),
            array("kodas" => "U7", "kiekis" => 210),
            array("kodas" => "U8", "kiekis" => 240),
            array("kodas" => "U9", "kiekis" => 270),
            array("kodas" => "U10", "kiekis" => 300),
            array("kodas" => "U11", "kiekis" => 350),
            array("kodas" => "U12", "kiekis" => 400),
            array("kodas" => "U13", "kiekis" => 450),
            array("kodas" => "U14", "kiekis" => 500),
            array("kodas" => "U15", "kiekis" => 750),
        );
        $ploto = array(
            array("kodas" => "A0", "kiekis" => 5),
            array("kodas" => "A1", "kiekis" => 10),
            array("kodas" => "A2", "kiekis" => 15),
            array("kodas" => "A3", "kiekis" => 20),
            array("kodas" => "A4", "kiekis" => 25),
            array("kodas" => "A5", "kiekis" => 30),
            array("kodas" => "A6", "kiekis" => 35),
            array("kodas" => "A7", "kiekis" => 40),
            array("kodas" => "A8", "kiekis" => 50),
            array("kodas" => "A9", "kiekis" => 75),
            array("kodas" => "A10", "kiekis" => 100),
            array("kodas" => "A11", "kiekis" => 150),
            array("kodas" => "A12", "kiekis" => 200),
            array("kodas" => "A13", "kiekis" => 250),
            array("kodas" => "A14", "kiekis" => 300),
            array("kodas" => "A15", "kiekis" => 500),
        );

        $numeris = "ALU ".date('Y')."-".$this->sutartys_model->sutarties_nr();
        $this->main_model->info['txt']['numeris'] = $numeris;

        $dt = $this->session->userdata();
        if($dt['nr'] == ""){
            $this->main_model->info['error']['login'] = "Norėdami pradėti darbus, Pasirinkite ūkininką su kuriuo dirbsite!";
        }else {
            //suskaiciuoti deklaruojama plota
            //metus sutvarkyti, kad paimtu teisingus 2017-10 imtu 2017, o 2018-02 imtu irgi 2017
            $dat = array('ukininkas' => $dt['nr'], 'metai' => '2017');
            $this->main_model->info['txt']['deklaruota']  = $this->sutartys_model->deklaruotas_plotas($dat);
            //suskaiciuoti gyvuliu vidurki
            $this->main_model->info['txt']['vidurkis'] = $this->sutartys_model->galvijai_vidurkis();
            $info_uk = $this->ukininkai_model->ukininkas($dt['nr']);
            $this->main_model->info['txt']['banda'] = $info_uk[0]['banda'];

            $sk_gal = $this->sutartys_model->rasti_skaiciu($galviju, $this->main_model->info['txt']['vidurkis']);
            $sk_plo = $this->sutartys_model->rasti_skaiciu($ploto, $this->main_model->info['txt']['deklaruota']);

            $suma = $this->sutartys_model->sutarties_suma($dt['nr'], "2017");

            $this->main_model->info['txt']['ukis'] = $info_uk[0]['ukio_tipas'];
            $this->main_model->info['txt']['galvijai'] = $sk_gal;
            $this->main_model->info['txt']['plotas'] = $sk_plo;
            $this->main_model->info['txt']['suma'] = $suma[0];

        }

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Sutartys";
        $this->main_model->info['txt']['info'] = "Sutarties paruošimas";

        $user = $this->ion_auth->user()->row();
        //Nuskaitom ukininku sarasa, kad butu visada po ranka
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas( $user->id, TRUE);

        $this->load->view('main_view');
    }

    public function darbo_sutartis(){
        //$this->load->library('word');

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Sutartys";
        $this->main_model->info['txt']['info'] = "Darbo sutartis";

        $this->load->view('main_view', array('data' => $data));
    }

    public function sutartys(){
        $dt = $this->session->userdata();
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required', array('required' => 'Pasirinkite ūkininką.'));
        $this->form_validation->set_rules('numeris', 'Suterties numeris', 'required', array('required' => 'Įveskite sutarties numerį'));

        if ($this->form_validation->run()) {
            $ukininkas = $this->input->post('ukininko_vardas');
            $numeris = $this->input->post('numeris');
            $uk = $this->ukininkai_model->ukininkas($ukininkas);

            $this->main_model->info['txt']['vardas'] = $uk[0]['vardas'];
            $this->main_model->info['txt']['pavarde'] = $uk[0]['pavarde'];
            $this->main_model->info['txt']['asmens_kodas'] = $uk[0]['asmens_kodas'];
            $this->main_model->info['txt']['data'] = "2017-01-01";
            $this->main_model->info['txt']['numeris'] = $numeris;

            $suma = $this->sutartys_model->sutarties_suma($ukininkas, "2017");
            $this->main_model->info['txt']['suma'] = $suma[0];

            $this->main_model->info['ukininkas'] = $this->ukininkai_model->ukininkas($ukininkas);

            $this->main_model->info['error']['action'] = true;
        }

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Sutartys";
        $this->main_model->info['txt']['info'] = "Sutikimas dėl duomenų naudojimo";

        $user = $this->ion_auth->user()->row();
        //Nuskaitom ukininku sarasa, kad butu visada po ranka
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas( $user->id, TRUE);
        $this->load->view('main_view');
    }

}