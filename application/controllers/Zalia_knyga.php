<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ************************ CONTROLLERS ************************
 * @property Pasarai            $pasarai            Pasarai controller
 * @property Paseliai           $paseliai           Paseliai controller
 * @property Ukininkai          $ukininkai          Ukininkai controller
 * @property Galvijai           $galvijai           Galvijai controller
 * @property Auth               $auth               Auth controller
 * @property Main               $main               Main controller
 * @property Admin              $admin              Admin controller
 * @property Zalia_knyga        $zalia_knyga        Zalia knyga controller
 * ************************ MODELS *****************************
 * @property Pasarai_model      $pasarai_model      Pasarai models
 * @property Paseliai_model     $paseliai_model     Paseliai models
 * @property Ukininkai_model    $ukininkai_model    Ukininkai models
 * @property Galvijai_model     $galvijai_model     Galvijai models
 * @property Ion_auth_model     $ion_auth_model     Ion_Auth models
 * @property Main_model         $main_model         Main models
 * @property Admin_model        $admin_model        Admin models
 * @property Zalia_knyga_model  $zalia_knyga_model  Zalia knyga model
 * ************************* LIBRARY ****************************
 * @property Ion_auth           $ion_auth           Ion_auth library
 */
class Zalia_knyga extends CI_Controller{

    public function __construct(){
        parent::__construct();
        //Užkraunam reikalingus
        //MODEL
        $this->load->model('ukininkai_model');
        $this->load->model('zalia_knyga_model');
        //LIBRARY
        $this->load->library('linksniai');
        $this->load->library('form_validation');
        //klaidu rodymas
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        //turinys rodomas tik prisijungusiems
        if(!$this->ion_auth->logged_in() OR !$this->ion_auth->is_admin()) {
            redirect('main/auth_error');
        }

    }

    public function knyga(){
        $error = array();
        $dt = $this->session->userdata();

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($dt['vardas'] == "" AND $dt['pavarde'] == "") {
            $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required', array('required' => 'Pasirinkite ūkininką.'));
            $ukininkas = $_POST['ukininko_vardas'];
            $this->load->model('ukininkai_model');
            $uk = $this->ukininkai_model->ukininkas($ukininkas);
            $inf['vardas'] = $uk[0]['vardas'];
            $inf['pavarde'] = $uk[0]['pavarde'];
            $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
            $this->session->set_userdata($new);
        } else {
            $ukininkas = $dt['nr'];
            $inf['vardas'] = $dt['vardas'];
            $inf['pavarde'] = $dt['pavarde'];
        }

        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
        $this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

        if ($this->form_validation->run()) {
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');

            $inf['metai'] = $metai;
            $inf['menesis'] = $menesis;

            //rasomas kodas


            $error['action'] = TRUE;
        }else{
            $inf['menesis'] = date('m');
            $inf['metai'] = date('Y');
        }

        //nuskaitom irasus is zaliosios knygos
        $da = array(
            "u_id" => $ukininkas,
            "metai" => $inf['metai'],
            "menesis" => $inf['menesis'],
        );
        $irasai = $this->zalia_knyga_model->nuskaityti_knyga($da);

        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Žalioji knyga";
        $inf['active'] = "Pagrindinis";

        $data = $this->ukininkai_model->ukininku_sarasas();
        $inf['pvm'] = $this->zalia_knyga_model->nuskaityti_pvm();
        $inf['organizacijos'] = $this->zalia_knyga_model->nuskaityti_organizacijas();

        $this->load->view("main_view", array('data'=> $data, 'error' => $error, 'inf' => $inf, 'irasai' => $irasai));
    }

    public function naujas_irasas(){
        $this->form_validation->set_rules('data', 'Pasirinkite datą', 'required', array('required' => 'Pasirinkite dieną.'));
        $this->form_validation->set_rules('operacija', 'Operacija', 'required', array('required' => 'Pasirinkite atliekama operaciją'));
        $this->form_validation->set_rules('kiekis', 'Kiekis', 'is_natural|required', array('is_natural' => 'Kiekis gali būti įvestas tik, skaičiai',
            'required' => 'Kiekis privalo buti įvestas'));
        $this->form_validation->set_rules('vnt', 'Mato vienetas', 'required', array('required' => 'Pasirinkite mato vienetą'));
        $this->form_validation->set_rules('verte', 'Vertė', 'required', array('required' => 'Vertė privalo būti įvesta'));

        if ($this->form_validation->run()) {
            $data = $this->input->post('data');
            $operacija = $this->input->post('operacija');
            $kiekis = $this->input->post('kiekis');
            $vnt = $this->input->post('vnt');
            $verte = $this->input->post('verte');

            //issiskaidom data i metai, menesis, diena
            $exp = explode(".", $data);
            $metai = $exp[0];
            $menesis = $exp[1];
            $diena = $exp[2];

            //rasomas kodas, skirtas naujam irasui
            $da = array(
                "u_id" => $this->session->userdata('nr'),
                "metai" => $metai,
                "menesis" => $menesis,
                "diena" => $diena,
                "pvm_id" => $operacija,
                );
            if($this->zalia_knyga_model->tikrinti_irasa($da) > 0){
                $this->session->set_flashdata('irasas_yra', "Toks įrašas jau egzistuoja");
            }else{
                $da = array(
                    "u_id" => $this->session->userdata('nr'),
                    "metai" => $metai,
                    "menesis" => $menesis,
                    "diena" => $diena,
                    "pvm_id" => $operacija,
                    "kiekis" => $kiekis,
                    "mato_vnt" => $vnt,
                    "verte" => $verte,
                );
                $this->zalia_knyga_model->naujas_irasas_knyga($da);
                $this->session->set_flashdata('irasas_ok', "Naujas įrašas įtrauktas į KNYGA");
            }
        }
        redirect('zalia_knyga/knyga');
    }

    public function pvm_irasas(){
        $this->form_validation->set_rules('pavadinimas', 'Operacijos pavadinimas', 'required', array('required' => 'Įrašykite PVM kodą.'));
        $this->form_validation->set_rules('kodas', 'PVM kodas', 'alpha_numeric', array('alpha_numeric' => 'PVM kodas tik iš raidžių ir skaičių'));
        $this->form_validation->set_rules('tarifas', 'PVM tarifas', 'is_natural|max_length[2]', array('is_natural' => 'PVM tarifas gali būti įvestas tik, skaičiai',
            'max_length' => 'PVM tarifas,  Tik du skaiciai'));

        if ($this->form_validation->run()) {
            $kodas = $this->input->post('kodas');
            $tarifas = $this->input->post('tarifas');
            $pavadinimas = $this->input->post('pavadinimas');

            //rasomas kodas
            if($this->zalia_knyga_model->tikrinti_pvm($kodas, $pavadinimas) > 0){
                $this->session->set_flashdata('pvm_yra', "Toks, ".strtoupper($kodas)." tarifas jau YRA");
            }else{
                $this->zalia_knyga_model->naujas_pwm($pavadinimas, $kodas, $tarifas);
                $this->session->set_flashdata('pvm_ok', "Naujas PVM tarifas pridėtas");
            }
        }

        $this->session->set_flashdata('pvm_kodas', form_error('kodas'));
        $this->session->set_flashdata('pvm_tarifas', form_error('tarifas'));

        redirect('zalia_knyga/knyga');
    }

    //siunciama ajax uzklausa del pvm reiksmes
    public function ajax_pvm(){
        $data = array();
        $data = $this->zalia_knyga_model->nuskaityti_pvm($id);
}

}