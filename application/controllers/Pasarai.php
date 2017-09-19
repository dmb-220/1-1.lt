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
 * ************************ MODELS *****************************
 * @property Pasarai_model      $pasarai_model      Pasarai models
 * @property Paseliai_model     $paseliai_model     Paseliai models
 * @property Ukininkai_model    $ukininkai_model    Ukininkai models
 * @property Galvijai_model     $galvijai_model     Galvijai models
 * @property Ion_auth_model     $ion_auth_model     Ion_Auth models
 * @property Main_model         $main_model         Main models
 * @property Admin_model        $admin_model        Admin models
 * ************************* LIBRARY ****************************
 * @property Ion_auth           $ion_auth           Ion_auth library
 */
class Pasarai extends CI_Controller{
    public function __construct(){
        parent::__construct();
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $this->load->library('Ion_auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('main/auth_error');
        }
    }

    public function priesvoris(){
        $data = array();
        $error = array();
        $laiko = array();

        $gyvu = array(
            //'karves' => array('kiek' => 0, 'svoris' => 0, 'pavadinimas' => 'Karvės',),
            'verseliai' => array('kiek' => 0, 'svoris' => 0, 'pavadinimas' => 'Veršeliai',),
            'telycios_1_2' => array('kiek' => 0, 'svoris' => 0, 'pavadinimas' => 'Telyčios 1-2 m.',),
            'telycios_2' => array('kiek' => 0, 'svoris' => 0, 'pavadinimas' => 'Telyčios virš 2 m.',),
            'buliai_1_2' => array('kiek' => 0,  'svoris' => 0, 'pavadinimas' => 'Buliai 1-2 m.',),
            'buliai_2' => array('kiek' => 0,  'svoris' => 0, 'pavadinimas' => 'Buliai virš 2.',),
        );

        $dt = $this->session->userdata();

        $this->load->model('ukininkai_model');
        $this->load->model('galvijai_model');
        $this->load->library('form_validation');
        $this->load->library('linksniai');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if($dt['vardas'] == "" AND $dt['pavarde'] == "") {
        $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required',  array('required' => 'Pasirinkite ūkininką.'));
        $ukininkas = $this->input->post('ukininko_vardas');
        $this->load->model('ukininkai_model');
        $uk = $this->ukininkai_model->ukininkas($ukininkas);
        $inf['vardas'] = $uk[0]['vardas'];
        $inf['pavarde'] = $uk[0]['pavarde'];
        $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
        $this->session->set_userdata($new);
        }else{
            $ukininkas = $dt['nr'];
            $inf['vardas'] = $dt['vardas'];
            $inf['pavarde'] = $dt['pavarde'];
        }

        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
        //$this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

        $svoris = array(
            //'karves' => '0',
            'telycios_1_2' => '12',
            'telycios_2' => '9',
            'buliai_1_2' => '16',
            'buliai_2' => '18',
            'verseliai' => '20',
        );

        if ($this->form_validation->run()) {
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');
            $laikotarpis = $this->input->post('laikotarpis');

            $inf['metai'] = $metai;
            $inf['menesis'] = $menesis;

            //patikrinam kokie pasirinkimai yra, kad maziau nesusipratimu skaiciuojant
            if(!$menesis AND !$laikotarpis){
                $error['laikas'] = "Pasirinkite mėnesį arba laikotarpį kuriam skaičiuosime pašarus.";}
            if($menesis AND $laikotarpis){
                $error['laikas2'] = "Pasirinkite TIK mėnesį arba TIK laikotarpį kuriam skaičiuosime pašarus.";}

            if($menesis AND !$laikotarpis) {
                //skaiciuojam nurodyto menesio pasaru kieki galvijams
                //nuskaitom visus gyvulius, pasirinkto menesio
                $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
                $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);
                //suskaiciuoti lenteleje, viso kiekius
                foreach($rezultatai as $sk){
                    $one = explode(" ", $sk['lytis']);
                    /*if($one[0] == "Karvė"){
                        $gyvu['karves']['pradzia']++;
                    }*/

                    if($one[0] == "Buliukas"){
                        if($sk['amzius']>=12 AND $sk['amzius']<24){
                            $gyvu['buliai_1_2']['kiek']++;
                            $gyvu['buliai_1_2']['svoris'] += $svoris['buliai_1_2'];
                        }
                        if($sk['amzius']>=24){
                            $gyvu['buliai_2']['kiek']++;
                            $gyvu['buliai_2']['svoris'] += $svoris['buliai_2'];
                        }
                        if($sk['amzius']<12 AND $sk['amzius']!=""){
                            $gyvu['verseliai']['kiek']++;
                            $gyvu['verseliai']['svoris'] += $svoris['verseliai'];
                        }
                    }

                    if($one[0] == "Telyčaitė"){
                        if($sk['amzius']>=12 AND $sk['amzius']<24){
                            $gyvu['telycios_1_2']['kiek']++;
                            $gyvu['telycios_1_2']['svoris'] += $svoris['telycios_1_2'];
                        }
                        if($sk['amzius']>=24){
                            $gyvu['telycios_2']['kiek']++;
                            $gyvu['telycios_2']['svoris'] += $svoris['telycios_2'];
                        }
                        if($sk['amzius']<12 AND $sk['amzius']!=""){
                            $gyvu['verseliai']['kiek']++;
                            $gyvu['verseliai']['svoris'] += $svoris['verseliai'];
                        }
                    }
                }
            }

            //pradedam skaiciuoti ketvircius ir pusmecius
            if(!$menesis AND $laikotarpis){
                if($laikotarpis == 1){
                    $laiko = array(1, 2, 3, 4, 5, 6);
                    $inf['laikotarpis'] = 'I pusmetis';}
                if($laikotarpis == 2){
                    $laiko = array(7, 8, 9, 10, 11, 12);
                    $inf['laikotarpis'] = 'II pusmetis';}
                if($laikotarpis == 3){
                    $laiko = array(1, 2, 3);
                    $inf['laikotarpis'] = 'I ketvirtis';}
                if($laikotarpis == 4){
                    $laiko = array(4, 5, 6);
                    $inf['laikotarpis'] = 'II ketvirtis';}
                if($laikotarpis == 5){
                    $laiko = array(7, 8, 9);
                    $inf['laikotarpis'] = 'III ketvirtis';}
                if($laikotarpis == 6){
                    $laiko = array(10, 11, 12);
                    $inf['laikotarpis'] = 'IV ketvirtis';}

                foreach ($laiko as $laikas){
                    //nuskaitom visus gyvulius, pasirinkto menesio
                    $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $laikas);
                    $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);
                    //suskaiciuoti lenteleje, viso kiekius
                    foreach($rezultatai as $sk){
                        $one = explode(" ", $sk['lytis']);
                        /*if($one[0] == "Karvė"){
                            $gyvu['karves']['pradzia']++;
                        }*/

                        if($one[0] == "Buliukas"){
                            if($sk['amzius']>=12 AND $sk['amzius']<24){
                                $gyvu['buliai_1_2']['kiek']++;
                                $gyvu['buliai_1_2']['svoris'] += $svoris['buliai_1_2'];
                            }
                            if($sk['amzius']>=24){
                                $gyvu['buliai_2']['kiek']++;
                                $gyvu['buliai_2']['svoris'] += $svoris['buliai_2'];
                            }
                            if($sk['amzius']<12 AND $sk['amzius']!=""){
                                $gyvu['verseliai']['kiek']++;
                                $gyvu['verseliai']['svoris'] += $svoris['verseliai'];
                            }
                        }

                        if($one[0] == "Telyčaitė"){
                            if($sk['amzius']>=12 AND $sk['amzius']<24){
                                $gyvu['telycios_1_2']['kiek']++;
                                $gyvu['telycios_1_2']['svoris'] += $svoris['telycios_1_2'];
                            }
                            if($sk['amzius']>=24){
                                $gyvu['telycios_2']['kiek']++;
                                $gyvu['telycios_2']['svoris'] += $svoris['telycios_2'];
                            }
                            if($sk['amzius']<12 AND $sk['amzius']!=""){
                                $gyvu['verseliai']['kiek']++;
                                $gyvu['verseliai']['svoris'] += $svoris['verseliai'];
                            }
                        }
                    }
                }
            }

            $error['action'] = true;
        }

            //sukeliam info, informaciniam meniu
            $inf['meniu'] = "Pašarai";
            $inf['active'] = "Priesvoris";

            $data = $this->ukininkai_model->ukininku_sarasas();

            $this->load->view("main_view", array('data'=> $data, 'error' => $error, 'inf' => $inf, 'gyvu' => $gyvu));
    }

    public function ganykliniai_pasarai(){
        $data = array();
        $error = array();

        $dt = $this->session->userdata();

        $this->load->model('ukininkai_model');
        $this->load->model('galvijai_model');
        $this->load->library('form_validation');
        $this->load->library('linksniai');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if($dt['vardas'] == "" AND $dt['pavarde'] == "") {
            $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required',  array('required' => 'Pasirinkite ūkininką.'));
            $ukininkas = $this->input->post('ukininko_vardas');
            $this->load->model('ukininkai_model');
            $uk = $this->ukininkai_model->ukininkas($ukininkas);
            $inf['vardas'] = $uk[0]['vardas'];
            $inf['pavarde'] = $uk[0]['pavarde'];
            $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
            $this->session->set_userdata($new);
        }else{
            $ukininkas = $dt['nr'];
            $inf['vardas'] = $dt['vardas'];
            $inf['pavarde'] = $dt['pavarde'];
        }
        $this->form_validation->set_rules('sezonas', 'Sezonas', 'required', array('required' => 'Pasirinkite sezoną.'));
        $this->form_validation->set_rules('laikotarpis', 'Laikotarpis', 'required', array('required' => 'Pasirinkite laikotarpį.'));

        $mesl = array(
            'karves' => '65',
            'telycios' => '50',
            'buliai' => '55',
            'verseliai' => '35',
        );

        $arr = array(
            '00', '05', '06', '07', '08', '09', '10'
        );


        if ($this->form_validation->run()) {
            $sezonas = $this->input->post('sezonas');
            $laikotarpis = $this->input->post('laikotarpis');

            $inf['sezonas'] = $sezonas;
            $inf['laikotarpis'] = $laikotarpis;
            //adresas prie kurio reikia prisjungti
            $gyvi_url = "https://www.vic.lt:8102/pls/gris/private.gyvuliu_sarasas";

            //sukuriam prisjijungima
            $ukis = $this->ukininkai_model->ukininkas($ukininkas);
            $auth = $ukis[0]['VIC_vartotojo_vardas'].":".$ukis[0]['VIC_slaptazodis'];


            if($laikotarpis != 0) {

                $gyvu = array(
                    'karves' => array('kiek' => 0, 'pasarai' => 0, 'pavadinimas' => 'M. Karvės',),
                    'verseliai' => array('kiek' => 0, 'pasarai' => 0, 'pavadinimas' => 'Veršeliai',),
                    'telycios' => array('kiek' => 0, 'pasarai' => 0, 'pavadinimas' => 'Telyčios',),
                    'buliai' => array('kiek' => 0,  'pasarai' => 0, 'pavadinimas' => 'Buliai',),
                );

                $day = cal_days_in_month(CAL_GREGORIAN, $arr[$laikotarpis], $sezonas);

                //sugeneruojame data skirta siusti i VIC.LT
                $da = $sezonas.'.'.$arr[$laikotarpis].'.'.cal_days_in_month(CAL_GREGORIAN, $arr[$laikotarpis], $sezonas);
                //sukuriam masyva POST
                $post = ['v_data' => $da, 'v_rus' => 1];
                //nuskaitom VIC.LT
                $page = $this->galvijai_model->get_VIC($gyvi_url, $post, $auth);
                //print_r($page['content']); die;
                if (!$page['content']) {
                    //isvesti error jei negaunu duomenu is VIC.LT
                } else {
                    $data_gyvi = $this->galvijai_model->Gyvi_gyvunai($page['content']);
                    //apdoroti duomenis prie irasant i masyva
                    //var_dump($data_gyvi); die;
                    foreach ($data_gyvi as $sk) {
                        $one = explode(" ", $sk[4]);
                        if ($one[0] == "Karvė") {
                            $gyvu['karves']['kiek']++;
                            $gyvu['karves']['pasarai'] += $mesl['karves'] * $day;
                        }

                        if ($one[0] == "Buliukas") {
                            if ($sk[7] >= 12) {
                                $gyvu['buliai']['kiek']++;
                                $gyvu['buliai']['pasarai'] += $mesl['buliai'] * $day;
                            }
                            if ($sk[7] < 12) {
                                $gyvu['verseliai']['kiek']++;
                                $gyvu['verseliai']['pasarai'] += $mesl['verseliai'] * $day;
                            }
                        }

                        if ($one[0] == "Telyčaitė") {
                            if ($sk[7] >= 12) {
                                $gyvu['telycios']['kiek']++;
                                $gyvu['telycios']['pasarai'] += $mesl['telycios'] * $day;
                            }
                            if ($sk[7] < 12) {
                                $gyvu['verseliai']['kiek']++;
                                $gyvu['verseliai']['pasarai'] += $mesl['verseliai'] * $day;
                            }
                        }
                    }

                }

                //var_dump($gyvu); die;

                $error['action'] = 1;

            }else{

                //Cia dar gali buti klaidu, teks patvarkyti, kai jau gales skaiciuoti visa sezona

                $gyvu = array(
                    'karves' => array('pavadinimas' => 'M. Karvės',
                        '11' => array('kiek' => 0, 'pasarai' => 0,),
                        '12' => array('kiek' => 0, 'pasarai' => 0,),
                        '01' => array('kiek' => 0, 'pasarai' => 0,),
                        '02' => array('kiek' => 0, 'pasarai' => 0,),
                        '03' => array('kiek' => 0, 'pasarai' => 0,),
                        '04' => array('kiek' => 0, 'pasarai' => 0,),
                        'viso' => array('kiek' => 0, 'pasarai' => 0,)),
                    'verseliai' => array('pavadinimas' => 'Veršeliai',
                        '11' => array('kiek' => 0, 'pasarai' => 0,),
                        '12' => array('kiek' => 0, 'pasarai' => 0,),
                        '01' => array('kiek' => 0, 'pasarai' => 0,),
                        '02' => array('kiek' => 0, 'pasarai' => 0,),
                        '03' => array('kiek' => 0, 'pasarai' => 0,),
                        '04' => array('kiek' => 0, 'pasarai' => 0,),
                        'viso' => array('kiek' => 0, 'pasarai' => 0,)),
                    'telycios' => array('pavadinimas' => 'Telyčios',
                        '11' => array('kiek' => 0, 'pasarai' => 0,),
                        '12' => array('kiek' => 0, 'pasarai' => 0,),
                        '01' => array('kiek' => 0, 'pasarai' => 0,),
                        '02' => array('kiek' => 0, 'pasarai' => 0,),
                        '03' => array('kiek' => 0, 'pasarai' => 0,),
                        '04' => array('kiek' => 0, 'pasarai' => 0,),
                        'viso' => array('kiek' => 0, 'pasarai' => 0,)),
                    'buliai' => array('pavadinimas' => 'Buliai',
                        '11' => array('kiek' => 0, 'pasarai' => 0,),
                        '12' => array('kiek' => 0, 'pasarai' => 0,),
                        '01' => array('kiek' => 0, 'pasarai' => 0,),
                        '02' => array('kiek' => 0, 'pasarai' => 0,),
                        '03' => array('kiek' => 0, 'pasarai' => 0,),
                        '04' => array('kiek' => 0, 'pasarai' => 0,),
                        'viso' => array('kiek' => 0, 'pasarai' => 0,)),
                );


                for($i = 1; $i<count($arr); $i++) {

                    $day = cal_days_in_month(CAL_GREGORIAN, $arr[$i], $sezonas);

                    //sugeneruojame data skirta siusti i VIC.LT
                    $da = $sezonas.'.'.$arr[$i].'.'.$day;

                    //sukuriam masyva POST
                    $post = ['v_data' => $da, 'v_rus' => 1];

                    //nuskaitom VIC.LT
                    $page = $this->galvijai_model->get_VIC($gyvi_url, $post, $auth);
                    if (!$page['content']) {
                        //isvesti error jei negaunu duomenu is VIC.LT
                    } else {
                        $data_gyvi = $this->galvijai_model->Gyvi_gyvunai($page['content']);
                        //apdoroti duomenis prie irasant i masyva
                        //var_dump($data_gyvi); die;
                        foreach ($data_gyvi as $sk) {
                            $one = explode(" ", $sk[4]);
                            if ($one[0] == "Karvė") {
                                //menesiu
                                $gyvu['karves'][$arr[$i]]['kiek']++;
                                $gyvu['karves'][$arr[$i]]['pasarai'] += $mesl['karves'] * $day;
                                //viso
                                $gyvu['karves']['viso']['kiek']++;
                                $gyvu['karves']['viso']['pasarai'] += $mesl['karves'] * $day;
                            }

                            if ($one[0] == "Buliukas") {
                                if ($sk[7] >= 12) {
                                    $gyvu['buliai'][$arr[$i]]['kiek']++;
                                    $gyvu['buliai'][$arr[$i]]['pasarai'] += $mesl['buliai'] * $day;
                                    //viso
                                    $gyvu['buliai']['viso']['kiek']++;
                                    $gyvu['buliai']['viso']['pasarai'] += $mesl['buliai'] * $day;
                                }
                                if ($sk[7] < 12) {
                                    $gyvu['verseliai'][$arr[$i]]['kiek']++;
                                    $gyvu['verseliai'][$arr[$i]]['pasarai'] += $mesl['verseliai'] * $day;
                                    //viso
                                    $gyvu['verseliai']['viso']['kiek']++;
                                    $gyvu['verseliai']['viso']['pasarai'] += $mesl['verseliai'] * $day;
                                }
                            }

                            if ($one[0] == "Telyčaitė") {
                                if ($sk[7] >= 12) {
                                    $gyvu['telycios'][$arr[$i]]['kiek']++;
                                    $gyvu['telycios'][$arr[$i]]['pasarai'] += $mesl['telycios'] * $day;
                                    //viso
                                    $gyvu['telycios']['viso']['kiek']++;
                                    $gyvu['telycios']['viso']['pasarai'] += $mesl['telycios'] * $day;
                                }
                                if ($sk[7] < 12) {
                                    $gyvu['verseliai'][$arr[$i]]['kiek']++;
                                    $gyvu['verseliai'][$arr[$i]]['pasarai'] += $mesl['verseliai'] * $day;
                                    //viso
                                    $gyvu['verseliai']['viso']['kiek']++;
                                    $gyvu['verseliai']['viso']['pasarai'] += $mesl['verseliai'] * $day;
                                }
                            }
                        }

                    }
                    //var_dump($da); die;
                }

                $error['action'] = 2;
            }

            //$error['action'] = TRUE;
        }

        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Pašarai";
        $inf['active'] = "Ganykliniai pašarai";

        $this->load->model('ukininkai_model');
        $data = $this->ukininkai_model->ukininku_sarasas();

        $this->load->view("main_view", array('data'=> $data, 'error' => $error, 'inf' => $inf, 'gyvu' => $gyvu));
    }

    public function meslas(){
        $data = array();
        $error = array();

        $dt = $this->session->userdata();

        $this->load->model('ukininkai_model');
        $this->load->model('galvijai_model');
        $this->load->library('form_validation');
        $this->load->library('linksniai');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if($dt['vardas'] == "" AND $dt['pavarde'] == "") {
            $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required',  array('required' => 'Pasirinkite ūkininką.'));
            $ukininkas = $this->input->post('ukininko_vardas');
            $this->load->model('ukininkai_model');
            $uk = $this->ukininkai_model->ukininkas($ukininkas);
            $inf['vardas'] = $uk[0]['vardas'];
            $inf['pavarde'] = $uk[0]['pavarde'];
            $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
            $this->session->set_userdata($new);
        }else{
            $ukininkas = $dt['nr'];
            $inf['vardas'] = $dt['vardas'];
            $inf['pavarde'] = $dt['pavarde'];
        }
        $this->form_validation->set_rules('sezonas', 'Sezonas', 'required', array('required' => 'Pasirinkite sezoną.'));
        $this->form_validation->set_rules('laikotarpis', 'Laikotarpis', 'required', array('required' => 'Pasirinkite laikotarpį.'));

        $mesl = array(
            'karves' => '0.53',
            'telycios' => '0.53',
            'buliai' => '0.5',
            'verseliai' => '0.25',
        );

        $arr = array(
            '00', '11', '12', '01', '02', '03', '04'
        );


        if ($this->form_validation->run()) {
            $sezonas = $this->input->post('sezonas');
            $laikotarpis = $this->input->post('laikotarpis');

            $inf['sezonas'] = $sezonas;
            $inf['laikotarpis'] = $laikotarpis;
            //adresas prie kurio reikia prisjungti
            $gyvi_url = "https://www.vic.lt:8102/pls/gris/private.gyvuliu_sarasas";

            //sukuriam prisjijungima
            $ukis = $this->ukininkai_model->ukininkas($ukininkas);
            $auth = $ukis[0]['VIC_vartotojo_vardas'].":".$ukis[0]['VIC_slaptazodis'];

            if($laikotarpis != 0) {

                $gyvu = array(
                    'karves' => array('kiek' => 0, 'meslas' => 0, 'pavadinimas' => 'M. Karvės',),
                    'verseliai' => array('kiek' => 0, 'meslas' => 0, 'pavadinimas' => 'Veršeliai',),
                    'telycios' => array('kiek' => 0, 'meslas' => 0, 'pavadinimas' => 'Telyčios',),
                    'buliai' => array('kiek' => 0,  'meslas' => 0, 'pavadinimas' => 'Buliai',),
                );

                //metai persivercia, del to reik pasiziuret kuri menesi ziuri
                if ($laikotarpis == 1 OR $laikotarpis == 2) {
                    $met = $sezonas - 1;} else {$met = $sezonas;
                }
                $inf['metai'] = $met;
                //sugeneruojame data skirta siusti i VIC.LT
                $da = $met.'.'.$arr[$laikotarpis].'.'.cal_days_in_month(CAL_GREGORIAN, $arr[$laikotarpis], $met);
                //sukuriam masyva POST
                $post = ['v_data' => $da, 'v_rus' => 1];
                //nuskaitom VIC.LT
                $page = $this->galvijai_model->get_VIC($gyvi_url, $post, $auth);
                if (!$page['content']) {
                    //isvesti error jei negaunu duomenu is VIC.LT
                } else {
                    $data_gyvi = $this->galvijai_model->Gyvi_gyvunai($page['content']);
                    //apdoroti duomenis prie irasant i masyva
                    //var_dump($data_gyvi); die;
                    foreach ($data_gyvi as $sk) {
                        $one = explode(" ", $sk[4]);
                        if ($one[0] == "Karvė") {
                                $gyvu['karves']['kiek']++;
                                $gyvu['karves']['meslas'] += $mesl['karves'];
                        }

                        if ($one[0] == "Buliukas") {
                            if ($sk[7] >= 12) {
                                $gyvu['buliai']['kiek']++;
                                $gyvu['buliai']['meslas'] += $mesl['buliai'];
                            }
                            if ($sk[7] < 12) {
                                $gyvu['verseliai']['kiek']++;
                                $gyvu['verseliai']['meslas'] += $mesl['verseliai'];
                            }
                        }

                        if ($one[0] == "Telyčaitė") {
                            if ($sk[7] >= 12) {
                                $gyvu['telycios']['kiek']++;
                                $gyvu['telycios']['meslas'] += $mesl['telycios'];
                            }
                            if ($sk[7] < 12) {
                                $gyvu['verseliai']['kiek']++;
                                $gyvu['verseliai']['meslas'] += $mesl['verseliai'];
                            }
                        }
                    }

                }

                //var_dump($gyvu); die;

                $error['action'] = 1;

            }else{
                $gyvu = array(
                    'karves' => array('pavadinimas' => 'M. Karvės',
                        '11' => array('kiek' => 0, 'meslas' => 0,),
                        '12' => array('kiek' => 0, 'meslas' => 0,),
                        '01' => array('kiek' => 0, 'meslas' => 0,),
                        '02' => array('kiek' => 0, 'meslas' => 0,),
                        '03' => array('kiek' => 0, 'meslas' => 0,),
                        '04' => array('kiek' => 0, 'meslas' => 0,),
                        'viso' => array('kiek' => 0, 'meslas' => 0,)),
                    'verseliai' => array('pavadinimas' => 'Veršeliai',
                        '11' => array('kiek' => 0, 'meslas' => 0,),
                        '12' => array('kiek' => 0, 'meslas' => 0,),
                        '01' => array('kiek' => 0, 'meslas' => 0,),
                        '02' => array('kiek' => 0, 'meslas' => 0,),
                        '03' => array('kiek' => 0, 'meslas' => 0,),
                        '04' => array('kiek' => 0, 'meslas' => 0,),
                        'viso' => array('kiek' => 0, 'meslas' => 0,)),
                    'telycios' => array('pavadinimas' => 'Telyčios',
                        '11' => array('kiek' => 0, 'meslas' => 0,),
                        '12' => array('kiek' => 0, 'meslas' => 0,),
                        '01' => array('kiek' => 0, 'meslas' => 0,),
                        '02' => array('kiek' => 0, 'meslas' => 0,),
                        '03' => array('kiek' => 0, 'meslas' => 0,),
                        '04' => array('kiek' => 0, 'meslas' => 0,),
                        'viso' => array('kiek' => 0, 'meslas' => 0,)),
                    'buliai' => array('pavadinimas' => 'Buliai',
                        '11' => array('kiek' => 0, 'meslas' => 0,),
                        '12' => array('kiek' => 0, 'meslas' => 0,),
                        '01' => array('kiek' => 0, 'meslas' => 0,),
                        '02' => array('kiek' => 0, 'meslas' => 0,),
                        '03' => array('kiek' => 0, 'meslas' => 0,),
                        '04' => array('kiek' => 0, 'meslas' => 0,),
                        'viso' => array('kiek' => 0, 'meslas' => 0,)),
                );

                //metai persivercia, del to reik pasiziuret kuri menesi ziuri
                if ($laikotarpis == 1 OR $laikotarpis == 2) {
                    $met = $sezonas - 1;} else {$met = $sezonas;}

                for($i = 1; $i<count($arr); $i++) {
                    if ($arr[$i] == 11 OR $arr[$i] == 12) {
                        $met = $sezonas - 1;} else {$met = $sezonas;
                    }
                    //sugeneruojame data skirta siusti i VIC.LT
                    $da = $met.'.'.$arr[$i].'.'.cal_days_in_month(CAL_GREGORIAN, $arr[$i], $met);

                    //sukuriam masyva POST
                    $post = ['v_data' => $da, 'v_rus' => 1];

                    //nuskaitom VIC.LT
                $page = $this->galvijai_model->get_VIC($gyvi_url, $post, $auth);
                if (!$page['content']) {
                    //isvesti error jei negaunu duomenu is VIC.LT
                } else {
                    $data_gyvi = $this->galvijai_model->Gyvi_gyvunai($page['content']);
                    //apdoroti duomenis prie irasant i masyva
                    //var_dump($data_gyvi); die;
                    foreach ($data_gyvi as $sk) {
                        $one = explode(" ", $sk[4]);
                        if ($one[0] == "Karvė") {
                            $gyvu['karves'][$arr[$i]]['kiek']++;
                            $gyvu['karves'][$arr[$i]]['meslas'] += $mesl['karves'];
                            //viso
                            $gyvu['karves']['viso']['kiek']++;
                            $gyvu['karves']['viso']['meslas'] += $mesl['karves'];
                        }

                        if ($one[0] == "Buliukas") {
                            if ($sk[7] >= 12) {
                                $gyvu['buliai'][$arr[$i]]['kiek']++;
                                $gyvu['buliai'][$arr[$i]]['meslas'] += $mesl['buliai'];
                                //viso
                                $gyvu['buliai']['viso']['kiek']++;
                                $gyvu['buliai']['viso']['meslas'] += $mesl['buliai'];
                            }
                            if ($sk[7] < 12) {
                                $gyvu['verseliai'][$arr[$i]]['kiek']++;
                                $gyvu['verseliai'][$arr[$i]]['meslas'] += $mesl['verseliai'];
                                //viso
                                $gyvu['verseliai']['viso']['kiek']++;
                                $gyvu['verseliai']['viso']['meslas'] += $mesl['verseliai'];
                            }
                        }

                        if ($one[0] == "Telyčaitė") {
                            if ($sk[7] >= 12) {
                                $gyvu['telycios'][$arr[$i]]['kiek']++;
                                $gyvu['telycios'][$arr[$i]]['meslas'] += $mesl['telycios'];
                                //viso
                                $gyvu['telycios']['viso']['kiek']++;
                                $gyvu['telycios']['viso']['meslas'] += $mesl['telycios'];
                            }
                            if ($sk[7] < 12) {
                                $gyvu['verseliai'][$arr[$i]]['kiek']++;
                                $gyvu['verseliai'][$arr[$i]]['meslas'] += $mesl['verseliai'];
                                //viso
                                $gyvu['verseliai']['viso']['kiek']++;
                                $gyvu['verseliai']['viso']['meslas'] += $mesl['verseliai'];
                            }
                        }
                    }

                }
                //var_dump($da); die;
            }

                $error['action'] = 2;
            }

            //$error['action'] = TRUE;
        }

        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Pašarai";
        $inf['active'] = "Mėslo kiekis";

        $this->load->model('ukininkai_model');
        $data = $this->ukininkai_model->ukininku_sarasas();

        $this->load->view("main_view", array('data'=> $data, 'error' => $error, 'inf' => $inf, 'gyvu' => $gyvu));
    }


    public function normos(){
        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Pašarai";
        $inf['active'] = "Pašarų normos";

        $this->load->model('pasarai_model');
        $data = $this->pasarai_model->nuskaityti_viska();

        $this->load->view("main_view", array('data'=> $data, 'inf' => $inf));
    }

    public function naujos_normos(){
        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Pašarai";
        $inf['active'] = "Naujos pašarų normos";

        $this->load->model('pasarai_model');
        $data = array();
        $this->load->view("main_view", array('data'=> $data, 'inf' => $inf));
    }

    public function rankinis_pasarus(){
        //kintamieji
        $error = array();
        $laiko = array();
        $inf = array();
        $num_day = 0;
        $this->load->library('form_validation');
        $this->load->library('linksniai');
        $this->load->model('pasarai_model');
        $data = array(
            'karves' => array('pavadinimas' => "", 'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'telycios_6_12' => array('pavadinimas' => "", 'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'buliai_6_12' => array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'telycios_12_24' => array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'verseliai_6' => array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'buliai_12_24' => array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'telycios_24' => array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'buliai_24' =>  array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
        );

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        foreach($data as $key => $row){
            $this->form_validation->set_rules($key, $row['pavadinimas'], 'is_natural', array('is_natural' => 'Turi būti įrašytas skaičius!'));
        }

        $this->form_validation->set_rules('vardas', 'Įveskite vardą', 'required', array('required' => 'Įveskite ūkininko vardą'));
        $this->form_validation->set_rules('pavarde', 'Įveskite pavardę', 'required', array('required' => 'Įveskite ūkininko pavardę!'));

        if ($this->form_validation->run()) {
            foreach($data as $key => $row){
                $data[$key]['kiek'] = $this->input->post($key);
            }
            $vardas = $this->input->post('vardas');
            $pavarde = $this->input->post('pavarde');
            $menesis = $this->input->post('menesis');
            $laikotarpis = $this->input->post('laikotarpis');

            $metai = 2017;
            $inf['metai'] = $metai;
            $inf['menesis'] = $menesis;
            $inf['vardas'] = $vardas;
            $inf['pavarde'] = $pavarde;


            //patikrinam kokie pasirinkimai yra, kad maziau nesusipratimu skaiciuojant
            if(!$menesis AND !$laikotarpis){
                $error['laikas'] = "Pasirinkite mėnesį arba laikotarpį kuriam skaičiuosime pašarus.";}
            if($menesis AND $laikotarpis){
                $error['laikas2'] = "Pasirinkite TIK mėnesį arba TIK laikotarpį kuriam skaičiuosime pašarus.";}

            if($menesis AND !$laikotarpis) {
                //skaiciuojam nurodyto menesio pasaru kieki galvijams
                //nuskaitom visus gyvulius, pasirinkto menesio
                foreach ($data as $key => $row) {
                    $duo = $this->pasarai_model->nuskaityti_pasarus($key);
                    $ke = array_keys($duo[0]);
                    $data[$key]['pavadinimas'] = $duo[0]['gyvuliai'];
                    $num_day = cal_days_in_month(CAL_GREGORIAN, $menesis, $metai);
                    for ($i = 3; $i < 11; $i++) {
                        if ($duo[0][$ke[$i]] != 0) {
                            if (strstr($duo[0][$ke[$i]], '-')) {
                                $sie = explode("-", $duo[0][$ke[$i]]);
                                $min = $sie[0];
                                $vid = ($sie[0] + $sie[1]) / 2;
                                $max = $sie[1];
                            } else {
                                $min = $vid = $max = $duo[0][$ke[$i]];
                            }
                            //skaiciuojam pasaru kiekius i masyva
                            $data[$key][$ke[$i]]['min'] = (int)$data[$key]['kiek'] * $min * $num_day;
                            $data[$key][$ke[$i]]['vid'] = (int)$data[$key]['kiek'] * $vid * $num_day;
                            $data[$key][$ke[$i]]['max'] = (int)$data[$key]['kiek'] * $max * $num_day;
                        }
                    }
                }

                //suskaiciuoti lenteleje, viso kiekius
                $keys = array_keys($data['karves']);
                foreach ($keys as $ro) {
                    $sum = $ro;
                    if ($ro != 'kiek') {
                        $data['viso'][$ro]['vid'] = @array_reduce($data,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['vid'];
                                return $runningTotal;
                            }, 0);
                        $data['viso'][$ro]['min'] = @array_reduce($data,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['min'];
                                return $runningTotal;
                            }, 0);
                        $data['viso'][$ro]['max'] = @array_reduce($data,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['max'];
                                return $runningTotal;
                            }, 0);
                    } else {
                        $data['viso'][$ro] = @array_reduce($data,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum];
                                return $runningTotal;
                            }, 0);
                    }
                }
                $data['viso']['pavadinimas'] = "Viso:";
            }

            //pradedam skaiciuoti ketvircius ir pusmecius
            if(!$menesis AND $laikotarpis){
                if($laikotarpis == 1){
                    $laiko = array(1, 2, 3, 4, 5, 6);
                    $inf['laikotarpis'] = 'I pusmetis';}
                if($laikotarpis == 2){
                    $laiko = array(7, 8, 9, 10, 11, 12);
                    $inf['laikotarpis'] = 'II pusmetis';}
                if($laikotarpis == 3){
                    $laiko = array(1, 2, 3);
                    $inf['laikotarpis'] = 'I ketvirtis';}
                if($laikotarpis == 4){
                    $laiko = array(4, 5, 6);
                    $inf['laikotarpis'] = 'II ketvirtis';}
                if($laikotarpis == 5){
                    $laiko = array(7, 8, 9);
                    $inf['laikotarpis'] = 'III ketvirtis';}
                if($laikotarpis == 6){
                    $laiko = array(10, 11, 12);
                    $inf['laikotarpis'] = 'IV ketvirtis';}

                if(is_array($laiko)){
                    foreach($laiko as $lk){
                        //suskaiciuojam kiek dienu turi
                        $num_day = $num_day + cal_days_in_month(CAL_GREGORIAN, $lk, $metai);
                    }
                }

                //skaiciuojam pasarus
                foreach ($data as $key => $row) {
                    $duo = $this->pasarai_model->nuskaityti_pasarus($key);
                    $ke = array_keys($duo[0]);
                    $data[$key]['pavadinimas'] = $duo[0]['gyvuliai'];
                    for ($i = 3; $i < 11; $i++) {
                        if ($duo[0][$ke[$i]] != 0) {
                            if (strstr($duo[0][$ke[$i]], '-')) {
                                $sie = explode("-", $duo[0][$ke[$i]]);
                                $min = $sie[0];
                                $vid = ($sie[0] + $sie[1]) / 2;
                                $max = $sie[1];
                            } else {
                                $min = $vid = $max = $duo[0][$ke[$i]];
                            }
                            //skaiciuojam pasaru kiekius i masyva
                            $data[$key][$ke[$i]]['min'] = (int)$data[$key]['kiek'] * $min*$num_day;
                            $data[$key][$ke[$i]]['vid'] = (int)$data[$key]['kiek'] * $vid*$num_day;
                            $data[$key][$ke[$i]]['max'] = (int)$data[$key]['kiek'] * $max*$num_day;
                        }
                    }
                }
                //suskaiciuoti lenteleje, viso kiekius
                $keys = array_keys($data['karves']);
                foreach ($keys as $ro) {
                    $sum = $ro;
                    if ($ro != 'kiek') {
                        $data['viso'][$ro]['vid'] = @array_reduce($data,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['vid'];
                                return $runningTotal;
                            }, 0);
                        $data['viso'][$ro]['min'] = @array_reduce($data,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['min'];
                                return $runningTotal;
                            }, 0);
                        $data['viso'][$ro]['max'] = @array_reduce($data,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['max'];
                                return $runningTotal;
                            }, 0);
                    } else {
                        $data['viso'][$ro] = @array_reduce($data,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum];
                                return $runningTotal;
                            }, 0);
                    }
                }
                $data['viso']['pavadinimas'] = "Viso:";
            }
            $error['action'] = true;
        }else{
            //idedam input pavadinimus
            foreach ($data as $key => $row) {
                $duo = $this->pasarai_model->nuskaityti_pasarus($key);
                $data[$key]['pavadinimas'] = $duo[0]['gyvuliai'];
            }
        }
        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Pašarai";
        $inf['active'] = "Rankinis pašarų skaičiavimas";

            $this->load->view("main_view", array('data'=> $data, 'error' => $error, 'inf' => $inf));
    }

    public function apskaiciuoti_pasarus(){
        $this->load->library('linksniai');
        //kintamieji
        $error = array();
        $laiko = array();
        $inf = array();
        $num_day = 0;
        $gyvu = array(
            'karves' => array('pavadinimas' => "", 'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'telycios_6_12' => array('pavadinimas' => "", 'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'buliai_6_12' => array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'telycios_12_24' => array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'verseliai_6' => array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'buliai_12_24' => array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'telycios_24' => array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
            'buliai_24' =>  array('pavadinimas' => "",'kiek' => 0,
                'sienas' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'siaudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'grudai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sakniavaisiai' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'sienainis' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'bulves' => array('min' => 0, 'vid' => 0, 'max' => 0),
                'silosas' => array('min' => 0, 'vid' => 0, 'max' => 0)),
        );
        //nerodo ukiniko prie lenteles, jis ir nebutinas?
        $dt = $this->session->userdata();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if($dt['vardas'] == "" AND $dt['pavarde'] == "") {
            $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required',  array('required' => 'Pasirinkite ūkininką.'));
            $ukininkas = $_POST['ukininko_vardas'];
            $this->load->model('ukininkai_model');
            $uk = $this->ukininkai_model->ukininkas($ukininkas);
            $inf['vardas'] = $uk[0]['vardas'];
            $inf['pavarde'] = $uk[0]['pavarde'];
            $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
            $this->session->set_userdata($new);
        }else{
            $ukininkas = $dt['nr'];
            $inf['vardas'] = $dt['vardas'];
            $inf['pavarde'] = $dt['pavarde'];
        }
        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
        //$this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

        if ($this->form_validation->run()) {
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');
            $laikotarpis = $this->input->post('laikotarpis');

            $inf['metai'] = $metai;
            $inf['menesis'] = $menesis;

            //patikrinam kokie pasirinkimai yra, kad maziau nesusipratimu skaiciuojant
            if(!$menesis AND !$laikotarpis){
                $error['laikas'] = "Pasirinkite mėnesį arba laikotarpį kuriam skaičiuosime pašarus.";}
            if($menesis AND $laikotarpis){
                $error['laikas2'] = "Pasirinkite TIK mėnesį arba TIK laikotarpį kuriam skaičiuosime pašarus.";}

            $this->load->model('galvijai_model');
            if($menesis AND !$laikotarpis) {
                //skaiciuojam nurodyto menesio pasaru kieki galvijams
                //nuskaitom visus gyvulius, pasirinkto menesio
                $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
                $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);

                foreach ($rezultatai as $sk) {
                    $one = explode(" ", $sk['lytis']);
                    if ($sk['amzius'] != "") {
                        if ($one[0] == "Karvė") {
                            $gyvu['karves']['kiek']++;
                        }
                        if ($one[0] == "Buliukas") {
                            if ($sk['amzius'] >= 6 AND $sk['amzius'] < 12) {
                                $gyvu['buliai_6_12']['kiek']++;}
                            if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                                $gyvu['buliai_12_24']['kiek']++;}
                            if ($sk['amzius'] >= 24) {
                                $gyvu['buliai_24']['kiek']++;}
                            if ($sk['amzius'] < 6 AND $sk['amzius'] != "") {
                                $gyvu['verseliai_6']['kiek']++;}
                        }
                        if ($one[0] == "Telyčaitė") {
                            if ($sk['amzius'] >= 6 AND $sk['amzius'] < 12) {
                                $gyvu['telycios_6_12']['kiek']++;}
                            if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                                $gyvu['telycios_12_24']['kiek']++;}
                            if ($sk['amzius'] >= 24) {
                                $gyvu['telycios_24']['kiek']++;}
                            if ($sk['amzius'] < 6 AND $sk['amzius'] != "") {
                                $gyvu['verseliai_6']['kiek']++;}
                        }
                    }
                }
                $this->load->model('pasarai_model');
                //skaiciuojam pasarus
                foreach ($gyvu as $key => $row) {
                    $duo = $this->pasarai_model->nuskaityti_pasarus($key);
                    $ke = array_keys($duo[0]);
                    $gyvu[$key]['pavadinimas'] = $duo[0]['gyvuliai'];
                    $num_day = cal_days_in_month(CAL_GREGORIAN, $menesis, $metai);
                    for ($i = 3; $i < 11; $i++) {
                        if ($duo[0][$ke[$i]] != 0) {
                            if (strstr($duo[0][$ke[$i]], '-')) {
                                $sie = explode("-", $duo[0][$ke[$i]]);
                                $min = $sie[0];
                                $vid = ($sie[0] + $sie[1]) / 2;
                                $max = $sie[1];
                            } else {
                                $min = $vid = $max = $duo[0][$ke[$i]];
                            }
                            //skaiciuojam pasaru kiekius i masyva
                            $gyvu[$key][$ke[$i]]['min'] = $gyvu[$key]['kiek'] * $min*$num_day;
                            $gyvu[$key][$ke[$i]]['vid'] = $gyvu[$key]['kiek'] * $vid*$num_day;
                            $gyvu[$key][$ke[$i]]['max'] = $gyvu[$key]['kiek'] * $max*$num_day;
                        }
                    }
                }
                //suskaiciuoti lenteleje, viso kiekius
                $keys = array_keys($gyvu['karves']);
                foreach ($keys as $ro) {
                    $sum = $ro;
                    if ($ro != 'kiek') {
                        $gyvu['viso'][$ro]['vid'] = @array_reduce($gyvu,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['vid'];
                                return $runningTotal;
                            }, 0);
                        $gyvu['viso'][$ro]['min'] = @array_reduce($gyvu,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['min'];
                                return $runningTotal;
                            }, 0);
                        $gyvu['viso'][$ro]['max'] = @array_reduce($gyvu,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['max'];
                                return $runningTotal;
                            }, 0);
                    } else {
                        $gyvu['viso'][$ro] = @array_reduce($gyvu,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum];
                                return $runningTotal;
                            }, 0);
                    }
                }
                $gyvu['viso']['pavadinimas'] = "Viso:";
            }
            //pradedam skaiciuoti ketvircius ir pusmecius
            if(!$menesis AND $laikotarpis){
                if($laikotarpis == 1){
                    $laiko = array(1, 2, 3, 4, 5, 6);
                    $inf['laikotarpis'] = 'I pusmetis';}
                if($laikotarpis == 2){
                    $laiko = array(7, 8, 9, 10, 11, 12);
                    $inf['laikotarpis'] = 'II pusmetis';}
                if($laikotarpis == 3){
                    $laiko = array(1, 2, 3);
                    $inf['laikotarpis'] = 'I ketvirtis';}
                if($laikotarpis == 4){
                    $laiko = array(4, 5, 6);
                    $inf['laikotarpis'] = 'II ketvirtis';}
                if($laikotarpis == 5){
                    $laiko = array(7, 8, 9);
                    $inf['laikotarpis'] = 'III ketvirtis';}
                if($laikotarpis == 6){
                    $laiko = array(10, 11, 12);
                    $inf['laikotarpis'] = 'IV ketvirtis';}

                if(is_array($laiko)){
                    foreach($laiko as $lk){
                        //suskaiciuojam kiek dienu turi
                        $num_day = $num_day + cal_days_in_month(CAL_GREGORIAN, $lk, $metai);
                        //nuskaitom visus gyvulius, pasirinkto menesio
                        $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $lk);
                        $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);

                        foreach ($rezultatai as $sk) {
                            $one = explode(" ", $sk['lytis']);
                            if ($one[0] == "Karvė") {
                                if ($sk['amzius'] != "") {
                                    $gyvu['karves']['kiek']++;}
                            }

                            if ($one[0] == "Buliukas") {
                                if ($sk['amzius'] >= 6 AND $sk['amzius'] < 12) {
                                    $gyvu['buliai_6_12']['kiek']++;}
                                if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                                    $gyvu['buliai_12_24']['kiek']++;}
                                if ($sk['amzius'] >= 24) {
                                    $gyvu['buliai_24']['kiek']++;}
                                if ($sk['amzius'] < 6 AND $sk['amzius'] != "") {
                                    $gyvu['verseliai_6']['kiek']++;}
                            }

                            if ($one[0] == "Telyčaitė") {
                                if ($sk['amzius'] >= 6 AND $sk['amzius'] < 12) {
                                    $gyvu['telycios_6_12']['kiek']++;}
                                if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                                    $gyvu['telycios_12_24']['kiek']++;}
                                if ($sk['amzius'] >= 24) {
                                    $gyvu['telycios_24']['kiek']++;}
                                if ($sk['amzius'] < 6 AND $sk['amzius'] != "") {
                                    $gyvu['verseliai_6']['kiek']++;}
                            }
                        }
                    }
                }
                $this->load->model('pasarai_model');
                //skaiciuojam pasarus
                foreach ($gyvu as $key => $row) {
                    $duo = $this->pasarai_model->nuskaityti_pasarus($key);
                    $ke = array_keys($duo[0]);
                    $gyvu[$key]['pavadinimas'] = $duo[0]['gyvuliai'];
                    for ($i = 3; $i < 11; $i++) {
                        if ($duo[0][$ke[$i]] != 0) {
                            if (strstr($duo[0][$ke[$i]], '-')) {
                                $sie = explode("-", $duo[0][$ke[$i]]);
                                $min = $sie[0];
                                $vid = ($sie[0] + $sie[1]) / 2;
                                $max = $sie[1];
                            } else {
                                $min = $vid = $max = $duo[0][$ke[$i]];
                            }
                            //skaiciuojam pasaru kiekius i masyva
                            $gyvu[$key][$ke[$i]]['min'] = $gyvu[$key]['kiek'] * $min*$num_day;
                            $gyvu[$key][$ke[$i]]['vid'] = $gyvu[$key]['kiek'] * $vid*$num_day;
                            $gyvu[$key][$ke[$i]]['max'] = $gyvu[$key]['kiek'] * $max*$num_day;
                        }
                    }
                }
                //suskaiciuoti lenteleje, viso kiekius
                $keys = array_keys($gyvu['karves']);
                foreach ($keys as $ro) {
                    $sum = $ro;
                    if ($ro != 'kiek') {
                        $gyvu['viso'][$ro]['vid'] = @array_reduce($gyvu,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['vid'];
                                return $runningTotal;
                            }, 0);
                        $gyvu['viso'][$ro]['min'] = @array_reduce($gyvu,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['min'];
                                return $runningTotal;
                            }, 0);
                        $gyvu['viso'][$ro]['max'] = @array_reduce($gyvu,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum]['max'];
                                return $runningTotal;
                            }, 0);
                    } else {
                        $gyvu['viso'][$ro] = @array_reduce($gyvu,
                            function ($runningTotal, $record) use ($sum) {
                                $runningTotal += $record[$sum];
                                return $runningTotal;
                            }, 0);
                    }
                }
                $gyvu['viso']['pavadinimas'] = "Viso:";
            }
            $error['action'] = true;
        }
        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Pašarai";
        $inf['active'] = "Pašarų skaičiavimas";

        $this->load->model('ukininkai_model');
        $data = $this->ukininkai_model->ukininku_sarasas();
        $this->load->view("main_view", array('data'=> $data, 'error' => $error, 'gyvu'=>$gyvu, 'inf'=>$inf));
    }
}
?>
