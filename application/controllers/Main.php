<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ************************ CONTROLLERS ************************
 * @property Pasarai            $pasarai            Pasarai controller
 * @property Paseliai           $paseliai           Paseliai controller
 * @property Ukininkai          $ukininkai          Ukininkai controller
 * @property Galvijai          $gyvuliai           Gyvuliai controller
 * @property Auth               $auth               Auth controller
 * @property Main               $main               Main controller
 * @property Admin              $admin              Admin controller
 * ************************ MODELS *****************************
 * @property Pasarai_model      $pasarai_model      Pasarai models
 * @property Paseliai_model     $paseliai_model     Paseliai models
 * @property Ukininkai_model    $ukininkai_model    Ukininkai models
 * @property Galvijai_model     $gyvuliai_model     Gyvuliai models
 * @property Ion_auth_model     $ion_auth_model     Ion_Auth models
 * @property Main_model         $main_model         Main models
 * @property Admin_model        $admin_model        Admin models
 * ************************* LIBRARY ****************************
 * @property Ion_auth           $ion_auth           Ion_auth library
 */
class Main extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ERROR);

		//ukraunami reikalingi MODEL
        $this->load->model('ukininkai_model');
        $this->load->model('main_model');
	}

	//cia tam kartui, nukreipiama is kitu puslapiu kai neprisijungta, numestu i login, visur reik keisti, kad sito nereiketu
    public function auth_error(){
        redirect('auth/login');
        }

	//Pagrindinis visos svetaines puslapis
	public function index(){
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$this->form_validation->set_rules('ukininkas', 'Pasirinkti ūkininką', 'required', array('required' => 'Pasirinkite!.'));
		//Nustatom i sesijas su kuriuo ukininku dirbsim
		if ($this->form_validation->run()) {
			$ukininkas = $this->input->post('ukininkas');
			$uk = $this->ukininkai_model->ukininkas($ukininkas);
			$new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
			$this->session->set_userdata($new);
			//$this->ukininkai_model->priskirti($ukininkas);
			//Pranesimas kad ivyko pasirinkimas
            $this->session->set_flashdata('message', "Ūkininkas <b>".$uk[0]['vardas']." ".$uk[0]['pavarde']."</b> pasirinktas.");
		}
		//sukeliam info, informaciniam meniu
		$this->main_model->info['txt']['meniu'] = "Pagrindinis puslapis";
        $this->main_model->info['txt']['info'] = "Čia pateikiama visa reikalinga informacija, kurios pagalba, bus lengva pateikti duomenis, keisti nustatymus. ";

        $user = $this->ion_auth->user()->row();
        //Nuskaitom ukininku sarasa, kad butu visada po ranka
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas( $user->id, TRUE);

		$this->load->view('main_view');
	}


	public function kalendorius(){
		$data['data'] = array(
				3  => 'Draft Robot Plans',
				7  => 'Delivery of Robot Parts',
				13 => 'Construction Finished',
				26 => 'Humans!'
		);

		$this->load->library('calendar');

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Pagrindinis MENIU";
        $this->main_model->info['txt']['active'] = "Kalendorius";

		$this->load->view('main_view', array('data' => $data));
	}
}

?>
