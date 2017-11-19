<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ************************ CONTROLLERS ************************
 * @property Pasarai            $pasarai            Pasarai controller
 * @property Paseliai           $paseliai           Paseliai controller
 * @property Ukininkai          $ukininkai          Ukininkai controller
 * @property galvijai           $galvijai           galvijai controller
 * @property Auth               $auth               Auth controller
 * @property Main               $main               Main controller
 * @property Admin              $admin              Admin controller
 * ************************ MODELS *****************************
 * @property Pasarai_model      $pasarai_model      Pasarai models
 * @property Paseliai_model     $paseliai_model     Paseliai models
 * @property Ukininkai_model    $ukininkai_model    Ukininkai models
 * @property galvijai_model     $galvijai_model     galvijai models
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
        //uzkraunam MODEL
        $this->load->model('ukininkai_model');
        $this->load->model('galvijai_model');
        $this->load->model('main_model');

        $this->load->library('form_validation');

        $this->load->library('Ion_auth');
        if (!$this->ion_auth->logged_in()) {
        redirect('main/auth_error');
        }
    }

    public function index()
    {
        $this->load->view("main_view");
    }

    public function iban(){
        $action = $this->uri->segment(3);
        //$action = "LT977181700162733511";
        $arr = str_split($action);
        if(count($arr) > 9){
            $arra = $arr[4].$arr[5].$arr[6].$arr[7].$arr[8];
            //echo $arra; die;
            $bankas = $this->ukininkai_model->read_iban($arra);
        }
        $this->load->view('ukininkai/iban_view', array('bankas' => $bankas[0]['pavadinimas']));
    }

    public function redaguoti(){
        $action = $this->uri->segment(3);

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('vardas', 'Vardas', 'required',  array('required' => 'Įveskite vardą.'));
        $this->form_validation->set_rules('pavarde', 'Pavardė', 'required', array('required' => 'Įveskite pavardę.'));
        $this->form_validation->set_rules('vartotojas', 'Vartotojo vardas', 'required', array('required' => 'Įveskite VIC.LT vartotojo vardą.'));
        $this->form_validation->set_rules('asmens_kodas', 'Asmens kodas');
        $this->form_validation->set_rules('adresas', 'Adresas');
        $this->form_validation->set_rules('numeris', 'Saskaitos numeris');
        $this->form_validation->set_rules('bankas', 'Banko pavadinimas');
        $this->form_validation->set_rules('telefonas', 'Telefono numeris');
        $this->form_validation->set_rules('pvm', 'PVM kodas');


        if ($this->form_validation->run()) {
            $vardas = $this->input->post('vardas');
            $pavarde = $this->input->post('pavarde');
            $vartotojas = $this->input->post('vartotojas');
            $slaptazodis = $this->input->post('slaptazodis');

            $asmens_kodas = $this->input->post('asmens_kodas');
            $adresas = $this->input->post('adresas');
            $numeris = $this->input->post('numeris');
            $bankas = $this->input->post('bankas',TRUE);
            $email = $this->input->post('email');
            $telefonas = $this->input->post('telefonas');
            $pvm = $this->input->post('pvm');
            $banda = $this->input->post('banda');

            $ok = $this->ukininkai_model->tikinti_ukininka($action);
            if($ok>0){
                $data = array('vardas' => $vardas, 'pavarde' => $pavarde, 'VIC_vartotojo_vardas' => $vartotojas, 'VIC_slaptazodis' => $slaptazodis,
                    'asmens_kodas' => $asmens_kodas, 'adresas' => $adresas, 'saskaitos_nr' => $numeris, 'bankas' => $bankas, 'email' => $email,
                    'telefonas' => $telefonas, 'pvm_kodas' => $pvm, 'banda' => $banda);
                $this->ukininkai_model->atnaujinti_ukininka($action, $data);
                $this->main_model->info['error']['ok'] = "Ūkininko duomenys atnaujinti!";
            }else{
                $this->main_model->info['error']['nerasta'] = "Ūkininkas nerastas!";
            }
        }
        $banda = $this->ukininkai_model->ukininkas($action);
        $this->main_model->info['txt']['banda'] = $banda[0]['banda'];

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Ūkininkai";
        $this->main_model->info['txt']['info'] = "Redaguoti ūkininko informaciją";

        $this->main_model->info['ukininkas'] = $this->ukininkai_model->ukininkas($action);
        $this->load->view("main_view");
    }

    public function sarasas_ukininku(){
        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Ūkininkai";
        $this->main_model->info['txt']['info'] = "Ūkininkų sąrašas";
        $user = $this->ion_auth->user()->row();
        //Nuskaitom ukininku sarasa, kad butu visada po ranka
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas( $user->id, TRUE);
        $this->load->view("main_view");
    }


    public function prideti_ukininka(){

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('vardas', 'Vardas', 'required',  array('required' => 'Įveskite vardą.'));
        $this->form_validation->set_rules('pavarde', 'Pavardė', 'required', array('required' => 'Įveskite pavardę.'));
        $this->form_validation->set_rules('v_vardas', 'Vartotojo vardas', 'required', array('required' => 'Įveskite vartotojo vardą.'));
        $this->form_validation->set_rules('slaptazodis', 'Slaptazodis', 'required', array('required' => 'Įveskite slaptazodi.'));
        $this->form_validation->set_rules('valdos_nr', 'Valdos numeris', 'required|is_natural',
            array('required' => 'Įveskite valdos numerį.', 'is_natural' => 'Valdos numeris tik skaiciai.'));
        $this->form_validation->set_rules('banda', 'Galviju banda', 'required',  array('required' => 'pasirinkite galvij7 bandos tipą.'));

        if ($this->form_validation->run()) {
            $vardas = $this->input->post('vardas');
            $pavarde = $this->input->post('pavarde');
            $valdos_nr = $this->input->post('valdos_nr');
            $v_vardas = $this->input->post('v_vardas');
            $slaptazodis = $this->input->post('slaptazodis');
            $banda = $this->input->post('banda');

            $user = $this->ion_auth->user()->row();

            $ok = $this->ukininkai_model->tikinti_ukininka($valdos_nr);
            if($ok>0){
                $this->main_model->info['error']['yra'] = "TOKS ukininkas jau yra!";
            }else{
                $duomenys = array('vardas' => $vardas , 'pavarde' => $pavarde , 'valdos_nr' => $valdos_nr,
                    'VIC_vartotojo_vardas' => $v_vardas, 'VIC_slaptazodis' => $slaptazodis, 'banda' => $banda, 'user_id' => $user->id,
                );
                $this->ukininkai_model->irasyti_ukininka($duomenys);
                $this->main_model->info['error']['ok'] = "Naujas ukininkas pridetas!";}

            $this->main_model->info['error']['action'] = true;
        }

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Ūkininkai";
        $this->main_model->info['txt']['info'] = "Naujas ūkininkas";

        $this->load->view("main_view");
    }
}

?>
