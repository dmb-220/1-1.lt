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
	}

	public function index(){
		$inf = array();
        $error = array();
		//$dt = $this->session->userdata();
		//var_dump($this->session->userdata());
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$this->form_validation->set_rules('ukininkas', 'Pasirinkti ūkininką', 'required', array('required' => 'Pasirinkite!.'));

		if ($this->form_validation->run()) {
			$ukininkas = $_POST['ukininkas'];

			$this->load->model('ukininkai_model');
			$uk = $this->ukininkai_model->ukininkas($ukininkas);
			$new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
			$this->session->set_userdata($new);

			$error['action'] = true;
		}
		//sukeliam info, informaciniam meniu
		$inf['meniu'] = "Pagrindinis MENIU";
        $inf['active'] = "INFORMACIJA";

		$this->load->model('ukininkai_model');
		$data = $this->ukininkai_model->ukininku_sarasas();
		$this->load->view('main_view', array('data'=> $data, 'error' => $error, 'inf' => $inf));
	}

	public function auth_error(){
        $inf = array();
        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Vartotojų valdymas";
        $inf['active'] = "Prisijungimo KLAIDA!";

		$this->load->view('main_view', array('inf' => $inf));
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
        $inf['meniu'] = "Pagrindinis MENIU";
        $inf['active'] = "Kalendorius";

		$this->load->view('main_view', array('data' => $data, 'inf' => $inf));
	}
}

?>
