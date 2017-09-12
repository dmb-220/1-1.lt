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
class Gyvuliai extends CI_Controller {



//va, dabar galesi naudoti $this->gyvuliai
// tai ir is model medotu prieisiu prie sio masyvo?
// norit prieiti is modelio, turetum tada tiesiai kreiptis i sita klase. kaip modelyje pasiimi sita klase ? aj ble,... cia kontrolleris, tada ta pati gali modelyje padaryti ir bus tas pats.
//supratau, dekui uz paasikinimus, bandysiu persidaryti
// cia ner kas ;D
    public function __construct(){
        parent::__construct();
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        if (!$this->ion_auth->logged_in()) {
            redirect('main/auth_error');
        }
    }

    //jei kas bandys atidaryti index puslapi bus nukreiptas i pagrindini
    public function index(){
        redirect('main');
    }
    ///////////////////////////////////////////// RODOMAS GYVULIU SARASAS //////////////////////////////////////////////
    public function gyvuliu_sarasas(){
        $error = array();
        $gyvu = array();
        $dt = $this->session->userdata();

        $this->load->model('ukininkai_model');
        $this->load->model('gyvuliai_model');
        $this->load->library('linksniai');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($dt['vardas'] == "" AND $dt['pavarde'] == "") {
                $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required', array('required' => 'Pasirinkite ūkininką.'));
                $ukininkas = $_POST['ukininko_vardas'];
                $this->load->model('ukininkai_model');
                $uk = $this->ukininkai_model->ukininkas($ukininkas);
                $inf['vardas'] = $uk[0]['vardas'];
                $inf['pavarde'] = $uk[0]['pavarde'];
                $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
                $this->session->set_userdata($new);
            } else {
                $ukininkas = $dt['nr'];
                $inf['vardas'] = $dt['vardas'];
                $inf['pavarde'] = $dt['pavarde'];
            }

            $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
            $this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

            if ($this->form_validation->run()) {
                $metai = $this->input->post('metai');
                $menesis = $this->input->post('menesis');

                $inf['metai'] = $metai;
                $inf['menesis'] = $menesis;

                $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
                $psl = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
                for($i = 0; $i < count($psl); $i++){
                    $gyvu[$i]['numeris'] = $psl[$i]['numeris'];
                    $gyvu[$i]['lytis'] = $psl[$i]['lytis'];
                    $gyvu[$i]['veisle'] = $psl[$i]['veisle'];
                    $gyvu[$i]['gimimo_data'] = $psl[$i]['gimimo_data'];
                    $gyvu[$i]['laikymo_pradzia'] = $psl[$i]['laikymo_pradzia'];
                    $gyvu[$i]['laikymo_pabaiga'] = $psl[$i]['laikymo_pabaiga'];
                    $gyvu[$i]['amzius'] = $psl[$i]['amzius'];
                    $gyvu[$i]['informacija'] = $psl[$i]['informacija'];
                }

                $error['action'] = true;
            }
        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Gyvuliai";
        $inf['active'] = "Gyvulių sąrašas";

            $data = $this->ukininkai_model->ukininku_sarasas();
            $this->load->view("main_view", array('data' => $data, 'gyvu' => $gyvu, 'error' => $error, 'inf' => $inf));
    }

