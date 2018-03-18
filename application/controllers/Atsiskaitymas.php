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
        $this->load->model('ukininkai_model');
        $this->load->model('sutartys_model');
        $this->load->model('atsiskaitymas_model');
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

    public  function israsai_sarasas(){
        $data = array();
        $this->main_model->info['saskaitu_planas'] = $this->atsiskaitymas_model->sakiatu_planas($data);

        $this->load->view("atsiskaitymas/israsai_sarasas");
    }

    public  function israsu_redagavimas(){
        $this->form_validation->set_rules('metai', 'Metai', 'required');
        $this->form_validation->set_rules('menesis', 'Menesis', 'required');
        $data = array();
        if ($this->form_validation->run()) {
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');
            $data = $this->atsiskaitymas_model->banko_israsas_sarasas($metai, $menesis);
        }
        echo json_encode( $data); die;
    }

    public  function issaugoti_redagavima(){
        var_dump($this->input->post()); die;
         $this->load->view("atsiskaitymas/ issaugoti_redagavima");
    }

    public  function ukininkai(){
        $user = $this->ion_auth->user()->row();
        //Nuskaitom ukininku sarasa, kad butu visada po ranka
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas( $user->id);

        $this->load->view("atsiskaitymas/ukininkai");
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
        //iterptoi pasirinkima ir perduoti cia
        if(1){
            $no = "Rpt";
            $noo = "BkToCstmrAcctRpt";
        }else{
            $no = "Stmt";
            $noo = "BkToCstmrStmt";
        }

        $xml = simplexml_load_file($url);
        $mokejimai = array();
        $mok = array();
        $i = 0;
        $bankas = $xml->$noo->$no->Acct->Svcr->FinInstnId->Nm;
        $saskaita = $xml->$noo->$no->Acct->Id->IBAN;

        foreach ($xml->$noo->$no->Ntry as $row){
            //jei ukininkas sumokejas uz paslaugas, gaunamas jo valdos numeris pagal nurodyta varda pavarde
            $da = 0; $kreditas = 0; $debetas = 0;

            if($row->NtryDtls->TxDtls->RltdPties->Dbtr->Nm != 'ALŪZO TRANSPORTAS UAB'){
                $vapa = str_replace("Ūkininkas ", "", $row->NtryDtls->TxDtls->RltdPties->Dbtr->Nm);
                $vapa = explode(" ", $vapa);
                $data1 = array("vardas" => ucfirst(strtolower($vapa[0])), "pavarde" => ucfirst(strtolower($vapa[1])));
                $data2 = array("vardas" => ucfirst(strtolower($vapa[1])), "pavarde" => ucfirst(strtolower($vapa[0])));

                $da = $this->atsiskaitymas_model->randam_ukininka($data1);
                if(count($da) < 1){
                    $da = $this->atsiskaitymas_model->randam_ukininka($data2);}

                $kreditas = 2411;
                $debetas = 270;
            }
            $mokejimai['u_id'] = (string)$da[0]['valdos_nr'];

            $mokejimai['mokejimo_data'] = (string)$row->BookgDt->Dt;
            $mokejimai['mokejimo_ivykdymas'] = (string)$row->ValDt->Dt;
            $mokejimai['debetas_kreditas'] = (string)$row->CdtDbtInd;
            $mokejimai['domain_kodas'] = (string)$row->BkTxCd->Domn->Cd;
            $mokejimai['family_kodas'] = (string)$row->BkTxCd->Domn->Fmly->Cd;
            $mokejimai['sub_family_kodas'] = (string)$row->BkTxCd->Domn->Fmly->SubFmlyCd;
            $mokejimai['unikalus_mokejimo_nr'] = (string)$row->NtryDtls->TxDtls->Refs->AcctSvcrRef;
            $mokejimai['mokejimo_dokumento_nr'] = (string)$row->NtryDtls->TxDtls->Refs->InstrId;
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
            //papildoma informacija
            $mokejimai['bankas_kurio_israsas'] = (string)$bankas;
            $mokejimai['saskaitos_numeris'] = (string)$saskaita;
            $mokejimai['kreditas'] = (string)$kreditas;
            $mokejimai['debetas'] = (string)$debetas;

            //var_dump($mokejimai);

            //tikrinam ar nera tokiu irasu irasytu
            $data = array("unikalus_mokejimo_nr" => $mokejimai['unikalus_mokejimo_nr'], "mokejimo_dokumento_nr" => $mokejimai['mokejimo_dokumento_nr'],
                "mokejimo_unikali_nuoroda" => $mokejimai['mokejimo_unikali_nuoroda'], "unikalus_nurodymo_numeris" => $mokejimai['unikalus_nurodymo_numeris']);
            if($this->atsiskaitymas_model->ar_egzistuoja_irasas($data) > 0){
                $this->main_model->info['error'][] = "Banko išrašo įrašas dubliuojasi, esate jau įkėlias! - ".$this->atsiskaitymas_model->ar_egzistuoja_irasas($data);
            }else {
                $this->atsiskaitymas_model->banko_israsas($mokejimai);
                $mok[$i] = $mokejimai;
                $this->main_model->info['error'][] = "Banko išrašo įrašas, dėkmingai įkeltas į duomenų bazę!";
            }
            $i++;
        }
        //die;

        $this->load->view("atsiskaitymas/israso_ikelimas", array("mokejimai" => $mok));
    }


}