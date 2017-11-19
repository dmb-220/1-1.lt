<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ************************ CONTROLLERS ************************
 * @property Pasarai            $pasarai            Pasarai controller
 * @property Paseliai           $paseliai           Paseliai controller
 * @property Ukininkai          $ukininkai          Ukininkai controller
 * @property Galvijai           $galvijai           galvijai controller
 * @property Auth               $auth               Auth controller
 * @property Main               $main               Main controller
 * @property Admin              $admin              Admin controller
 * ************************ MODELS *****************************
 * @property Pasarai_model      $pasarai_model      Pasarai models
 * @property Paseliai_model     $paseliai_model     Paseliai models
 * @property Ukininkai_model    $ukininkai_model    Ukininkai models
 * @property Galvijai_model     $galvijai_model     galvijai models
 * @property Ion_auth_model     $ion_auth_model     Ion_Auth models
 * @property Main_model         $main_model         Main models
 * @property Admin_model        $admin_model        Admin models
 * ************************* LIBRARY ****************************
 * @property Ion_auth           $ion_auth           Ion_auth library
 */
class Paseliai extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ERROR | E_WARNING | E_PARSE);

        $this->load->model('paseliai_model');

        $this->load->library('form_validation');
        $this->load->library('linksniai');

        $this->load->library('Ion_auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('main/auth_error');
        }
    }

    public function paseliai(){

        $this->load->library("pagination");

        $config = array();
        $config["base_url"] = base_url() . "paseliai/paseliai";
        $config["total_rows"] = $this->paseliai_model->paseliai_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        //$choice = $config["total_rows"] / $config["per_page"];
        //$config["num_links"] = round($choice);

        $config['first_link'] = 'Pirmas';
        $config['last_link'] = 'Paskutinis';

        /* This Application Must Be Used With BootStrap 3 *  */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);
        //$dat = array('sekla !=' => "", 'derlius !=' => "");
        //$duom = $this->paseliai_model->nuskaityti_paselius($dat);
        $data = array();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->paseliai_model->paseliai_limit($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Pasėliai";
        $this->main_model->info['txt']['info'] = "Pasėlių sąrašas";

        $this->load->view("main_view", array('data' => $data));
    }

    public function redaguoti_kodas(){

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Pasėliai";
        $this->main_model->info['txt']['info'] = "Redaguoti pasėlių reikšmes";

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $action = $this->uri->segment(3);
        //surandam ir isvadam reiksmes redagavimui
        if($action == "read") {
            $dek = array();
            $this->form_validation->set_rules('kodas', 'Pasėlio kodas', 'required', array('required' => 'Įveskite pasėlio kodą.'));

            if ($this->form_validation->run()) {
                $kodas = $this->input->post('kodas');
                //tikrinam ar duomenu bazeje nera tokio paselio, nes naujai ivedamas
                $dek = $this->paseliai_model->nuskaityti_pavadinima(strtoupper($kodas));
                if (count($dek) == 0) {
                    $this->main_model->info['error']['jau_yra'] = "Kodo ".strtoupper($kodas).", nera duomenų bazėje!";
                }else{
                    $this->main_model->info['error']['action'] = TRUE;}
                }
            if($this->uri->segment(4)){
                $kodas = urldecode ($this->uri->segment(4));
                $kodas = urldecode($kodas);
                //tikrinam ar duomenu bazeje nera tokio paselio, nes naujai ivedamas
                $dek = $this->paseliai_model->nuskaityti_pavadinima(strtoupper($kodas));
                if (count($dek) == 0) {
                    $this->main_model->info['error']['jau_yra'] = "Kodo ".strtoupper($kodas).", nera duomenų bazėje!!!";
                }else{
                    $this->main_model->info['error']['action'] = TRUE;}
            }
            //sukeliam info, informaciniam meniu
            $this->main_model->info['txt']['meniu'] = "Pasėliai";
            $this->main_model->info['txt']['info'] = "Redaguoti pasėlių reikšmes";

            $this->load->view("main_view", array('dek' => $dek[0]));
        }
        if($action == "save"){
            //$this->form_validation->set_rules('sutrumpinimas', 'Pasėlio kodas', 'required', array('required' => 'Įveskite pasėlio kodą.'));
            $this->form_validation->set_rules('pavadinimas', 'Pasėlio pavadinimas', 'required', array('required' => 'Įveskite pasėlio pavadinimą'));
            $this->form_validation->set_rules('sekla', 'Seklos kiekis', 'required', array('required' => 'Įveskite sėklos kieki, 1 ha.!'));
            $this->form_validation->set_rules('derlius', 'Derliaus kiekis', 'required', array('required' => 'Įveskite derliaus kieki, iš 1 ha.!'));

            if ($this->form_validation->run()) {
                $kodas = $this->input->post('sutrumpinimas');
                $pavadinimas = $this->input->post('pavadinimas');
                $sekla = $this->input->post('sekla');
                $derlius = $this->input->post('derlius');
                //$dek['sutrumpinimas'] = strtoupper($kodas);
                $dek['pavadinimas'] = $pavadinimas;
                $dek['sekla'] = $sekla;
                $dek['derlius'] = $derlius;
                $this->paseliai_model->atnaujinti_paselius($dek, strtoupper($kodas));
                $this->main_model->info['error']['ok'] = "Kodo " . strtoupper($kodas) . ", duomenys atnaujinti!";
            }else{
                //jei nesuvede duomenu reik nukreipti i ta pati puslapi ir nusiusti vel redagavimui tuos pacius duomenis
                $this->main_model->info['error']['klaida'] = "Neįvedėte duomenų!";
            }
            //issaugojam pakeistas reiksmes
            $this->load->view("main_view");
        }

        if($action == ""){
            //uzkraunam tik paieska
            $this->load->view("main_view");
        }
    }

    public function naujas_kodas(){
        $dek = array();

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('kodas', 'Pasėlio kodas', 'required', array('required' => 'Įveskite pasėlio kodą.'));
        $this->form_validation->set_rules('pavadinimas', 'Pasėlio pavadinimas', 'required', array('required' => 'Įveskite pasėlio pavadinimą'));
        $this->form_validation->set_rules('sekla', 'Seklos kiekis', 'required', array('required' => 'Įveskite sėklos kieki, 1 ha.!'));
        $this->form_validation->set_rules('derlius', 'derliaus kiekis', 'required', array('required' => 'Įveskite derliaus kieki, iš 1 ha.!'));

        if ($this->form_validation->run()) {
            $kodas = $this->input->post('kodas');
            $pavadinimas = $this->input->post('pavadinimas');
            $sekla = $this->input->post('sekla');
            $derlius = $this->input->post('derlius');
            //tikrinam ar duomenu bazeje nera tokio paselio, nes naujai ivedamas
                $kk = $this->paseliai_model->tikrinti_koda(strtoupper($kodas));
                if ($kk == 0) {
                    $dek['sutrumpinimas'] = strtoupper($kodas);
                    $dek['pavadinimas'] = $pavadinimas;
                    $dek['sekla'] = $sekla;
                    $dek['derlius'] = $derlius;

                    $this->paseliai_model->irasyti_paseli($dek);
                    $this->main_model->info['error']['ok'] = "Kodas " . strtoupper($kodas) . ", pavadinimas " . $pavadinimas . " įkeltas i duomenų bazę!";
                } else {
                    $this->main_model->info['error']['jau_yra'] = "Kodas " . strtoupper($kodas) . ", jau yra duomenų bazėje! Jei norite pakeisti reikšmes, galite redaguoti";
                }
        }
        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Pasėliai";
        $this->main_model->info['txt']['info'] = "Įtraukti naujus pasėlius";

        $this->load->view("main_view");
    }

    public function rankinis_paselius(){
        //kintamieji
        $da = array(
            'pavadinimas' => "",
            'plotas' => 0,
            'sekla' => array('min' => 0, 'vid' => 0, 'max' => 0,),
            'derlius' => array('min' => 0, 'vid' => 0, 'max' => 0,),
        );


        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('vardas', 'Įveskite vardą', 'required', array('required' => 'Įveskite ūkininko vardą'));
        $this->form_validation->set_rules('pavarde', 'Įveskite pavardę', 'required', array('required' => 'Įveskite ūkininko pavardę!'));

        $dek = array();
        if ($this->form_validation->run()) {
            $vardas = $this->input->post('vardas');
            $pavarde = $this->input->post('pavarde');

            $this->main_model->info['txt']['vardas'] = $vardas;
            $this->main_model->info['txt']['pavarde'] = $pavarde;
            $this->main_model->info['txt']['metai'] = "2017";

            $kodas = $this->input->post('kodas');
            $plotas = $this->input->post('plotas');
            //sudedam duomenis is laukeliu i masyva ir paduodam apduroti
            for($x=0; $x<count($kodas); $x++) {
                if ($kodas[$x]) {
                    $kk = $this->paseliai_model->nuskaityti_pavadinima(strtoupper($kodas[$x]));
                    $dek[$x]['kodas'] = strtoupper($kodas[$x]);
                    if ($plotas[$x]) {
                        $dek[$x]['plotas'] = $plotas[$x];
                    } else {
                        $dek[$x]['plotas'] = "Neįvestas plotas!";
                        $this->main_model->info['error']['plotas'] = "Neįvestas plotas, kodui ".strtoupper($kodas[$x]);
                    }
                    if ($kk[0]['pavadinimas']) {
                        $dek[$x]['pavadinimas'] = $kk[0]['pavadinimas'];
                    } else {
                        $dek[$x]['pavadinimas'] = "Kodas nerastas duomenu bazėje";
                        $this->main_model->info['error']['kodas'] = "Nerastas pavadinimas, kodui ".strtoupper($kodas[$x]);
                    }
                }
            }

            //sukuriamas masyvas, jis bus sukuriamas pagal deklaracijos duomenis
            $da = array();
            foreach($dek as $row){
                //$da['viso']['plotas'] += $row['plotas'];
                if($da[$row['kodas']]['pavadinimas'] !=""){
                    $da[$row['kodas']]['plotas'] += $row['plotas'];
                }else{
                    $da[$row['kodas']]['plotas'] += $row['plotas'];
                    $da[$row['kodas']]['pavadinimas'] = $row['pavadinimas'];
                }
            }
            //$da['viso']['pavadinimas'] = "Viso";

            ////////////// reikia padaryti kad skaiciuotu derliu MIN, VID, ir MAX ///////////////////
            foreach($da as $key => $ro){
                //nuskaitom seklas kiek i 1 ha
                $dat = array('sutrumpinimas' =>  $key);
                $de = $this->paseliai_model->nuskaityti_paselius($dat);
                if(!empty($de[0]['sekla'])){
                    if (strstr($de[0]['sekla'], '-')) {
                        $sie = explode("-", $de[0]['sekla']);
                        $min = $sie[0];
                        $vid = ($sie[0] + $sie[1]) / 2;
                        $max = $sie[1];
                    } else {
                        $vid = $max = $min = $de[0]['sekla'];
                    }
                    $da[$key]['sekla']['min'] = $min * $da[$key]['plotas'];
                    $da[$key]['sekla']['vid'] = $vid * $da[$key]['plotas'];
                    $da[$key]['sekla']['max'] = $max * $da[$key]['plotas'];
                }

                if(!empty($de[0]['derlius'])){
                    if (strstr($de[0]['derlius'], '-')) {
                        $sie = explode("-", $de[0]['derlius']);
                        $min = $sie[0];
                        $vid = ($sie[0] + $sie[1]) / 2;
                        $max = $sie[1];
                    } else {
                        $vid = $max = $min = $de[0]['derlius'];
                    }
                    $da[$key]['derlius']['min'] = $min * $da[$key]['plotas'];
                    $da[$key]['derlius']['vid'] = $vid * $da[$key]['plotas'];
                    $da[$key]['derlius']['max'] = $max * $da[$key]['plotas'];
                }

            }

            $this->main_model->info['error']['action'] = TRUE;
        }
        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Pasėliai";
        $this->main_model->info['txt']['info'] = "Rankinis pasėlių skaičiavimas";

        $this->load->view("main_view", array('da' => $da));
    }

    public function skaiciuoti_paselius(){
        $this->load->model('ukininkai_model');
        //kintamieji
        $da = array(
            'pavadinimas' => "",
            'plotas' => 0,
            'sekla' => array('min' => 0, 'vid' => 0, 'max' => 0,),
            'derlius' => array('min' => 0, 'vid' => 0, 'max' => 0,),
        );

        $dt = $this->session->userdata();

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if($dt['vardas'] == "" AND $dt['pavarde'] == "") {
            $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required',  array('required' => 'Pasirinkite ūkininką.'));
            $ukininkas = $this->input->post('ukininko_vardas');
            $uk = $this->ukininkai_model->ukininkas($ukininkas);
            $this->main_model->info['txt']['vardas'] = $uk[0]['vardas'];
            $this->main_model->info['txt']['pavarde'] = $uk[0]['pavarde'];
            $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
            $this->session->set_userdata($new);
        }else{
            $ukininkas = $dt['nr'];
            $this->main_model->info['txt']['vardas'] = $dt['vardas'];
            $this->main_model->info['txt']['pavarde'] = $dt['pavarde'];
        }
        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));

        if ($this->form_validation->run()) {
            $metai = $this->input->post('metai');

            $this->main_model->info['txt']['metai'] = $metai;

            //reik nuskaityti ukininko deklaracija ir apskaiciuoti kiek suseta
            $dat = array('ukininkas' => $ukininkas, 'metai' => $metai);
            $dek = $this->paseliai_model->nuskaityti_deklaracija($dat);
            //sukuriamas masyvas, jis bus sukuriamas pagal deklaracijos duomenis
            $da = array();
            foreach($dek as $row){
                //$da['viso']['plotas'] += $row['plotas'];
                if($da[$row['kodas']]['pavadinimas'] !=""){
                $da[$row['kodas']]['plotas'] += $row['plotas'];
                }else{
                    $da[$row['kodas']]['plotas'] += $row['plotas'];
                    $da[$row['kodas']]['pavadinimas'] = $row['pavadinimas'];
                }
            }
            //$da['viso']['pavadinimas'] = "Viso";

            ////////////// reikia padaryti kad skaiciuotu derliu MIN, VID, ir MAX ///////////////////
            foreach($da as $key => $ro){
            //nuskaitom seklas kiek i 1 ha
            $dat = array('sutrumpinimas' =>  $key);
            $de = $this->paseliai_model->nuskaityti_paselius($dat);
                if(!empty($de[0]['sekla'])){
                    if (strstr($de[0]['sekla'], '-')) {
                        $sie = explode("-", $de[0]['sekla']);
                        $min = $sie[0];
                        $vid = ($sie[0] + $sie[1]) / 2;
                        $max = $sie[1];
                    } else {
                        $vid = $max = $min = $de[0]['sekla'];
                    }
                    $da[$key]['sekla']['min'] = $min * $da[$key]['plotas'];
                    $da[$key]['sekla']['vid'] = $vid * $da[$key]['plotas'];
                    $da[$key]['sekla']['max'] = $max * $da[$key]['plotas'];
                }

                if(!empty($de[0]['derlius'])){
                    if (strstr($de[0]['derlius'], '-')) {
                        $sie = explode("-", $de[0]['derlius']);
                        $min = $sie[0];
                        $vid = ($sie[0] + $sie[1]) / 2;
                        $max = $sie[1];
                    } else {
                        $vid = $max = $min = $de[0]['derlius'];
                    }
                    $da[$key]['derlius']['min'] = $min * $da[$key]['plotas'];
                    $da[$key]['derlius']['vid'] = $vid * $da[$key]['plotas'];
                    $da[$key]['derlius']['max'] = $max * $da[$key]['plotas'];
                }
            }
            $this->main_model->info['error']['action'] = TRUE;
        }
        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Pasėliai";
        $this->main_model->info['txt']['info'] = "Pasėlių skaičiavimas";

        $user = $this->ion_auth->user()->row();
        //Nuskaitom ukininku sarasa, kad butu visada po ranka
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas( $user->id, TRUE);
        $this->load->view("main_view", array('da' => $da));
    }



    public function nauji_paseliai(){
        $this->load->model('ukininkai_model');
        $dt = $this->session->userdata();

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if($dt['vardas'] == "" AND $dt['pavarde'] == "") {
            $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required',  array('required' => 'Pasirinkite ūkininką.'));
            $ukininkas = $this->input->post('ukininko_vardas');

            $uk = $this->ukininkai_model->ukininkas($ukininkas);
            $this->main_model->info['txt']['vardas'] = $uk[0]['vardas'];
            $this->main_model->info['txt']['pavarde'] = $uk[0]['pavarde'];
            $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
            $this->session->set_userdata($new);
        }else{
            $ukininkas = $dt['nr'];
            $this->main_model->info['txt']['vardas'] = $dt['vardas'];
            $this->main_model->info['txt']['pavarde'] = $dt['pavarde'];
        }
        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));

        if (empty($_FILES['deklaracija']['name'])) {
            $this->form_validation->set_rules('deklaracija', 'Deklaracija', 'required', array('required' => 'Pasirinkite failą, deklaracija.'));}

        if ($this->form_validation->run()) {
            $metai = $this->input->post('metai');
            $config['upload_path']   = './DATA/';
            $config['allowed_types'] = '*';
            $config['max_size']      = 1024*3;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('deklaracija')) {
                $this->main_model->info['error']['deklaracija'] = $this->upload->display_errors();
            }
            $deklaracija = $this->upload->data();

            //parsinam duomenis is html failu
            $data_de = $this->paseliai_model->deklaracija(base_url().'DATA/'.$deklaracija['file_name']);
            //var_dump($data_de);

            //pasitikrinti ar sito ukininko galvijai jau nera itrauktas i db !!!
            $kiek = $this->paseliai_model->ar_deklaracija_ikelta($metai, $ukininkas);
            if($kiek>0){
                $this->main_model->info['error']['jau_yra'] = $metai.' m., jau esate pridejęs deklaraciją!';
            }else{
                //ikelia duomenis i duomenu baze
                $this->paseliai_model->irasyti_deklaracija($data_de, $ukininkas, $metai);
                $this->main_model->info['error']['OK'] = $metai.' m., deklaracija įtraukta į duomenų bazę!';
            }
            //istrinam panaudotus failus
            unlink('./DATA/'.$deklaracija['file_name']);
        }
        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Pasėliai";
        $this->main_model->info['txt']['info'] = "Deklaracijos įkėlimas";

        $user = $this->ion_auth->user()->row();
        //Nuskaitom ukininku sarasa, kad butu visada po ranka
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas( $user->id, TRUE);
        $this->load->view("main_view");

    }
}
?>
