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

    public function index(){
        $this->load->view("main_view");
    }

    public function profilis(){
        $action = $this->uri->segment(3);
        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Ūkininkai";
        $this->main_model->info['txt']['info'] = "Ūkininko profilis";

        $this->main_model->info['ukininkas'] = $this->ukininkai_model->ukininkas($action);
        $this->load->view("main_view");
    }

    public function redaguoti(){
        $klaida = FALSE;
        $action = $this->uri->segment(3);

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('vardas', 'Vardas', 'required',  array('required' => 'Įveskite vardą.'));
        $this->form_validation->set_rules('pavarde', 'Pavardė', 'required', array('required' => 'Įveskite pavardę.'));
        $this->form_validation->set_rules('tipas', 'Ūkio tipas', 'required',  array('required' => 'Pasirinkite Ūkio tipą.'));
        $this->form_validation->set_rules('asmens_kodas', 'Asmens kodas');
        $this->form_validation->set_rules('adresas', 'Adresas');
        $this->form_validation->set_rules('numeris', 'Saskaitos numeris');
        $this->form_validation->set_rules('bankas', 'Banko pavadinimas');
        $this->form_validation->set_rules('telefonas', 'Telefono numeris');
        $this->form_validation->set_rules('pvm', 'PVM kodas');


        if ($this->form_validation->run()) {
            //var_dump($this->input->post()); die;
            $vardas = $this->input->post('vardas');
            $pavarde = $this->input->post('pavarde');
            $vic_lt = $this->input->post('vic_lt');
            $vartotojas = $this->input->post('v_vardas');
            $slaptazodis = $this->input->post('slaptazodis');

            $asmens_kodas = $this->input->post('asmens_kodas');
            $adresas = $this->input->post('adresas');
            $numeris = $this->input->post('numeris');
            $bankas = $this->input->post('bankas',TRUE);
            $email = $this->input->post('email');
            $telefonas = $this->input->post('telefonas');
            $pvm = $this->input->post('pvm');

            $tipas = $this->input->post('tipas');
            $banda = $this->input->post('banda');

            //jei ne gyvulininkyste, bandos nera.
            if(!$banda){$banda = 0;}

            //patikrinam, ar pazymeta kad nori ivesti VIC.LT duomenis, jei taip privalo uzpildyti
            if($vic_lt){
                if(!$vartotojas){ $this->main_model->info['error'][] = "Neįvestas VIC.LT vartotojo vardas"; $klaida = TRUE;}
                if(!$slaptazodis){ $this->main_model->info['error'][] = "Neįvestas VIC.LT slaptažodis"; $klaida = TRUE;}
            }
            //patikrina ar pasirinkus gyvulininkyste, butu pasirinkta kokia banda turi
            if($tipas == 0){
                if(!$banda){$this->main_model->info['error'][] = "Pasirinkote GYVULININKYSTĘ, privalote pasirinkti bandą"; $klaida = TRUE;}
            }else{$banda = 0;}
            //patikrinam pagal varda, pavarde ar toks ukininkas neegzistuoja
            $ok = $this->ukininkai_model->tikinti_ukininka($vardas, $pavarde);
            if($ok<1){
                $this->main_model->info['error'][] = "Ūkininkas, ".$vardas." ".$pavarde." nerastas!."; $klaida = TRUE;}

            if(!$klaida){
                $data = array('vardas' => $vardas, 'pavarde' => $pavarde, 'VIC_vartotojo_vardas' => $vartotojas, 'VIC_slaptazodis' => $slaptazodis,
                    'asmens_kodas' => $asmens_kodas, 'adresas' => $adresas, 'saskaitos_nr' => $numeris, 'bankas' => $bankas, 'email' => $email,
                    'telefonas' => $telefonas, 'pvm_kodas' => $pvm, 'ukio_tipas' => $tipas, 'banda' => $banda);
                $this->ukininkai_model->atnaujinti_ukininka($action, $data);
                $this->session->set_flashdata('message', "Ūkininko ".$vardas." ".$pavarde." duomenys atnaujinti!");
                redirect("ukininkai/sarasas_ukininku"); }
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
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas( $user->id);
        $this->load->view("main_view");
    }



    public function prideti_ukininka(){
        $klaida = FALSE;
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('vardas', 'Vardas', 'required',  array('required' => 'Įveskite vardą.'));
        $this->form_validation->set_rules('pavarde', 'Pavardė', 'required', array('required' => 'Įveskite pavardę.'));
        $this->form_validation->set_rules('tipas', 'Ūkio tipas', 'required',  array('required' => 'Pasirinkite Ūkio tipą.'));

        if ($this->form_validation->run()) {
            //var_dump($this->input->post()); die;
            $vardas = $this->input->post('vardas');
            $pavarde = $this->input->post('pavarde');
            //ar pazymetas vic.lt ivesti prisijungimo duomenis
            $vic_lt = $this->input->post('vic_lt');
            $v_vardas = $this->input->post('v_vardas');
            $slaptazodis = $this->input->post('slaptazodis');
            $tipas = $this->input->post('tipas');
            $banda = $this->input->post('banda');
            //papildomi duomenys
            $papildomi = $this->input->post('papildomi');
            $asmens_kodas = $this->input->post('asmens_kodas');
            $pvm = $this->input->post('pvm');
            $adresas = $this->input->post('adresas');
            $numeris = $this->input->post('numeris');
            $bankas = $this->input->post('bankas');
            $email = $this->input->post('email');
            $telefonas = $this->input->post('telefonas');
            //sukuriam unikalu ukininko ID
            $valdos_nr = time();
            //paimam, prisijungusio vartotojo duomenis, prie jo priskirsim ukininka
            $user = $this->ion_auth->user()->row();

            /////////////////////////////// LIKUSIU DUOMENU PATIKRINIMAS ///////////////////////////////////////

            //jei ne gyvulininkyste, bandos nera.
            if(!$banda){$banda = 0;}
            //patikrinam, ar pazymeta kad nori ivesti VIC.LT duomenis, jei taip privalo uzpildyti
            if($vic_lt){
                if(!$v_vardas){ $this->main_model->info['error'][] = "Neįvestas VIC.LT vartotojo vardas"; $klaida = TRUE;}
                if(!$slaptazodis){ $this->main_model->info['error'][] = "Neįvestas VIC.LT slaptažodis"; $klaida = TRUE;}
            }
            //patikrina ar pasirinkus gyvulininkyste, butu pasirinkta kokia banda turi
            if($tipas == 0){
                if(!$banda){$this->main_model->info['error'][] = "Pasirinkote GYVULININKYSTĘ, privalote pasirinkti bandą"; $klaida = TRUE;}
            }
            //patikrinam pagal varda, pavarde ar toks ukininkas neegzistuoja
            $ok = $this->ukininkai_model->tikinti_ukininka($vardas, $pavarde);
            if($ok>0){
                $this->main_model->info['error'][] = "TOKS ūkininkas jau yra!, ".$vardas." ".$pavarde."."; $klaida = TRUE;}
            //jei nera klaidu irasom i duomenu baze
            if(!$klaida){
                $duomenys = array('vardas' => $vardas , 'pavarde' => $pavarde , 'valdos_nr' => $valdos_nr,
                    'VIC_vartotojo_vardas' => $v_vardas, 'VIC_slaptazodis' => $slaptazodis, 'banda' => $banda, 'ukio_tipas' => $tipas, 'user_id' => $user->id);
                //ikelti papildomus duomenis
                $this->ukininkai_model->irasyti_ukininka($duomenys);
                $this->session->set_flashdata('message', "Naujas ukininkas pridetas!, ".$vardas." ".$pavarde.".");
            redirect("ukininkai/sarasas_ukininku");}
        }

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Ūkininkai";
        $this->main_model->info['txt']['info'] = "Naujas ūkininkas";

        $this->load->view("main_view");
    }
}

?>
