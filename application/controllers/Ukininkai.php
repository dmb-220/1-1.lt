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
 * ************************ MODELS *****************************
 * @property Pasarai_model      $pasarai_model      Pasarai models
 * @property Paseliai_model     $paseliai_model     Paseliai models
 * @property Ukininkai_model    $ukininkai_model    Ukininkai models
 * @property Gyvuliai_model     $gyvuliai_model     Gyvuliai models
 * @property Ion_auth_model     $ion_auth_model     Ion_Auth models
 * @property Main_model         $main_model         Main models
 * @property Admin_model        $admin_model        Admin models
 * ************************* LIBRARY ****************************
 * @property Ion_auth           $ion_auth           Ion_auth library
 */

class Ukininkai extends CI_Controller {

    public function __construct(){
        parent::__construct();
        error_reporting(E_ERROR);
        $this->load->library('Ion_auth');
        if (!$this->ion_auth->logged_in()) {
        redirect('main/auth_error');
        }
    }

    public function index()
    {
        $this->load->view("main_view");
    }

    public function sarasas_ukininku(){
        $this->load->library('table');
        $this->load->model('ukininkai_model');
        $data = $this->ukininkai_model->ukininku_sarasas();
        $this->load->view("main_view", array('data'=> $data));
    }


    public function prideti_ukininka(){
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('vardas', 'Vardas', 'required',  array('required' => 'Įveskite vardą.'));
        $this->form_validation->set_rules('pavarde', 'Pavardė', 'required', array('required' => 'Įveskite pavardę.'));
        $this->form_validation->set_rules('v_vardas', 'Vartotojo vardas', 'required', array('required' => 'Įveskite vartotojo vardą.'));
        $this->form_validation->set_rules('slaptazodis', 'Slaptazodis', 'required', array('required' => 'Įveskite slaptazodi.'));
        $this->form_validation->set_rules('valdos_nr', 'Valdos numeris', 'required|is_natural',
            array('required' => 'Įveskite valdos numerį.', 'is_natural' => 'Valdos numeris tik skaiciai.'));

        if ($this->form_validation->run() == FALSE) {
            $data['action'] = "";} else {
            $vardas = $_POST['vardas'];
            $pavarde = $_POST['pavarde'];
            $valdos_nr = $_POST['valdos_nr'];
            $v_vardas = $_POST['v_vardas'];
            $slaptazodis = $_POST['slaptazodis'];

            $this->load->model('ukininkai_model');
            $ok = $this->ukininkai_model->tikinti_ukininka($valdos_nr);
            if($ok>0){
                $data['action'] = "YRA";
            }else{
                $this->ukininkai_model->irasyti_ukininka($vardas,$pavarde, $valdos_nr, $v_vardas, $slaptazodis );
            $data['action'] = "OK";}
        }


        $this->load->view("main_view", $data);
    }
}

?>