    ///////////////////////////////////////////// IKELIAMI DUOMENYS IS VIC.LT  //////////////////////////////////////////////
    public function nuskaityti_vic(){
        $error = array();
        $dt = $this->session->userdata();

        $this->load->model('ukininkai_model');
        $this->load->model('gyvuliai_model');
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

        $this->form_validation->set_rules('data1', 'Data-1', 'required', array('required' => 'Pasirinkite data.'));
        $this->form_validation->set_rules('data2', 'Data-2', 'required', array('required' => 'Pasirinkite data.'));

        if ($this->form_validation->run()) {
            $data1 = $this->input->post('data1');
            $data2 = $this->input->post('data2');

            $inf['data1'] = $data1;
            $inf['data2'] = $data2;

            $menesis = explode("-", $data2);
            $menesis = $menesis[1];

            $metai = explode("-", $data2);
            $metai = $metai[0];

            $gyvi_url = "https://www.vic.lt:8102/pls/gris/private.gyvuliu_sarasas";
            $visi_url = "https://www.vic.lt:8102/pls/gris/private.laikytojo_gyvuliai_frame";

            $ukis = $this->ukininkai_model->ukininkas($ukininkas);
            $auth = $ukis[0]['VIC_vartotojo_vardas'].":".$ukis[0]['VIC_slaptazodis'];

            $post1 = ['v_data' => $data2, 'v_rus' => 1];
            $post2 = ['v_nuo' => $data1,'v_iki' => $data2, 'v_rus' => 1];

            $page = $this->gyvuliai_model->get_VIC($gyvi_url, $post1, $auth);
            $page2 = $this->gyvuliai_model->get_VIC($visi_url, $post2, $auth);

            $data_gyvi = $this->gyvuliai_model->Gyvi_gyvunai($page['content']);
            $data_visi = $this->gyvuliai_model->Visi_gyvunai($page2['content']);

            //apdoroti duomenis prie irasant i duomenu baze.
            //kiekviena irasa reikia patikrinti, artoks nera, nes prie visi gyvuliai dubliuojasi
            $kiek = $this->gyvuliai_model->tikinti_gyvulius_ikelti($metai, $menesis, $ukininkas);
            $men = array("Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa",
                "Rugpjūtis", "Rugsejis", "Spalis","Lapkritis", "Gruodis");
            //reik patikrinti ar antra karta neitraukia gyvulio ta pati menesi
            //buna kad prie visu gyvuliu pagal nr dubliuojasi
            if($kiek>0){
                $error = array('jau_yra' => $metai.' '.$men[$menesis-1].', jau esate pridejes gyvulius!');
            }else{
                //ikelia duomenis i duomenu baze
                $this->gyvuliai_model->Irasyti_visus($data_visi, $ukininkas, $metai, $menesis);
                $this->gyvuliai_model->Atnaujinti_visus($data_gyvi, $ukininkas, $metai, $menesis);
                $error = array('OK' => $metai.' '.$men[$menesis-1].' gyvuliai įtraukti į duomenų bazę!');
            }
        }
        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Gyvuliai";
        $inf['url'] = "main/index";
        $inf['active'] = "Naujų gyvulių įtraukimas";

        $data = $this->ukininkai_model->ukininku_sarasas();
        $this->load->view("main_view", array('data'=> $data, 'error' => $error, 'inf' => $inf));
    }

