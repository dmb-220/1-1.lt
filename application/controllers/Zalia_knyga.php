<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ************************ CONTROLLERS ************************
 * @property Pasarai            $pasarai            Pasarai controller
 * @property Paseliai           $paseliai           Paseliai controller
 * @property Ukininkai          $ukininkai          Ukininkai controller
 * @property Gyvuliai           $gyvuliai           Gyvuliai controller
 * @property Auth               $auth               Auth controller
 * @property Main               $main               Main controller
 * @property Admin              $admin              Admin controller
 * @property Zalia_knyga        $zalia_knyga        Zalia knyga controller
 * ************************ MODELS *****************************
 * @property Pasarai_model      $pasarai_model      Pasarai models
 * @property Paseliai_model     $paseliai_model     Paseliai models
 * @property Ukininkai_model    $ukininkai_model    Ukininkai models
 * @property Gyvuliai_model     $gyvuliai_model     Gyvuliai models
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
        $data = array();
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

        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Žalioji knyga";
        $inf['active'] = "Pagrindinis";

        $data = $this->ukininkai_model->ukininku_sarasas();

        $this->load->view("main_view", array('data'=> $data, 'error' => $error, 'inf' => $inf));
    }

    public function naujas_irasas(){

    }

    public function pvm_irasas(){
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('kodas', 'PVM kodas', 'required', array('required' => 'Įrašykite PVM kodą.'));
        $this->form_validation->set_rules('tarifas', 'PVM tarifas', 'required', array('required' => 'Įrašykite PVM tarif1.'));
        $this->form_validation->set_rules('aprasymas', 'PVM aprašymas', 'required', array('required' => 'Įveskite PVM aprašymą.'));
        $this->form_validation->set_rules('pvz', 'Pavyzdžiai', 'required', array('required' => 'Įveskite pavyzdžių.'));

        if ($this->form_validation->run()) {
            $kodas = $this->input->post('kodas');
            $tarifas = $this->input->post('tarifas');
            $aprasymas $this->input->post('aprasymas');
            $pvz = $this->input->post('pvz');


            //rasomas kodas


            $error['action'] = TRUE;
        }
        redirect('zalia_knyga/knyga');
    }
}