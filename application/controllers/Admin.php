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
class Admin extends CI_Controller{

    public function __construct(){
        parent::__construct();
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        if(!$this->ion_auth->logged_in() OR !$this->ion_auth->is_admin()) {
            redirect('main/auth_error');
        }
    }

    public function admin(){
        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Administravimo meniu";
        $this->main_model->info['txt']['info'] = "Pagrindinis langas";

        $this->load->view("main_view");
    }
}