    ///////////////////////////////////////////// SKAICIUOJAMI GYVULIAI //////////////////////////////////////////////
    public function skaiciuoti_gyvulius(){
        $error = array();
        $inf = array();

        
        $dt = $this->session->userdata();

        $this->load->library('linksniai');
        $this->load->model('gyvuliai_model');
        $this->load->library('table');
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
        $this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

        if ($this->form_validation->run()) {
            //gaunami ukininko nustatymai
            $set = $this->gyvuliai_model->nustatymai($dt['nr']);

            //$this->gyvuliai_model->gyvuliai; // va.

            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');

            $inf['metai'] = $metai;
            $inf['menesis'] = $menesis;
            $inf['karves'] = $set[0]['karves'];

            $this->load->model('gyvuliai_model');
            //nuskaitom visus gyvulius, pasirinkto menesio
            $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
            $rezultatai_dabar = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
            //pakeiciam kintamuju vardus, jei pagrindinius noresim veliau panaudoti kad nesusigadintu
            $met = $metai;  $men = $menesis;
            if($men>1){$men--; }else{$men=12; $met--;}
            //nuskaitom visus gyvulius, pries tai buvusio menesio
            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'amzius !=' => "" );
            $rezultatai_vakar = $this->gyvuliai_model->nuskaityti_gyvulius($dat);

            //nuskaitom gyvuliu kieki menesio pradzioje, tik kieki, daugiau nieko nereikia
            foreach($rezultatai_vakar as $sk){
                $one = explode(" ", $sk['lytis']);
                if($one[0] == "Karvė"){
                    //skirstom i mesines ir melzamas karves
                    $this->gyvuliai_model->gyvuliai['karves']['pradzia']++;
                    //if($set[0]['karves'] == 1){$gyvuliai['karves']['pradzia']++;}
                   // if($set[0]['karves'] == 2){$gyvuliai['karves2']['pradzia']++;}
                    //if($set[0]['karves'] == 3){
                        //if($sk['veisle'] == 'Limuzinai'){
                            //$gyvuliai['karves2']['pradzia']++;}else{$gyvuliai['karves']['pradzia']++;}
                    //}
                }

                if($one[0] == "Buliukas"){
                    if($sk['amzius']>=12 AND $sk['amzius']<24){
                        $this->gyvuliai_model->gyvuliai['buliai_12']['pradzia']++;
                    }
                    if($sk['amzius']>=24){
                        $this->gyvuliai_model->gyvuliai['buliai_24']['pradzia']++;
                    }
                    if($sk['amzius']<12 AND $sk['amzius']!=""){
                        $this->gyvuliai_model->gyvuliai['verseliai']['pradzia']++;
                    }
            }

                if($one[0] == "Telyčaitė"){
                    if($sk['amzius']>=12 AND $sk['amzius']<24){
                        $this->gyvuliai_model->gyvuliai['telycios_12']['pradzia']++;
                    }
                    if($sk['amzius']>=24){
                        $this->gyvuliai_model->gyvuliai['telycios_24']['pradzia']++;
                    }
                    if($sk['amzius']<12 AND $sk['amzius']!=""){
                        $this->gyvuliai_model->gyvuliai['verseliai']['pradzia']++;
                    }
                }
            }

            //skaiciuojam kiek gyvuliu menesio gale
            //$k = $b12 = $b24 = $v = $t12 = $t24 = 0;
            foreach($rezultatai_dabar as $sk){
                $one = explode(" ", $sk['lytis']);
                //Karviu skaiciavimas
                if($one[0] == "Karvė"){
                    if($sk['amzius'] != ""){
                        $this->gyvuliai_model->gyvuliai['karves']['pabaiga']++;

                        $laikas = explode(".",$sk['laikymo_pradzia']);
                        if($laikas[0] == $metai AND $laikas[1] == $menesis){
                            $this->gyvuliai_model->gyvuliai['karves']['pirkimai']++;
                        }

                        //$this->gyvuliai_model->karviu_judejimas($this->gyvuliai_model->gyvuliai);

                        $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                        $pi = $this->gyvuliai_model->nuskaityti_gyvulius($dat);

                        if (!empty($pi)) {
                            if ($pi[0]['lytis'] == "Telyčaitė (Karvė)" OR $pi[0]['lytis'] == "Telyčaitė (Telyčaitė)") {
                                //reikia patikrinti amziu, nes i karves gali judeti ir is telyciu iki 24 menesiu
                                if($pi[0]['amzius']>=24){
                                    $this->gyvuliai_model->gyvuliai['karves']['j_i']++; $this->gyvuliai_model->gyvuliai['telycios_24']['j_is']++;
                                }else{
                                    $this->gyvuliai_model->gyvuliai['telycios_12']['j_is']++; $this->gyvuliai_model->gyvuliai['karves']['j_i']++;
                                }
                            }
                        }
                    }else{
                        //is telyciu pereina i karves ir parduodama, dingsta
                        $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                        $pi = $this->gyvuliai_model->nuskaityti_gyvulius($dat);

                        if (!empty($pi)) {
                            if ($pi[0]['lytis'] == "Telyčaitė (Karvė)" OR $pi[0]['lytis'] == "Telyčaitė (Telyčaitė)") {
                                //reikia patikrinti amziu, nes i karves galiu judeti ir is telyciu iki 24 menesiu
                                if($pi[0]['amzius']>=24){
                                    $this->gyvuliai_model->gyvuliai['karves']['j_i']++; $this->gyvuliai_model->gyvuliai['telycios_24']['j_is']++;
                                }else{
                                    $this->gyvuliai_model->gyvuliai['telycios_12']['j_is']++; $this->gyvuliai_model->gyvuliai['karves']['j_i']++;
                                }
                            }
                        }
                        //tikrinsim pagal ivykio koda kas nutiko gyvuliui
                        $pp = $this->gyvuliai_model->ivykio_kodas($sk['laikymo_pabaiga']);

                        if($pp == '07' || $pp[1] == '05'){
                            $this->gyvuliai_model->gyvuliai['karves']['parduota']++;
                        }
                        if($pp == '03'){
                            $this->gyvuliai_model->gyvuliai['karves']['kritimai']++;
                        }
                        if($pp == '14'){
                            $this->gyvuliai_model->gyvuliai['karves']['suvartota']++;
                        }
                        if($pp == '02'){
                            $this->gyvuliai_model->gyvuliai['karves']['parduota']++;
                        }
                    }
                }

                //Buliuku skaiciavimas
                if($one[0] == "Buliukas"){
                    //buliukai nuo 12 iki 24
                    if($sk['amzius']>=12 AND $sk['amzius']<24){
                        $this->gyvuliai_model->gyvuliai['buliai_12']['pabaiga']++;
                        if($sk['amzius']>=12 AND $sk['amzius']<14) {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
                            if (!empty($am)) {
                                if ($am[0]['amzius'] < 12) {
                                    $this->gyvuliai_model->gyvuliai['buliai_12']['j_i']++;
                                    $this->gyvuliai_model->gyvuliai['verseliai']['j_is']++;
                                }
                            }
                        }
                                $lka = explode(".", $sk['laikymo_pradzia']);
                                $info = explode(" ",$sk['informacija']);
                                if($lka[0] == $metai AND $lka[1] == $menesis AND $info[1] == 'Atvyko'){
                                    $this->gyvuliai_model->gyvuliai['buliai_12']['pirkimai']++;
                                }

                    }

                    //Buliukai virs 24
                    if ($sk['amzius'] >= 24) {
                        $this->gyvuliai_model->gyvuliai['buliai_24']['pabaiga']++;
                        $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                        $am = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
                        if(!empty($am)){
                            if($am[0]['amzius']<24){
                                $this->gyvuliai_model->gyvuliai['buliai_24']['j_i']++; $this->gyvuliai_model->gyvuliai['buliai_12']['j_is']++;
                            }
                        }
                            $lk = explode(".", $sk['laikymo_pradzia']);
                            $info = explode(" ",$sk['informacija']);
                            if($lk[0] == $metai AND $lk[1] == $menesis AND $info[1] == 'Atvyko'){
                                $this->gyvuliai_model->gyvuliai['buliai_24']['pirkimai']++;
                            }
                    }

                    //Buliukai mezesni negu 12
                    if ($sk['amzius']<12 AND $sk['amzius'] != "") {
                        $this->gyvuliai_model->gyvuliai['verseliai']['pabaiga']++;
                        //$debug2['verseliai'][$v] = $sk;
                        //$v++;

                        //tikrinti gimimus pagal laikymo pradzia, nes jei pagal gimimo data buna kad neatitinka data, buna gimsta sausi, laikymo pradzia vasari
                        //nevisada pagal gimimo data tinka gimimui indentifikuoti
                        //$gd = explode(".", $sk['gimimo_data']);
                        $lp = explode(".", $sk['laikymo_pradzia']);
                        $info = explode(" ",$sk['informacija']);
                        if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs'){
                            $this->gyvuliai_model->gyvuliai['verseliai']['gimimai']++;
                        }
                        //reik del gimimu dar patikrinti ar nera atgaline tvarka irasytas
                        if($lp[0] == $metai AND $lp[1] == $menesis-1 AND $info[1] == 'Gimęs') {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
                            if(empty($am)){
                                $this->gyvuliai_model->gyvuliai['verseliai']['gimimai']++;
                        }
                    }
                        if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Atvyko'){
                            $this->gyvuliai_model->gyvuliai['verseliai']['pirkimai']++;
                        }
                    }

                    //jei yra tuscias, reikia gyvuliai kazkur iskeliavo, reik issiaiskintu kur
                    if($sk['amzius']==""){
                        $pr = str_replace(".", "-", $sk['gimimo_data']);
                        if(strstr($sk['laikymo_pabaiga'], '*')){
                            $pp = explode("*", $sk['laikymo_pabaiga']);
                            $pp = explode(" ", $pp[1]);
                        }else{
                            $pp = explode(" ", $sk['laikymo_pabaiga']);
                        }

                        $pb = str_replace(".", "-", $pp[0]);
                        $pb = str_replace(">", "", $pb);

                        $da = $this->gyvuliai_model->dateDifference($pr, $pb, '%y-%m-%d');
                        $dd = explode("-", $da);
                        $mo = $dd[0] * 12 + $dd[1];

                        //reik atsifiltruoti dingimo koduka, gali buti ne tik parduota bet ir kritimas arba suvartota sau
                       $pa = $this->gyvuliai_model->ivykio_kodas($sk['laikymo_pabaiga']);


                        if ($mo >= 12 AND $mo < 24) {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
                            if($am[0]['amzius']<12){
                                $this->gyvuliai_model->gyvuliai['verseliai']['j_is']++;
                                $this->gyvuliai_model->gyvuliai['buliai_12']['j_i']++;
                            }
                            //pardavimai
                            if($pa == '07' || $pa == '05') {$this->gyvuliai_model->gyvuliai['buliai_12']['parduota']++;}
                            //suvartota
                            if($pa == '14') {$this->gyvuliai_model->gyvuliai['buliai_12']['suvartota']++;}
                            //kritimai
                            if($pa == '03') {$this->gyvuliai_model->gyvuliai['buliai_12']['kritimai']++;}
                        }
                        if ($mo >= 24) {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
                            if($am[0]['amzius']<24){
                                $this->gyvuliai_model->gyvuliai['buliai_12']['j_is']++;
                                $this->gyvuliai_model->gyvuliai['buliai_24']['j_i']++;
                            }
                            //pardavimai
                            if($pa == '07' || $pa == '05') { $this->gyvuliai_model->gyvuliai['buliai_24']['parduota']++; }
                            //suvartota
                            if($pa == '14') { $this->gyvuliai_model->gyvuliai['buliai_24']['suvartota']++; }
                            //kritimai
                            if($pa == '03') { $this->gyvuliai_model->gyvuliai['buliai_24']['kritimai']++; }
                        }
                        if ($mo < 12) {
                            $lp = explode(".", $sk['laikymo_pradzia']);
                            $info = explode(" ",$sk['informacija']);
                            if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs'){
                                $this->gyvuliai_model->gyvuliai['verseliai']['gimimai']++;
                            }
                            //pardavimai
                            if($pa == '07' || $pa == '05') {$this->gyvuliai_model->gyvuliai['verseliai']['parduota']++;}
                            //suvartota
                            if($pa == '14') {$this->gyvuliai_model->gyvuliai['verseliai']['suvartota']++;}
                            //kritimai
                            if($pa == '03') {$this->gyvuliai_model->gyvuliai['verseliai']['kritimai']++;}
                        }



                    }
                }

                if($one[0] == "Telyčaitė"){
                    //Telycaites nuo 12 iki 24
                    if($sk['amzius']>=12 AND $sk['amzius']<24){
                        $this->gyvuliai_model->gyvuliai['telycios_12']['pabaiga']++;
                        if($sk['amzius']>=12 AND $sk['amzius']<14) {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
                            if(!empty($am) AND $am[0]['amzius']<12){
                                $this->gyvuliai_model->gyvuliai['telycios_12']['j_i']++; $this->gyvuliai_model->gyvuliai['verseliai']['j_is']++;
                                }
                            }
                                $lk = explode(".", $sk['laikymo_pradzia']);
                                $info = explode(" ",$sk['informacija']);
                                if($lk[0] == $metai AND $lk[1] == $menesis AND $info[1] == 'Atvyko'){
                                    $this->gyvuliai_model->gyvuliai['telycios_12']['pirkimai']++;
                                }
                    }

                    //Telycaites virs 24
                    if ($sk['amzius'] >= 24) {
                        $this->gyvuliai_model->gyvuliai['telycios_24']['pabaiga']++;

                        $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                        $am = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
                        if(!empty($am)){
                            if($am[0]['amzius']<24){
                            $this->gyvuliai_model->gyvuliai['telycios_24']['j_i']++; $this->gyvuliai_model->gyvuliai['telycios_12']['j_is']++;
                            }
                        }
                            $lk = explode(".", $sk['laikymo_pradzia']);
                            $info = explode(" ",$sk['informacija']);
                            if($lk[0] == $metai AND $lk[1] == $menesis AND $info[1] == 'Atvyko'){
                                $this->gyvuliai_model->gyvuliai['telycios_24']['pirkimai']++;
                            }
                    }

                    //Telycaites mazesnios negu 12
                    if ($sk['amzius']<12 AND $sk['amzius'] != "") {
                        $this->gyvuliai_model->gyvuliai['verseliai']['pabaiga']++;
                        //$debug2['verseliai'][$v] = $sk;
                        //$v++;

                        //$gd = explode(".", $sk['gimimo_data']);
                        $lp = explode(".", $sk['laikymo_pradzia']);
                        $info = explode(" ",$sk['informacija']);
                        if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs'){
                            $this->gyvuliai_model->gyvuliai['verseliai']['gimimai']++;
                        }
                        //reik del gimimu dar patikrinti ar nera atgaline tvarka irasytas
                        if($lp[0] == $metai AND $lp[1] == $menesis-1 AND $info[1] == 'Gimęs') {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
                            if(empty($am)){
                                $this->gyvuliai_model->gyvuliai['verseliai']['gimimai']++;
                            }
                        }

                        if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Atvyko'){
                            $this->gyvuliai_model->gyvuliai['verseliai']['pirkimai']++;
                        }
                    }

                    //jei yra tuscias, reikia gyvuliai kazkur iskeliavo, reik issiaiskintu kur
                    //reik atsifiltruoti dingimo koduka, gali buti ne tik parduota bet ir kritimas arba suvartota sau
                    ////////////////////////////////////////////
                    //pasitikrinti amziu ar pries pardavima nebuvo kitoje kategorijoje, perejo ir iskart pardave

                    if($sk['amzius']==""){
                        $pr = str_replace(".", "-", $sk['gimimo_data']);

                        if(strstr($sk['laikymo_pabaiga'], '*')){
                            $pp = explode("*", $sk['laikymo_pabaiga']);
                            $pp = explode(" ", $pp[1]);
                        }else{
                            $pp = explode(" ", $sk['laikymo_pabaiga']);
                        }
                        $pb = str_replace(".", "-", $pp[0]);
                        $pb = str_replace(">", "", $pb);

                        $da = $this->gyvuliai_model->dateDifference($pr, $pb, '%y-%m-%d');
                        $dd = explode("-", $da);
                        $mo = $dd[0] * 12 + $dd[1];
                        //reik atsifiltruoti dingimo koduka, gali buti ne tik parduota bet ir kritimas arba suvartota sau
                        $pa= $this->gyvuliai_model->ivykio_kodas($sk['laikymo_pabaiga']);

                        //tikrinama kas atsitiko gyvuliams, kur dingo?
                            if ($mo >= 12 AND $mo < 24) {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
                                if($am[0]['amzius']<12){
                                    $this->gyvuliai_model->gyvuliai['verseliai']['j_is']++;
                                    $this->gyvuliai_model->gyvuliai['telycios_12']['j_i']++;
                                }
                                //pardavimai
                                if($pa == '07' || $pa == '05') {$this->gyvuliai_model->gyvuliai['telycios_12']['parduota']++;}
                                //suvartota
                                if($pa == '14') { $this->gyvuliai_model->gyvuliai['telycios_12']['suvartota']++;}
                                //kritimai
                                if($pa == '03') { $this->gyvuliai_model->gyvuliai['telycios_12']['kritimai']++;}
                            }
                            if ($mo >= 24) {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->gyvuliai_model->nuskaityti_gyvulius($dat);
                                if($am[0]['amzius']<24){
                                    $this->gyvuliai_model->gyvuliai['telycios_12']['j_is']++;
                                    $this->gyvuliai_model->gyvuliai['telycios_24']['j_i']++;
                                }
                                //pardavimai
                                if($pa == '07' || $pa == '05') {$this->gyvuliai_model->gyvuliai['telycios_24']['parduota']++;}
                                //suvartota
                                if($pa == '14') {$this->gyvuliai_model->gyvuliai['telycios_24']['suvartota']++;}
                                //kritimai
                                if($pa == '03') {$this->gyvuliai_model->gyvuliai['telycios_24']['kritimai']++;}
                            }
                            if ($mo < 12) {
                                $lp = explode(".", $sk['laikymo_pradzia']);
                                $info = explode(" ",$sk['informacija']);
                                if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs'){
                                    $this->gyvuliai_model->gyvuliai['verseliai']['gimimai']++;
                                }
                                //pardavimai
                                if($pa == '07' || $pa == '05') {$this->gyvuliai_model->gyvuliai['verseliai']['parduota']++;}
                                //kritimai
                                if($pa == '14') {$this->gyvuliai_model->gyvuliai['verseliai']['suvartota']++;}
                                //kritimai
                                if($pa == '03') { $this->gyvuliai_model->gyvuliai['verseliai']['kritimai']++;}
                            }
                    }
                }
            }
            //suskaiciuoti lenteleje, viso kiekius
            $keys = array_keys($this->gyvuliai_model->gyvuliai['karves']);
            foreach($keys as $ro){
                $sumDetail = $ro;
                $this->gyvuliai_model->gyvuliai['viso'][$ro] = array_reduce($this->gyvuliai_model->gyvuliai,
                    function($runningTotal, $record) use($sumDetail) {
                        $runningTotal += $record[$sumDetail];
                        return $runningTotal;}, 0 );
            }

            $error['action'] = true;
        }

        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Gyvuliai";
        $inf['url'] = "main/index";
        $inf['active'] = "Gyvulių skaičiavimas";

        $this->load->model('ukininkai_model');
        $data = $this->ukininkai_model->ukininku_sarasas();
        $this->load->view("main_view", array('data'=> $data, 'error' => $error, 'gyvuliai'=>$this->gyvuliai_model->gyvuliai, 'inf'=>$inf));

    }

   /* public function ikelti_duomenis(){
        $dt = $this->session->userdata();
        //var_dump($dt);

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
        $this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));
        if (empty($_FILES['visi_gyvuliai']['name'])) {
            $this->form_validation->set_rules('visi_gyvuliai', 'Visi Gyvuliai', 'required', array('required' => 'Pasirinkite failą, visi gyvuliai.'));}
        if (empty($_FILES['gyvi_gyvuliai']['name'])) {
            $this->form_validation->set_rules('gyvi_gyvuliai', 'Gyvi Gyvuliai', 'required', array('required' => 'Pasirinkite failą, gyvi gyvuliai.'));}
        if ($this->form_validation->run()) {
            $ukininko_vardas = $this->input->post('ukininko_vardas');
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');
            $config['upload_path']   = './DATA/';
            $config['allowed_types'] = '*';
            $config['max_size']      = 1024*3;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('gyvi_gyvuliai')) {
                $error = array('visi' => $this->upload->display_errors());
            }
            $gyvi_info = $this->upload->data();
            if ( ! $this->upload->do_upload('visi_gyvuliai')) {
                $error = array('gyvi' => $this->upload->display_errors());}
            //panaudoti sita eateitije info apie failus gal reikes
            $visi_info = $this->upload->data();
            $this->load->model('gyvuliai_model');
            //parsinam duomenis is html failu
            $data_visi = $this->gyvuliai_model->Visi_gyvunai(base_url().'DATA/'.$visi_info['file_name']);
            $data_gyvi = $this->gyvuliai_model->Gyvi_gyvunai(base_url().'DATA/'.$gyvi_info['file_name']);
            //pasitikrinti ar sito ukininko gyvuliai jau nera itrauktas i db !!!
            $kiek = $this->gyvuliai_model->tikinti_gyvulius_ikelti($metai, $menesis, $ukininko_vardas);
            $men = array("Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa",
                "Rugpjūtis", "Rugsejis", "Spalis","Lapkritis", "Gruodis");
            if($kiek>0){
                $error = array('jau_yra' => $metai.' '.$men[$menesis-1].', jau esate pridejes gyvulius!');
            }else{
                //ikelia duomenis i duomenu baze
                $this->gyvuliai_model->Irasyti_visus($data_visi, $ukininko_vardas, $metai, $menesis);
                $this->gyvuliai_model->atnaujinti_visus($data_gyvi, $ukininko_vardas, $metai, $menesis);
                $error = array('OK' => $metai.' '.$men[$menesis-1].' gyvuliai įtraukti į duomenų bazę!');
            }
            //istrinam panaudotus failus
            unlink('./DATA/'.$visi_info['file_name']);
            unlink('./DATA/'.$gyvi_info['file_name']);
        }
        $this->load->model('ukininkai_model');
        $data = $this->ukininkai_model->ukininku_sarasas();
        $this->load->view("main_view", array('data'=> $data, 'error'=>$error,));
    }*/
}
?>
