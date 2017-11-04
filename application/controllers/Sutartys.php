<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ************************ CONTROLLERS ************************
 * @property Pasarai            $pasarai            Pasarai controller
 * @property Paseliai           $paseliai           Paseliai controller
 * @property Ukininkai          $ukininkai          Ukininkai controller
 * @property Galvijai           $galvijai           Galvijai controller
 * @property Sutartys           $sutartys           Sutartys controller
 * @property Auth               $auth               Auth controller
 * @property Main               $main               Main controller
 * @property Admin              $admin              Admin controller
 * ************************ MODELS *****************************
 * @property Pasarai_model      $pasarai_model      Pasarai models
 * @property Paseliai_model     $paseliai_model     Paseliai models
 * @property Ukininkai_model    $ukininkai_model    Ukininkai models
 * @property Galvijai_model     $galvijai_model     Galvijai models
 * @property Ion_auth_model     $ion_auth_model     Ion_Auth models
 * @property Main_model         $main_model         Main models
 * @property Admin_model        $admin_model        Admin models
 * @property Sutartys_model     $sutartys_model     Sutartys models
 * ************************* LIBRARY ****************************
 * @property Ion_auth           $ion_auth           Ion_auth library
 */
class Sutartys extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ERROR | E_WARNING | E_PARSE);

        //uzkraunam MODEL
        $this->load->model('ukininkai_model');
        //$this->load->model('galvijai_model');
        $this->load->model('main_model');

        //$this->load->library('linksniai');

        if (!$this->ion_auth->logged_in()) {
            redirect('main/auth_error');
        }
    }

    //jei kas bandys atidaryti index puslapi bus nukreiptas i pagrindini
    public function index()
    {
        redirect('main');
    }

    public function skaitciuokle(){

        $this->load->view('main_view');
    }

    public function sutartys(){
        $dt = $this->session->userdata();
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($dt['vardas'] == "" AND $dt['pavarde'] == "") {
            $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required', array('required' => 'Pasirinkite ūkininką.'));
            $ukininkas = $this->input->post('ukininko_vardas');
            $uk = $this->ukininkai_model->ukininkas($ukininkas);
            $this->main_model->info['txt']['vardas'] = $uk[0]['vardas'];
            $this->main_model->info['txt']['pavarde'] = $uk[0]['pavarde'];
            $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
            $this->session->set_userdata($new);
        } else {
            $ukininkas = $dt['nr'];
            $this->main_model->info['txt']['vardas'] = $dt['vardas'];
            $this->main_model->info['txt']['pavarde'] = $dt['pavarde'];
        }

        if ($this->form_validation->run()) {
            $this->load->library('Excel');
            $inputFileName = './DATA/sutikimas.xls';
// Read the existing excel file
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
// Update it's data
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
// Add column headers
            $objPHPExcel->getActiveSheet()
                ->setCellValue('D2', date("Y-m-d"))
                ->setCellValue('C5', $this->main_model->info['txt']['vardas']." ".$this->main_model->info['txt']['pavarde'])
                ->setCellValue('G5', "38621116145")
            ;
// Generate an updated excel file
// Redirect output to a client’s web browser (Excel2007)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $inputFileName . '"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Sutartys";
        $this->main_model->info['txt']['info'] = "Sutikimas dėl duomenų naudojimo";

        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas(TRUE);
        $this->load->view('main_view');
    }

    public function paslaugu_teikimas(){
        $dt = $this->session->userdata();
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($dt['vardas'] == "" AND $dt['pavarde'] == "") {
                $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required', array('required' => 'Pasirinkite ūkininką.'));
                $ukininkas = $this->input->post('ukininko_vardas');
                $uk = $this->ukininkai_model->ukininkas($ukininkas);
                $this->main_model->info['txt']['vardas'] = $uk[0]['vardas'];
                $this->main_model->info['txt']['pavarde'] = $uk[0]['pavarde'];
                $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
                $this->session->set_userdata($new);
            } else {
                $ukininkas = $dt['nr'];
                $this->main_model->info['txt']['vardas'] = $dt['vardas'];
                $this->main_model->info['txt']['pavarde'] = $dt['pavarde'];
            }

            $this->form_validation->set_rules('numeris', 'Numeris', 'required', array('required' => 'Įveskite sutarties numerį.'));
            $this->form_validation->set_rules('data', 'Data', 'required', array('required' => 'Pasirinkite datą.'));
            $this->form_validation->set_rules('kaina', 'Kaina', 'required', array('required' => 'Įveskitę kaina.'));

            if ($this->form_validation->run()) {
                $numeris = $this->input->post('numeris');
                $data = $this->input->post('data');
                $kaina = $this->input->post('kaina');

                $this->load->library('Excel');
       $inputFileName = './DATA/paslaugu_sutartis.xls';
// Read the existing excel file
       $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
       $objReader = PHPExcel_IOFactory::createReader($inputFileType);
       $objPHPExcel = $objReader->load($inputFileName);
// Update it's data
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $objPHPExcel->setActiveSheetIndex(0);
// Add column headers
       $objPHPExcel->getActiveSheet()
           ->setCellValue('F1', "Nr. ".$numeris)
           ->setCellValue('D2', date("Y-m-d"))
           ->setCellValue('C10', $data)
           ->setCellValue('B6', $this->main_model->info['txt']['vardas']." ".$this->main_model->info['txt']['pavarde'])
           ->setCellValue('C19', $kaina)
           ->setCellValue('E35', $this->main_model->info['txt']['vardas']." ".$this->main_model->info['txt']['pavarde'])
       ;
// Generate an updated excel file
// Redirect output to a client’s web browser (Excel2007)
       header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
       header('Content-Disposition: attachment;filename="' . $inputFileName . '"');
       header('Cache-Control: max-age=0');
       $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
       $objWriter->save('php://output');
            }

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Sutartys";
        $this->main_model->info['txt']['info'] = "Sutarčių šablonai";

        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas(TRUE);
        $this->load->view('main_view');
    }

}