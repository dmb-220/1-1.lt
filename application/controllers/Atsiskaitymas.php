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
 * @property Saskaitos          $saskaitos          Saskaitos controller
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

class Atsiskaitymas extends CI_Controller
{

    public function __construct()
    {
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

    public function aprasymas(){
        $this->load->view("atsiskaitymas/aprasymas");
    }

    public function atsiskaitymas(){

        $this->main_model->info['txt']['meniu'] = "Atsiskaitymas";
        $this->main_model->info['txt']['info'] = "Banko išrašų tikrinimas";

        $this->load->view("main_view");
    }

    public function ikelti(){
        //nustatymai
        $config['upload_path']   = './DATA/ISRASAI/';
        $config['allowed_types'] = 'xml';
        $config['max_size']      = 10024;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('israsas')){
            $this->main_model->info['ok'] = $this->upload->data();
        }else{
            $this->main_model->info['error'] = $this->upload->display_errors();
        }

        $url = base_url().'DATA/ISRASAI/'.$this->main_model->info['ok']['file_name'];

        $xml = simplexml_load_file($url);
        $mokejimai = array();
        $i = 0;
        foreach ($xml->BkToCstmrStmt->Stmt->Ntry as $row){
            if($row->NtryDtls->TxDtls->RltdPties->Dbtr->Nm != 'ALŪZO TRANSPORTAS UAB'){

                $mokejimai[$i]['mokejimo_data'] = (string)$row->BookgDt->Dt;
                $mokejimai[$i]['mokejimo_ivykdymas'] = (string)$row->ValDt->Dt;
                $mokejimai[$i]['debetas_kreditas'] = (string)$row->CdtDbtInd;
                $mokejimai[$i]['unikalus_mokejimo_nr'] = (string)$row->NtryDtls->TxDtls->Refs->AcctSvcrRef;
                $mokejimai[$i]['mokejimo_dokumento_numeris'] = (string)$row->NtryDtls->TxDtls->Refs->InstrId;
                $mokejimai[$i]['mokejimo_unikali_nuoroda'] = (string)$row->NtryDtls->TxDtls->Refs->EndToEndId;
                $mokejimai[$i]['unikalus_nurodymo_numeris'] = (string)$row->NtryDtls->TxDtls->Refs->TxId;
                $mokejimai[$i]['operacijos_suma'] = (string)$row->NtryDtls->TxDtls->AmtDtls->TxAmt->Amt;
                $mokejimai[$i]['operacijos_valiuta'] = (string)$row->NtryDtls->TxDtls->AmtDtls->TxAmt->Amt['Ccy'];
                $mokejimai[$i]['moketojas'] = (string)$row->NtryDtls->TxDtls->RltdPties->Dbtr->Nm;
                $mokejimai[$i]['moketojo_saskaita'] = (string)$row->NtryDtls->TxDtls->RltdPties->DbtrAcct->Id->IBAN;
                $mokejimai[$i]['gavejas'] = (string)$row->NtryDtls->TxDtls->RltdPties->Cdtr->Nm;
                $mokejimai[$i]['gavejo_saskaita'] = (string)$row->NtryDtls->TxDtls->RltdPties->CdtrAcct->Id->IBAN;
                $mokejimai[$i]['mok_banko_kodas'] = (string)$row->NtryDtls->TxDtls->RltdAgts->DbtrAgt->FinInstnId->BIC;
                $mokejimai[$i]['mok_banko_pavadinimas'] = (string)$row->NtryDtls->TxDtls->RltdAgts->DbtrAgt->FinInstnId->Nm;
                $mokejimai[$i]['mok_ejimo_paskirtis'] = (string)$row->NtryDtls->TxDtls->RmtInf->Ustrd;

                //var_dump($mokejimai[$i]['operacijos_suma']);
                $i++;

            }

        }
        var_dump($mokejimai);
        die;

        $this->load->view("atsiskaitymas/israso_ikelimas");


    }

}