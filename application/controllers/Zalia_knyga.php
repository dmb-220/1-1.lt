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
        if(!$this->ion_auth->logged_in()) {
            redirect('main/auth_error');
        }

    }

    public function organizaciju_sarasas(){
        $data = $this->zalia_knyga_model->nuskaityti_organizacijas();
        echo json_encode($data); die;
    }

    public function pvm_sarasas(){
        $data = $this->zalia_knyga_model->nuskaityti_pvm();
        echo json_encode($data); die;
    }

    public function zalia_knyga(){
        $da = array(
        );
        $data = $this->zalia_knyga_model->nuskaityti_knyga($da);
        echo json_encode($data); die;
    }

    public function knyga(){
        //nuskaitom irasus is zaliosios knygos
        $da = array(
            "u_id" => 1,
            "metai" => $this->main_model->info['txt']['metai'],
            "menesis" => $this->main_model->info['txt']['menesis'],
        );
        $irasai = $this->zalia_knyga_model->nuskaityti_knyga($da);

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Didžioji knyga";
        $this->main_model->info['txt']['info'] = "Pagrindinis";

        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas();
        $this->main_model->info['pvm'] = $this->zalia_knyga_model->nuskaityti_pvm();
        $this->main_model->info['organizacijos'] = $this->zalia_knyga_model->nuskaityti_organizacijas();

        $this->load->view("main_view", array('irasai' => $irasai));
    }

    public function naujas_irasas(){
        $numeris = $this->input->post('numeris');
        $data = $this->input->post('data');
        $organizacija = $this->input->post('organizacija');
        $dok_rusis = $this->input->post('dok_rusis');
        $kiekis = $this->input->post('kiekis');
        $mato_vnt = $this->input->post('mato_vnt');
        $atsiskaitymas = $this->input->post('atsiskaitymas');
        $atsiskaitymo_data = $this->input->post('atsiskaitymo_data');
        $be_pvm = $this->input->post('be_pvm');
        $pvm = $this->input->post('pvm');
        $pvm_kodas = $this->input->post('pvm_kodas');

        //issiskaidom data i metai, menesis, diena
        $exp = explode("-", $data);
        $metai = $exp[0];
        $menesis = $exp[1];
        $diena = $exp[2];
        //rasomas kodas, skirtas naujam irasui
        $da = array(
            "u_id" => 1,
            "metai" => $metai,
            "menesis" => $menesis,
            "diena" => $diena,
            "numeris" => $numeris,
            "pvm_id" => $pvm_kodas,
            "PVM" => $pvm,
            "be_PVM" => $be_pvm,
            "atsiskaitymo_data" => $atsiskaitymo_data,
            "atsiskaitymas" => $atsiskaitymas,
            "mato_vnt" => $mato_vnt,
            "kiekis" => $kiekis,
            "dokumento_rusis" => $dok_rusis,
            "organizacija" => $organizacija
            );
        if($this->zalia_knyga_model->tikrinti_irasa($da) > 0){
            $this->session->set_flashdata('message', "Toks įrašas jau egzistuoja");
        }else{

            $this->zalia_knyga_model->naujas_irasas_knyga($da);
            $this->session->set_flashdata('message', "Naujas įrašas įtrauktas į KNYGA");
        }
        echo json_encode($this->input->post()); die;
    }

    public function organizacija_irasas(){
        $this->form_validation->set_rules('pavadinimas', 'Organizacijos pavadinimas', 'required');
        $this->form_validation->set_rules('kodas', 'PVM kodas', 'alpha_numeric|required');
        $this->form_validation->set_rules('pvm', 'PVM kodas');

        //var_dump($this->input->post()); die;
        if ($this->form_validation->run()) {
            $kodas = $this->input->post('kodas');
            $pavadinimas = $this->input->post('pavadinimas');
            $pvm = $this->input->post('pvm');

            //rasomas kodas
            if($this->zalia_knyga_model->tikrinti_organizacija($kodas, $pavadinimas) > 0){
                $this->session->set_flashdata('message', "Tokia, ".strtoupper($pavadinimas)." organizacija jau YRA");
            }else{
                $this->zalia_knyga_model->nauja_organizacija($pavadinimas, $kodas, $pvm);
                $this->session->set_flashdata('message', "Nauja organizacija pridėta!");
            }
        }else{
            $this->session->set_flashdata('message', "Neteisingai užpidyti duomenys!");
        }
        redirect('zalia_knyga/knyga');
    }

    public function pvm_irasas(){
        $this->form_validation->set_rules('pavadinimas', 'Operacijos pavadinimas', 'required');
        $this->form_validation->set_rules('kodas', 'PVM kodas', 'alpha_numeric');
        $this->form_validation->set_rules('tarifas', 'PVM tarifas', 'is_natural|max_length[2]');
        $this->form_validation->set_rules('pvz', 'PVM taikymo pavyzdžiai');

        if ($this->form_validation->run()) {
            $kodas = $this->input->post('kodas');
            $tarifas = $this->input->post('tarifas');
            $pavadinimas = $this->input->post('pavadinimas');
            $pvz = $this->input->post('pvz');

            //rasomas kodas
            if($this->zalia_knyga_model->tikrinti_pvm($kodas, $pavadinimas) > 0){
                $this->session->set_flashdata('message', "Toks, ".strtoupper($kodas)." tarifas jau YRA");
            }else{
                $this->zalia_knyga_model->naujas_pvm($pavadinimas, $kodas, $tarifas, $pvz);
                $this->session->set_flashdata('message', "Naujas PVM tarifas pridėtas");
            }
        }else{
            $this->session->set_flashdata('message', "Neteisingai užpidyti duomenys!");
        }
        redirect('zalia_knyga/knyga');
    }

}