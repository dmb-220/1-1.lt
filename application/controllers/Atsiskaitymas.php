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
 * @property Atsiskaitymas_model        $atsiskaitymas_model        Atsiskaitymas models
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
        //$this->load->model('ukininkai_model');
       // $this->load->model('galvijai_model');
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
        $config['max_size']      = 1024*5;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('israsas')){
            $this->main_model->info['ok'] = $this->upload->data();
        }else{
            $this->main_model->info['error'] = $this->upload->display_errors();
        }

        $url = base_url().'DATA/ISRASAI/'.$this->main_model->info['ok']['file_name'];

        $xml = simplexml_load_file($url);
        $mokejimai = array();
        $mok = array();
        $i = 0;
        $bankas = $xml->BkToCstmrStmt->Stmt->Acct->Svcr->FinInstnId->Nm;
        $saskaita = $xml->BkToCstmrStmt->Stmt->Acct->Id->IBAN;

        echo $bankas."<br>".$saskaita;

        foreach ($xml->BkToCstmrStmt->Stmt->Ntry as $row){

            if($row->NtryDtls->TxDtls->RltdPties->Dbtr->Nm != 'ALŪZO TRANSPORTAS UAB'){
                $vapa = explode(" ", $row->NtryDtls->TxDtls->RltdPties->Dbtr->Nm);
                $data1 = array("vardas" => ucfirst(strtolower($vapa[0])), "pavarde" => ucfirst(strtolower($vapa[1])));
                $data2 = array("vardas" => ucfirst(strtolower($vapa[1])), "pavarde" => ucfirst(strtolower($vapa[0])));
                var_dump($this->atsiskaitymas_model->randam_ukininka($data1));
                var_dump($data1);


            $mokejimai['mokejimo_data'] = (string)$row->BookgDt->Dt;
            $mokejimai['mokejimo_ivykdymas'] = (string)$row->ValDt->Dt;
            $mokejimai['debetas_kreditas'] = (string)$row->CdtDbtInd;
            $mokejimai['domain_kodas'] = (string)$row->BkTxCd->Domn->Cd;
            $mokejimai['family_kodas'] = (string)$row->BkTxCd->Domn->Fmly->Cd;
            $mokejimai['sub_family_kodas'] = (string)$row->BkTxCd->Domn->Fmly->SubFmlyCd;
            $mokejimai['unikalus_mokejimo_nr'] = (string)$row->NtryDtls->TxDtls->Refs->AcctSvcrRef;
            $mokejimai['mokejimo_dokumento_numeris'] = (string)$row->NtryDtls->TxDtls->Refs->InstrId;
            $mokejimai['mokejimo_unikali_nuoroda'] = (string)$row->NtryDtls->TxDtls->Refs->EndToEndId;
            $mokejimai['unikalus_nurodymo_numeris'] = (string)$row->NtryDtls->TxDtls->Refs->TxId;
            $mokejimai['operacijos_suma'] = (string)$row->NtryDtls->TxDtls->AmtDtls->TxAmt->Amt;
            $mokejimai['operacijos_valiuta'] = (string)$row->NtryDtls->TxDtls->AmtDtls->TxAmt->Amt['Ccy'];
            $mokejimai['moketojas'] = (string)$row->NtryDtls->TxDtls->RltdPties->Dbtr->Nm;
            $mokejimai['moketojo_adresas'] = (string)$row->NtryDtls->TxDtls->RltdPties->Dbtr->PstlAdr->AdrLine;
            $mokejimai['moketojo_asmens_kodas'] = (string)$row->NtryDtls->TxDtls->RltdPties->Dbtr->Id->PrvtId->Othr->Id;
            $mokejimai['identifikavimo_kodo_pavadinimas'] = (string)$row->NtryDtls->TxDtls->RltdPties->Dbtr->Id->PrvtId->Othr->SchmeNm->Cd;
            $mokejimai['moketojo_saskaita'] = (string)$row->NtryDtls->TxDtls->RltdPties->DbtrAcct->Id->IBAN;
            $mokejimai['gavejas'] = (string)$row->NtryDtls->TxDtls->RltdPties->Cdtr->Nm;
            $mokejimai['gavejo_saskaita'] = (string)$row->NtryDtls->TxDtls->RltdPties->CdtrAcct->Id->IBAN;
            $mokejimai['mok_banko_kodas'] = (string)$row->NtryDtls->TxDtls->RltdAgts->DbtrAgt->FinInstnId->BIC;
            $mokejimai['mok_banko_pavadinimas'] = (string)$row->NtryDtls->TxDtls->RltdAgts->DbtrAgt->FinInstnId->Nm;
            $mokejimai['mokejimo_paskirtis'] = (string)$row->NtryDtls->TxDtls->RmtInf->Ustrd;
            $mokejimai['bankas_kurio_israsas'] = (string)$bankas;
            $mokejimai['saskaitos_numeris'] = (string)$saskaita;

            //var_dump($mokejimai);
            //$this->atsiskaitymas_model->banko_israsas($mokejimai);

            $mok[$i] = $mokejimai;
            $i++;
            }
        }

        var_dump($mok);
        die;

        $this->load->view("atsiskaitymas/israso_ikelimas", array("mokejimai" => $mok));


    }

}