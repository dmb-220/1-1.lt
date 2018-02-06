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
class Galvijai extends CI_Controller {

    public function __construct(){
        parent::__construct();
        error_reporting(E_ERROR | E_WARNING | E_PARSE);

        //uzkraunam MODEL
        $this->load->model('ukininkai_model');
        $this->load->model('galvijai_model');
        $this->load->model('pasarai_model');
        $this->load->model('main_model');

        $this->load->library('linksniai');

        if (!$this->ion_auth->logged_in()) {
            redirect('main/auth_error');
        }
    }

    //jei kas bandys atidaryti index puslapi bus nukreiptas i pagrindini
    public function index(){
        redirect('galvijai/pradinis');}

    ///////////////////////////////////////////////////////////////////////////////// NAUJA ////////////////////////////////////////////////////////////////////

    //PRADINIS PUSLAPIS
    public function pradinis(){
        //nuskaitom pasarus
        $this->main_model->info['pasarai'] = $this->pasarai_model->nuskaityti_viska();

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Galvijai";
        $this->main_model->info['txt']['info'] = "Pradinis puslapis";

        $user = $this->ion_auth->user()->row();
        //Nuskaitom ukininku sarasa, kad butu visada po ranka
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas_galvijai($user->id, TRUE);
        $this->load->view("main_view");
    }

    public function tuscias(){
        $this->load->view("galvijai/empty");
    }

    public function aprasymas(){
        $this->load->view("galvijai/aprasymas");
    }

    public function ganykliniai_pasarai(){
        $laiko = array();

        $mesl = array(
            'karves' => '65',
            'telycios' => '50',
            'buliai' => '55',
            'verseliai' => '35',
        );

        $arr = array(
            '5', '6', '7', '8', '9',
        );

        $sesija = $this->session->userdata();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('ukininkas', 'Vardas Pavardė', 'required', array('required' => 'Pasirinkite ūkininką.'));
        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
        //$this->form_validation->set_rules('rinktis', 'Skaiciavimas', 'required', array('required' => 'Pasirinkite skaičiavimo metodą.'));
        //$this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));


        if ($this->form_validation->run()) {
            $ukininkas = $this->input->post('ukininkas');
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');
            $laikotarpis = $this->input->post('laikotarpis');

            //nuskaitom ukininko duomenis
            $ukis = $this->ukininkai_model->ukininkas($ukininkas);
            if (count($ukis) > 0) {
                //jei sesijos duomenis neatitinka su pasirinktu ukininku, atnaujinam sesijos informacija
                if ($sesija['nr'] != $ukininkas) {
                    $new = array('vardas' => $ukis[0]['vardas'], 'pavarde' => $ukis[0]['pavarde'], 'nr' => $ukininkas);
                    $this->session->set_userdata($new);
                }
                //sukeliam informacija kuria naudosim
                $this->main_model->info['txt']['vardas'] = $ukis[0]['vardas'];
                $this->main_model->info['txt']['pavarde'] = $ukis[0]['pavarde'];
                $this->main_model->info['txt']['metai'] = $metai;
                $this->main_model->info['txt']['menesis'] = $menesis;

                //patikrinam kokie pasirinkimai yra, kad maziau nesusipratimu skaiciuojant
                if (!$menesis AND !$laikotarpis) {
                    $this->main_model->info['error'][] = "Pasirinkite mėnesį arba laikotarpį kuriam skaičiuosime pašarus.";
                }
                if ($menesis AND $laikotarpis) {
                    $this->main_model->info['error'][] = "Pasirinkite TIK mėnesį arba TIK laikotarpį kuriam skaičiuosime pašarus.";
                }

                //skaiciuojam nurodyto menesio pasaru kieki galvijams
                //nuskaitom visus gyvulius, pasirinkto menesio
                if ($menesis AND !$laikotarpis) {
                    if(in_array($menesis, $arr)) {
                        $day = cal_days_in_month(CAL_GREGORIAN, $menesis, $metai);
                        $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
                        $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);
                        if (count($rezultatai) > 0) {
                            //apdoroti duomenis prie irasant i masyva
                            foreach ($rezultatai as $sk) {
                                $one = explode(" ", $sk['lytis']);
                                if ($one[0] == "Karvė") {
                                    $this->galvijai_model->ganykliniai['karves']['kiek']++;
                                    $this->galvijai_model->ganykliniai['karves']['pasarai'] += $mesl['karves'] * $day;
                                }

                                if ($one[0] == "Buliukas") {
                                    if ($sk['amzius'] >= 12) {
                                        $this->galvijai_model->ganykliniai['buliai']['kiek']++;
                                        $this->galvijai_model->ganykliniai['buliai']['pasarai'] += $mesl['buliai'] * $day;
                                    }
                                    if ($sk['amzius'] < 12) {
                                        $this->galvijai_model->ganykliniai['verseliai']['kiek']++;
                                        $this->galvijai_model->ganykliniai['verseliai']['pasarai'] += $mesl['verseliai'] * $day;
                                    }
                                }
                                if ($one[0] == "Telyčaitė") {
                                    if ($sk['amzius'] >= 12) {
                                        $this->galvijai_model->ganykliniai['telycios']['kiek']++;
                                        $this->galvijai_model->ganykliniai['telycios']['pasarai'] += $mesl['telycios'] * $day;
                                    }
                                    if ($sk['amzius'] < 12) {
                                        $this->galvijai_model->ganykliniai['verseliai']['kiek']++;
                                        $this->galvijai_model->ganykliniai['verseliai']['pasarai'] += $mesl['verseliai'] * $day;
                                    }
                                }
                            }

                        } else {$this->main_model->info['error'][] = $metai . " " . $this->main_model->menesiai[$menesis - 1] . " galvjų nerasta, negalime apskaičiuoti galvijų meslo!";}
                    }else{$this->main_model->info['error'][] = $metai . " " . $this->main_model->menesiai[$menesis - 1] . " Negalite apskaičiuoti ganyklinių pašarų. Galvijai vis dar tvarte!";}
                }
                //var_dump($this->input->post());
                if(!$menesis AND $laikotarpis){
                    if($laikotarpis == 1){
                        $laiko = array(5, 6, 7, 8, 9);
                        $this->main_model->info['txt']['laikotarpis'] = 'Visas sezonas';}
                    if($laikotarpis == 2){
                        $laiko = array(5, 6);
                        $this->main_model->info['txt']['laikotarpis'] = 'II ketvirtis';}
                    if($laikotarpis == 3){
                        $laiko = array(7, 8, 9);
                        $this->main_model->info['txt']['laikotarpis'] = 'II ketvirtis';}

                    if(is_array($laiko)){
                        foreach($laiko as $lk){
                            //var_dump($lk);
                            $day = cal_days_in_month(CAL_GREGORIAN, $lk, $metai);
                            //nuskaitom visus gyvulius, pasirinkto menesio
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $lk);
                            $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);

                            if (count($rezultatai) > 0) {
                                foreach ($rezultatai as $sk) {
                                    $one = explode(" ", $sk['lytis']);
                                    if ($one[0] == "Karvė") {
                                        $this->galvijai_model->ganykliniai['karves']['kiek']++;
                                        $this->galvijai_model->ganykliniai['karves']['pasarai'] += $mesl['karves']*$day;
                                    }

                                    if ($one[0] == "Buliukas") {
                                        if ($sk['amzius'] >= 12) {
                                            $this->galvijai_model->ganykliniai['buliai']['kiek']++;
                                            $this->galvijai_model->ganykliniai['buliai']['pasarai'] += $mesl['buliai']*$day;
                                        }
                                        if ($sk['amzius'] < 12) {
                                            $this->galvijai_model->ganykliniai['verseliai']['kiek']++;
                                            $this->galvijai_model->ganykliniai['verseliai']['pasarai'] += $mesl['verseliai']*$day;
                                        }
                                    }
                                    if ($one[0] == "Telyčaitė") {
                                        if ($sk['amzius'] >= 12) {
                                            $this->galvijai_model->ganykliniai['telycios']['kiek']++;
                                            $this->galvijai_model->ganykliniai['telycios']['pasarai'] += $mesl['telycios']*$day;
                                        }
                                        if ($sk['amzius'] < 12) {
                                            $this->galvijai_model->ganykliniai['verseliai']['kiek']++;
                                            $this->galvijai_model->ganykliniai['verseliai']['pasarai'] += $mesl['verseliai']*$day;
                                        }
                                    }
                                }
                            }else{$this->main_model->info['error'][] = $metai." ".$this->main_model->menesiai[$lk-1]." galvjų nerasta, negalime apskaičiuoti galvijų ganyklinių pašarų!";}
                        }
                    }
                }
            }else{$this->main_model->info['error'][] = "Ūkininkas neegzistuoja, ar / arba klaidos sistemoje, praneškite adminitratoriui!";}
        }else{$this->main_model->info['error'][] = "Problemos, nepasirinktas ukininkas, blogi metai, ar menesis";}
        //die;
        $this->load->view("galvijai/ganykliniai_pasarai");
    }

    public function  skaiciuoti_priesvori(){
    $svoris = array(
        //'karves' => '0',
        'telycios_1_2' => '12',
        'telycios_2' => '9',
        'buliai_1_2' => '16',
        'buliai_2' => '18',
        'verseliai' => '20',
    );

    $sesija = $this->session->userdata();

    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

    $this->form_validation->set_rules('ukininkas', 'Vardas Pavardė', 'required', array('required' => 'Pasirinkite ūkininką.'));
    $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
    $this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

    if ($this->form_validation->run()) {
        $ukininkas = $this->input->post('ukininkas');
        $metai = $this->input->post('metai');
        $menesis = $this->input->post('menesis');
        //nuskaitom ukininko duomenis
        $ukis = $this->ukininkai_model->ukininkas($ukininkas);
        if (count($ukis) > 0) {
            //jei sesijos duomenis neatitinka su pasirinktu ukininku, atnaujinam sesijos informacija
            if ($sesija['nr'] != $ukininkas) {
                $new = array('vardas' => $ukis[0]['vardas'], 'pavarde' => $ukis[0]['pavarde'], 'nr' => $ukininkas);
                $this->session->set_userdata($new);
            }
            //sukeliam informacija kuria naudosim
            $this->main_model->info['txt']['vardas'] = $ukis[0]['vardas'];
            $this->main_model->info['txt']['pavarde'] = $ukis[0]['pavarde'];
            $this->main_model->info['txt']['metai'] = $metai;
            $this->main_model->info['txt']['menesis'] = $menesis;

            //skaiciuojam nurodyto menesio pasaru kieki galvijams
            //nuskaitom visus gyvulius, pasirinkto menesio
            $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
            $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);

            if (count($rezultatai) > 0) {
                //suskaiciuoti lenteleje, viso kiekius
                foreach ($rezultatai as $sk) {
                    $one = explode(" ", $sk['lytis']);
                    /*if($one[0] == "Karvė"){
                        $gyvu['karves']['pradzia']++;
                    }*/

                    if ($one[0] == "Buliukas") {
                        if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                            $this->galvijai_model->priesvoris['buliai_1_2']['kiek']++;
                            $this->galvijai_model->priesvoris['buliai_1_2']['svoris'] += $svoris['buliai_1_2'];
                        }
                        if ($sk['amzius'] >= 24) {
                            $this->galvijai_model->priesvoris['buliai_2']['kiek']++;
                            $this->galvijai_model->priesvoris['buliai_2']['svoris'] += $svoris['buliai_2'];
                        }
                        if ($sk['amzius'] < 12 AND $sk['amzius'] != "") {
                            $this->galvijai_model->priesvoris['verseliai']['kiek']++;
                            $this->galvijai_model->priesvoris['verseliai']['svoris'] += $svoris['verseliai'];
                        }
                    }

                    if ($one[0] == "Telyčaitė") {
                        if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                            $this->galvijai_model->priesvoris['telycios_1_2']['kiek']++;
                            $this->galvijai_model->priesvoris['telycios_1_2']['svoris'] += $svoris['telycios_1_2'];
                        }
                        if ($sk['amzius'] >= 24) {
                            $this->galvijai_model->priesvoris['telycios_2']['kiek']++;
                            $this->galvijai_model->priesvoris['telycios_2']['svoris'] += $svoris['telycios_2'];
                        }
                        if ($sk['amzius'] < 12 AND $sk['amzius'] != "") {
                            $this->galvijai_model->priesvoris['verseliai']['kiek']++;
                            $this->galvijai_model->priesvoris['verseliai']['svoris'] += $svoris['verseliai'];
                        }
                    }
                }
            }else{$this->main_model->info['error'][] = $metai." ".$this->main_model->menesiai[$menesis-1]." galvjų nerasta, negalime apskaičiuoti galvijų priesvorio!";}
        }else{$this->main_model->info['error'][] = "Ūkininkas neegzistuoja, ar / arba klaidos sistemoje, praneškite adminitratoriui!";}
    }else{$this->main_model->info['error'][] = "Problemos, nepasirinktas ukininkas, blogi metai, ar menesis";}

    $this->load->view("galvijai/skaiciuoti_priesvori");
}

    public function  skaiciuoti_meslus(){
        $laiko = array();
        //svoris per  1 men, tonomis
        $mesl = array(
            'karves' => '0.53',
            'telycios' => '0.53',
            'buliai' => '0.5',
            'verseliai' => '0.25',
        );

        $arr = array(
            '10', '11', '12', '1', '2', '3', '4'
        );

        $sesija = $this->session->userdata();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('ukininkas', 'Vardas Pavardė', 'required', array('required' => 'Pasirinkite ūkininką.'));
        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
        //$this->form_validation->set_rules('rinktis', 'Skaiciavimas', 'required', array('required' => 'Pasirinkite skaičiavimo metodą.'));
        //$this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

        //var_dump($this->input->post()); die;

        if ($this->form_validation->run()) {
            $ukininkas = $this->input->post('ukininkas');
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');
            $laikotarpis = $this->input->post('laikotarpis');

            //nuskaitom ukininko duomenis
            $ukis = $this->ukininkai_model->ukininkas($ukininkas);
            if (count($ukis) > 0) {
                //jei sesijos duomenis neatitinka su pasirinktu ukininku, atnaujinam sesijos informacija
                if ($sesija['nr'] != $ukininkas) {
                    $new = array('vardas' => $ukis[0]['vardas'], 'pavarde' => $ukis[0]['pavarde'], 'nr' => $ukininkas);
                    $this->session->set_userdata($new);
                }
                //sukeliam informacija kuria naudosim
                $this->main_model->info['txt']['vardas'] = $ukis[0]['vardas'];
                $this->main_model->info['txt']['pavarde'] = $ukis[0]['pavarde'];
                $this->main_model->info['txt']['metai'] = $metai;
                $this->main_model->info['txt']['menesis'] = $menesis;

                //patikrinam kokie pasirinkimai yra, kad maziau nesusipratimu skaiciuojant
                if (!$menesis AND !$laikotarpis) {
                    $this->main_model->info['error'][] = "Pasirinkite mėnesį arba laikotarpį kuriam skaičiuosime pašarus.";
                }
                if ($menesis AND $laikotarpis) {
                    $this->main_model->info['error'][] = "Pasirinkite TIK mėnesį arba TIK laikotarpį kuriam skaičiuosime pašarus.";
                }

                //skaiciuojam nurodyto menesio pasaru kieki galvijams
                //nuskaitom visus gyvulius, pasirinkto menesio
                if ($menesis AND !$laikotarpis) {
                    if(in_array($menesis, $arr)) {
                        $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
                        $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);
                        if (count($rezultatai) > 0) {
                            //apdoroti duomenis prie irasant i masyva
                            foreach ($rezultatai as $sk) {
                                $one = explode(" ", $sk['lytis']);
                                if ($one[0] == "Karvė") {
                                    $this->galvijai_model->meslas['karves']['kiek']++;
                                    $this->galvijai_model->meslas['karves']['meslas'] += $mesl['karves'];
                                }

                                if ($one[0] == "Buliukas") {
                                    if ($sk['amzius'] >= 12) {
                                        $this->galvijai_model->meslas['buliai']['kiek']++;
                                        $this->galvijai_model->meslas['buliai']['meslas'] += $mesl['buliai'];
                                    }
                                    if ($sk['amzius'] < 12) {
                                        $this->galvijai_model->meslas['verseliai']['kiek']++;
                                        $this->galvijai_model->meslas['verseliai']['meslas'] += $mesl['verseliai'];
                                    }
                                }
                                if ($one[0] == "Telyčaitė") {
                                    if ($sk['amzius'] >= 12) {
                                        $this->galvijai_model->meslas['telycios']['kiek']++;
                                        $this->galvijai_model->meslas['telycios']['meslas'] += $mesl['telycios'];
                                    }
                                    if ($sk['amzius'] < 12) {
                                        $this->galvijai_model->meslas['verseliai']['kiek']++;
                                        $this->galvijai_model->meslas['verseliai']['meslas'] += $mesl['verseliai'];
                                    }
                                }
                            }

                        } else {$this->main_model->info['error'][] = $metai . " " . $this->main_model->menesiai[$menesis - 1] . " galvjų nerasta, negalime apskaičiuoti galvijų meslo!";}
                    }else{$this->main_model->info['error'][] = $metai . " " . $this->main_model->menesiai[$menesis - 1] . " Negalite apskaičiuoti mėšlo. Galvijai vis dar lauke!";}
                }
                if(!$menesis AND $laikotarpis){
                    if($laikotarpis == 1){
                        $laiko = array(10, 11, 12, 1, 2, 3, 4);
                        $this->main_model->info['txt']['laikotarpis'] = 'Visas sezonas';}
                    if($laikotarpis == 2){
                        $laiko = array(10, 11, 12);
                        $this->main_model->info['txt']['laikotarpis'] = 'IV ketvirtis';}
                    if($laikotarpis == 3){
                        $laiko = array(1, 2, 3);
                        $this->main_model->info['txt']['laikotarpis'] = 'I ketvirtis';}
                    if($laikotarpis == 4){
                        $laiko = array(4);
                        $this->main_model->info['txt']['laikotarpis'] = 'II ketvirtis (tik Balandis)';}

                    if(is_array($laiko)){
                        foreach($laiko as $lk){
                            if($lk == 10 || $lk == 11 || $lk == 12){$met = $metai-1;}else{$met = $metai;}
                            $this->main_model->info['txt']['metai_2'] = $met;
                            //nuskaitom visus gyvulius, pasirinkto menesio
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $lk);
                            $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);

                            if (count($rezultatai) > 0) {
                                foreach ($rezultatai as $sk) {
                                    $one = explode(" ", $sk['lytis']);
                                    if ($one[0] == "Karvė") {
                                        $this->galvijai_model->meslas['karves']['kiek']++;
                                        $this->galvijai_model->meslas['karves']['meslas'] += $mesl['karves'];
                                    }

                                    if ($one[0] == "Buliukas") {
                                        if ($sk['amzius'] >= 12) {
                                            $this->galvijai_model->meslas['buliai']['kiek']++;
                                            $this->galvijai_model->meslas['buliai']['meslas'] += $mesl['buliai'];
                                        }
                                        if ($sk['amzius'] < 12) {
                                            $this->galvijai_model->meslas['verseliai']['kiek']++;
                                            $this->galvijai_model->meslas['verseliai']['meslas'] += $mesl['verseliai'];
                                        }
                                    }
                                    if ($one[0] == "Telyčaitė") {
                                        if ($sk['amzius'] >= 12) {
                                            $this->galvijai_model->meslas['telycios']['kiek']++;
                                            $this->galvijai_model->meslas['telycios']['meslas'] += $mesl['telycios'];
                                        }
                                        if ($sk['amzius'] < 12) {
                                            $this->galvijai_model->meslas['verseliai']['kiek']++;
                                            $this->galvijai_model->meslas['verseliai']['meslas'] += $mesl['verseliai'];
                                        }
                                    }
                                }
                            }else{$this->main_model->info['error'][] = $met." ".$this->main_model->menesiai[$lk-1]." galvjų nerasta, negalime apskaičiuoti galvijų mėšlo!";}
                        }
                    }
                }
            }else{$this->main_model->info['error'][] = "Ūkininkas neegzistuoja, ar / arba klaidos sistemoje, praneškite adminitratoriui!";}
        }else{$this->main_model->info['error'][] = "Problemos, nepasirinktas ukininkas, blogi metai, ar menesis";}

        $this->load->view("galvijai/skaiciuoti_meslus");
    }

    public function skaitciuoti_pasarus(){
        //kintamieji
        $laiko = array();
        $num_day = 0;
        //nerodo ukiniko prie lenteles, jis ir nebutinas?
        $sesija = $this->session->userdata();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('ukininkas', 'Vardas Pavardė', 'required', array('required' => 'Pasirinkite ūkininką.'));
        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
        //$this->form_validation->set_rules('rinktis', 'Skaiciavimas', 'required', array('required' => 'Pasirinkite skaičiavimo metodą.'));
        //$this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));
        //var_dump($this->input->post()); die;
        if ($this->form_validation->run()) {
            $ukininkas = $this->input->post('ukininkas');
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');
            $laikotarpis = $this->input->post('laikotarpis');
            $rinktis = $this->input->post('rinktis');
            //nuskaitom ukininko duomenis
            $ukis = $this->ukininkai_model->ukininkas($ukininkas);
            if (count($ukis) > 0) {
                //jei sesijos duomenis neatitinka su pasirinktu ukininku, atnaujinam sesijos informacija
                if ($sesija['nr'] != $ukininkas) {
                    $new = array('vardas' => $ukis[0]['vardas'], 'pavarde' => $ukis[0]['pavarde'], 'nr' => $ukininkas);
                    $this->session->set_userdata($new);
                }
                //sukeliam informacija kuria naudosim
                $this->main_model->info['txt']['vardas'] = $ukis[0]['vardas'];
                $this->main_model->info['txt']['pavarde'] = $ukis[0]['pavarde'];
                $this->main_model->info['txt']['metai'] = $metai;
                $this->main_model->info['txt']['menesis'] = $menesis;
                $this->main_model->info['txt']['rinktis'] = $rinktis;

                //patikrinam kokie pasirinkimai yra, kad maziau nesusipratimu skaiciuojant
                if (!$menesis AND !$laikotarpis) {
                    $this->main_model->info['error'][] = "Pasirinkite mėnesį arba laikotarpį kuriam skaičiuosime pašarus.";
                }
                if ($menesis AND $laikotarpis) {
                    $this->main_model->info['error'][] = "Pasirinkite TIK mėnesį arba TIK laikotarpį kuriam skaičiuosime pašarus.";
                }

                //skaiciuojam pasirinkto menesio pasarus
                if ($menesis AND !$laikotarpis) {
                    //skaiciuojam nurodyto menesio pasaru kieki galvijams
                    //nuskaitom visus gyvulius, pasirinkto menesio
                    $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
                    $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);
                    if (count($rezultatai) > 0) {

                        foreach ($rezultatai as $sk) {
                            $one = explode(" ", $sk['lytis']);
                            if ($sk['amzius'] != "") {
                                if ($one[0] == "Karvė") {
                                    $this->galvijai_model->pasarai['karves']['kiek']++;
                                }
                                if ($one[0] == "Buliukas") {
                                    if ($sk['amzius'] >= 6 AND $sk['amzius'] < 12) {
                                        $this->galvijai_model->pasarai['buliai_6_12']['kiek']++;
                                    }
                                    if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                                        $this->galvijai_model->pasarai['buliai_12_24']['kiek']++;
                                    }
                                    if ($sk['amzius'] >= 24) {
                                        $this->galvijai_model->pasarai['buliai_24']['kiek']++;
                                    }
                                    if ($sk['amzius'] < 6 AND $sk['amzius'] != "") {
                                        $this->galvijai_model->pasarai['verseliai_6']['kiek']++;
                                    }
                                }
                                if ($one[0] == "Telyčaitė") {
                                    if ($sk['amzius'] >= 6 AND $sk['amzius'] < 12) {
                                        $this->galvijai_model->pasarai['telycios_6_12']['kiek']++;
                                    }
                                    if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                                        $this->galvijai_model->pasarai['telycios_12_24']['kiek']++;
                                    }
                                    if ($sk['amzius'] >= 24) {
                                        $this->galvijai_model->pasarai['telycios_24']['kiek']++;
                                    }
                                    if ($sk['amzius'] < 6 AND $sk['amzius'] != "") {
                                        $this->galvijai_model->pasarai['verseliai_6']['kiek']++;
                                    }
                                }
                            }
                        }

                        //skaiciuojam pasarus

                        foreach ($this->galvijai_model->pasarai as $key => $row) {
                            $duo = $this->pasarai_model->nuskaityti_pasarus($key);
                            $ke = array_keys($duo[0]);
                            $this->galvijai_model->pasarai[$key]['pavadinimas'] = $duo[0]['gyvuliai'];
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
                                    $this->galvijai_model->pasarai[$key][$ke[$i]]['min'] = $this->galvijai_model->pasarai[$key]['kiek'] * $min * $num_day;
                                    $this->galvijai_model->pasarai[$key][$ke[$i]]['vid'] = $this->galvijai_model->pasarai[$key]['kiek'] * $vid * $num_day;
                                    $this->galvijai_model->pasarai[$key][$ke[$i]]['max'] = $this->galvijai_model->pasarai[$key]['kiek'] * $max * $num_day;
                                }
                            }
                        }

                        //suskaiciuoti lenteleje, viso kiekius
                        $keys = array_keys($this->galvijai_model->pasarai['karves']);
                        foreach ($keys as $ro) {
                            $sum = $ro;
                            if ($ro != 'kiek') {
                                $this->galvijai_model->pasarai['viso'][$ro]['vid'] = @array_reduce($this->galvijai_model->pasarai,
                                    function ($runningTotal, $record) use ($sum) {
                                        $runningTotal += $record[$sum]['vid'];
                                        return $runningTotal;
                                    }, 0);
                                $this->galvijai_model->pasarai['viso'][$ro]['min'] = @array_reduce($this->galvijai_model->pasarai,
                                    function ($runningTotal, $record) use ($sum) {
                                        $runningTotal += $record[$sum]['min'];
                                        return $runningTotal;
                                    }, 0);
                                $this->galvijai_model->pasarai['viso'][$ro]['max'] = @array_reduce($this->galvijai_model->pasarai,
                                    function ($runningTotal, $record) use ($sum) {
                                        $runningTotal += $record[$sum]['max'];
                                        return $runningTotal;
                                    }, 0);
                            } else {
                                $this->galvijai_model->pasarai['viso'][$ro] = @array_reduce($this->galvijai_model->pasarai,
                                    function ($runningTotal, $record) use ($sum) {
                                        $runningTotal += $record[$sum];
                                        return $runningTotal;
                                    }, 0);
                            }
                        }
                        $this->galvijai_model->pasarai['viso']['pavadinimas'] = "Viso:";
                    }else{$this->main_model->info['error'][] = $metai." ".$this->main_model->menesiai[$menesis-1]." galvjų nerasta, negalime apskaičiuoti galvijų pašarų!";}
                }

                //pradedam skaiciuoti ketvircius ir pusmecius
                if(!$menesis AND $laikotarpis){
                    if($laikotarpis == 1){
                        $laiko = array(1, 2, 3, 4, 5, 6);
                        $this->main_model->info['txt']['laikotarpis'] = 'I pusmetis';}
                    if($laikotarpis == 2){
                        $laiko = array(7, 8, 9, 10, 11, 12);
                        $this->main_model->info['txt']['laikotarpis'] = 'II pusmetis';}
                    if($laikotarpis == 3){
                        $laiko = array(1, 2, 3);
                        $this->main_model->info['txt']['laikotarpis'] = 'I ketvirtis';}
                    if($laikotarpis == 4){
                        $laiko = array(4, 5, 6);
                        $this->main_model->info['txt']['laikotarpis'] = 'II ketvirtis';}
                    if($laikotarpis == 5){
                        $laiko = array(7, 8, 9);
                        $this->main_model->info['txt']['laikotarpis'] = 'III ketvirtis';}
                    if($laikotarpis == 6){
                        $laiko = array(10, 11, 12);
                        $this->main_model->info['txt']['laikotarpis'] = 'IV ketvirtis';}

                    if(is_array($laiko)){
                        foreach($laiko as $lk){
                            //suskaiciuojam kiek dienu turi
                            $num_day = $num_day + cal_days_in_month(CAL_GREGORIAN, $lk, $metai);
                            //nuskaitom visus gyvulius, pasirinkto menesio
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $lk);
                            $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);

                            if (count($rezultatai) > 0) {
                                foreach ($rezultatai as $sk) {
                                    $one = explode(" ", $sk['lytis']);
                                    if ($one[0] == "Karvė") {
                                        if ($sk['amzius'] != "") {
                                            $this->galvijai_model->pasarai['karves']['kiek']++;
                                        }
                                    }

                                    if ($one[0] == "Buliukas") {
                                        if ($sk['amzius'] >= 6 AND $sk['amzius'] < 12) {
                                            $this->galvijai_model->pasarai['buliai_6_12']['kiek']++;
                                        }
                                        if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                                            $this->galvijai_model->pasarai['buliai_12_24']['kiek']++;
                                        }
                                        if ($sk['amzius'] >= 24) {
                                            $this->galvijai_model->pasarai['buliai_24']['kiek']++;
                                        }
                                        if ($sk['amzius'] < 6 AND $sk['amzius'] != "") {
                                            $this->galvijai_model->pasarai['verseliai_6']['kiek']++;
                                        }
                                    }

                                    if ($one[0] == "Telyčaitė") {
                                        if ($sk['amzius'] >= 6 AND $sk['amzius'] < 12) {
                                            $this->galvijai_model->pasarai['telycios_6_12']['kiek']++;
                                        }
                                        if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                                            $this->galvijai_model->pasarai['telycios_12_24']['kiek']++;
                                        }
                                        if ($sk['amzius'] >= 24) {
                                            $this->galvijai_model->pasarai['telycios_24']['kiek']++;
                                        }
                                        if ($sk['amzius'] < 6 AND $sk['amzius'] != "") {
                                            $this->galvijai_model->pasarai['verseliai_6']['kiek']++;
                                        }
                                    }
                                }
                            }else{$this->main_model->info['error'][] = $metai." ".$this->main_model->menesiai[$lk-1]." galvjų nerasta, negalime apskaičiuoti galvijų pašarų!";}
                        }
                    }
                    //skaiciuojam pasarus
                    foreach ($this->galvijai_model->pasarai as $key => $row) {
                        $duo = $this->pasarai_model->nuskaityti_pasarus($key);
                        //var_dump($duo);
                        $ke = array_keys($duo[0]);
                        $this->galvijai_model->pasarai[$key]['pavadinimas'] = $duo[0]['gyvuliai'];
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
                                $this->galvijai_model->pasarai[$key][$ke[$i]]['min'] = $this->galvijai_model->pasarai[$key]['kiek'] * $min*$num_day;
                                $this->galvijai_model->pasarai[$key][$ke[$i]]['vid'] = $this->galvijai_model->pasarai[$key]['kiek'] * $vid*$num_day;
                                $this->galvijai_model->pasarai[$key][$ke[$i]]['max'] = $this->galvijai_model->pasarai[$key]['kiek'] * $max*$num_day;
                            }
                        }
                    }
                    //suskaiciuoti lenteleje, viso kiekius
                    $keys = array_keys($this->galvijai_model->pasarai['karves']);
                    foreach ($keys as $ro) {
                        $sum = $ro;
                        if ($ro != 'kiek') {
                            $this->galvijai_model->pasarai['viso'][$ro]['vid'] = @array_reduce($this->galvijai_model->pasarai,
                                function ($runningTotal, $record) use ($sum) {
                                    $runningTotal += $record[$sum]['vid'];
                                    return $runningTotal;
                                }, 0);
                            $this->galvijai_model->pasarai['viso'][$ro]['min'] = @array_reduce($this->galvijai_model->pasarai,
                                function ($runningTotal, $record) use ($sum) {
                                    $runningTotal += $record[$sum]['min'];
                                    return $runningTotal;
                                }, 0);
                            $this->galvijai_model->pasarai['viso'][$ro]['max'] = @array_reduce($this->galvijai_model->pasarai,
                                function ($runningTotal, $record) use ($sum) {
                                    $runningTotal += $record[$sum]['max'];
                                    return $runningTotal;
                                }, 0);
                        } else {
                            $this->galvijai_model->pasarai['viso'][$ro] = @array_reduce($this->galvijai_model->pasarai,
                                function ($runningTotal, $record) use ($sum) {
                                    $runningTotal += $record[$sum];
                                    return $runningTotal;
                                }, 0);
                        }
                    }
                    $this->galvijai_model->pasarai['viso']['pavadinimas'] = "Viso:";
                }

            }else{$this->main_model->info['error'][] = "Ūkininkas neegzistuoja, ar / arba klaidos sistemoje, praneškite adminitratoriui!";}
        }else{$this->main_model->info['error'][] = "Problemos, nepasirinktas ukininkas, blogi metai, ar menesis";}

        $this->load->view("galvijai/skaiciuoti_pasarus");
    }

    public function galviju_sarasas(){
        $gyvu = array();
        $sesija = $this->session->userdata();
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('ukininkas', 'Vardas Pavardė', 'required', array('required' => 'Pasirinkite ūkininką.'));
        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
        $this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

        if ($this->form_validation->run()) {
            $ukininkas = $this->input->post('ukininkas');
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');
            //nuskaitom ukininko duomenis
            $ukis = $this->ukininkai_model->ukininkas($ukininkas);
            if (count($ukis) > 0) {
                //jei sesijos duomenis neatitinka su pasirinktu ukininku, atnaujinam sesijos informacija
                if ($sesija['nr'] != $ukininkas) {
                    $new = array('vardas' => $ukis[0]['vardas'], 'pavarde' => $ukis[0]['pavarde'], 'nr' => $ukininkas);
                    $this->session->set_userdata($new);
                }
                //sukeliam informacija kuria naudosim
                $this->main_model->info['txt']['vardas'] = $ukis[0]['vardas'];
                $this->main_model->info['txt']['pavarde'] = $ukis[0]['pavarde'];
                $this->main_model->info['txt']['metai'] = $metai;
                $this->main_model->info['txt']['menesis'] = $menesis;

                $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
                $psl = $this->galvijai_model->nuskaityti_gyvulius($dat);
                if(count($psl) > 0) {
                    for ($i = 0; $i < count($psl); $i++) {
                        $gyvu[$i]['numeris'] = $psl[$i]['numeris'];
                        $gyvu[$i]['lytis'] = $psl[$i]['lytis'];
                        $gyvu[$i]['veisle'] = $psl[$i]['veisle'];
                        $gyvu[$i]['gimimo_data'] = $psl[$i]['gimimo_data'];
                        $gyvu[$i]['laikymo_pradzia'] = $psl[$i]['laikymo_pradzia'];
                        $gyvu[$i]['laikymo_pabaiga'] = $psl[$i]['laikymo_pabaiga'];
                        $gyvu[$i]['amzius'] = $psl[$i]['amzius'];
                        $gyvu[$i]['informacija'] = $psl[$i]['informacija'];
                    }
                }else{$this->main_model->info['error'][] = $metai." ".$this->main_model->menesiai[$menesis]." galvjų nerasta!";}
            }else{$this->main_model->info['error'][] = "Ūkininkas neegzistuoja, ar / arba klaidos sistemoje, praneškite adminitratoriui!";}
        }else{$this->main_model->info['error'][] = "Problemos, nepasirinktas ukininkas, blogi metai, ar menesis";}

        $this->load->view("galvijai/galviju_sarasas", array('gyvu' => $gyvu));
    }

    public function ikelti_viclt(){
        $klaida = FALSE;
        $sesija = $this->session->userdata();

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('ukininkas', 'Vardas Pavardė', 'required',  array('required' => 'Pasirinkite ūkininką.'));
        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
        $this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

        if ($this->form_validation->run()) {
            $ukininkas = $this->input->post('ukininkas');
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');

            //$rinktis = $this->input->post('rinktis');
            //nuskaitom ukininko duomenis
            $ukis = $this->ukininkai_model->ukininkas($ukininkas);
            if (count($ukis) == 0) {
                $this->main_model->info['error'][] = "Ūkininkas neegzistuoja, ar / arba klaidos sistemoje, praneškite adminitratoriui!"; $klaida = TRUE;}
            //jei sesijos duomenis neatitinka su pasirinktu ukininku, atnaujinam sesijos informacija
            if($sesija['nr'] != $ukininkas){
                $new = array('vardas' => $ukis[0]['vardas'], 'pavarde' => $ukis[0]['pavarde'], 'nr' => $ukininkas);
                $this->session->set_userdata($new);
            }

            //sukeliam informacija kuria naudosim
            $this->main_model->info['txt']['vardas'] = $ukis[0]['vardas'];
            $this->main_model->info['txt']['pavarde'] = $ukis[0]['pavarde'];
            $this->main_model->info['txt']['metai'] = $metai;
            $this->main_model->info['txt']['menesis'] = $menesis;
            //apskaiciuojam NUO IKI
            //uzkomentuota bandymas pasirinkti skrtungus NUO IKI
            /*if($rinktis == 1){
                //$num_day = cal_days_in_month(CAL_GREGORIAN, $menesis, $metai);
                if($menesis < 10){$men = "0".$menesis;}else{$men = $menesis;}
                $data1 = $metai."-".$men."-01";
                if($menesis == 12){$met = $metai+1; $men = "01";}else{
                    $met = $metai;  if($menesis < 10){$men = "0".($menesis+1);}else{$men = $menesis+1;}}
                $data2 = $met."-".$men."-01";
            }*/
            //if($rinktis == 2){
                $num_day = cal_days_in_month(CAL_GREGORIAN, $menesis, $metai);
                if($menesis < 10){$men = "0".$menesis;}else{$men = $menesis;}
                $data1 = $metai."-".$men."-01";
                $data2 = $metai."-".$men."-".$num_day;
            //}

            //adresai
            $gyvi_url = "https://www.vic.lt:8102/pls/gris/private.gyvuliu_sarasas";
            $visi_url = "https://www.vic.lt:8102/pls/gris/private.laikytojo_gyvuliai_frame";

            //duomenys kuriuos sius CURL
            $auth = $ukis[0]['VIC_vartotojo_vardas'].":".$ukis[0]['VIC_slaptazodis'];
            $post1 = ['v_data' => $data2, 'v_rus' => 1];
            $post2 = ['v_nuo' => $data1,'v_iki' => $data2, 'v_rus' => 1];

            //apdoroti duomenis prie irasant i duomenu baze.
            //kiekviena irasa reikia patikrinti, artoks nera, nes prie visi galvijai dubliuojasi
            $kiek = $this->galvijai_model->tikinti_gyvulius_ikelti($metai, $menesis, $ukininkas);
            $this->main_model->info['txt']['galviju_sk'] = $kiek;
            //ikelti galima tik praejusi menesi
            if(date("n") <= $menesis && date("Y") == $metai){
                $this->main_model->info['error'][] = $metai.' '.$this->main_model->menesiai[$menesis-1].', šitas menesis dar nesibaigė, negalite įkelti'; $klaida = TRUE;}
            //reik patikrinti ar antra karta neitraukia gyvulio ta pati menesi
            if($kiek > 0){$this->main_model->info['error'][] = $metai.' '.$this->main_model->menesiai[$menesis-1].', jau esate pridejes gyvulius!'; $klaida = TRUE;}
            //ikelia duomenis i duomenu baze
            if(!$klaida) {
                //bandom nuskaityri duomenis
                $page = $this->galvijai_model->get_VIC($gyvi_url, $post1, $auth);
                $page2 = $this->galvijai_model->get_VIC($visi_url, $post2, $auth);
                $data_gyvi = $this->galvijai_model->Gyvi_gyvunai($page['content']);
                $data_visi = $this->galvijai_model->Visi_gyvunai($page2['content']);
                $this->galvijai_model->Irasyti_visus($data_visi, $ukininkas, $metai, $menesis);
                $this->galvijai_model->Atnaujinti_visus($data_gyvi, $ukininkas, $metai, $menesis);
                $this->main_model->info['error'][] = 'Nuo '.$data1.' iki '.$data2.', ūkininko '.$ukis[0]['vardas'].' '.$ukis[0]['pavarde'].' galvijai įtraukti į duomenų bazę!';
            }
        }else{$this->main_model->info['error'][] = "Problemos, nepasirinktas ukininkas, blogi metai, ar menesis";}

        $this->load->view("galvijai/ikelti_duomenis");
    }

    public function istrinti_viclt(){
        $klaida = FALSE;
        $sesija = $this->session->userdata();

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('ukininkas', 'Vardas Pavardė', 'required',  array('required' => 'Pasirinkite ūkininką.'));
        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
        $this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

        if ($this->form_validation->run()) {
            $ukininkas = $this->input->post('ukininkas');
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');
            //nuskaitom ukininko duomenis
            $ukis = $this->ukininkai_model->ukininkas($ukininkas);
            if(count($ukis) > 0){
                //jei sesijos duomenis neatitinka su pasirinktu ukininku, atnaujinam sesijos informacija
                if ($sesija['nr'] != $ukininkas) {
                    $new = array('vardas' => $ukis[0]['vardas'], 'pavarde' => $ukis[0]['pavarde'], 'nr' => $ukininkas);
                    $this->session->set_userdata($new);
                }
                //sukeliam informacija kuria naudosim
                $this->main_model->info['txt']['vardas'] = $ukis[0]['vardas'];
                $this->main_model->info['txt']['pavarde'] = $ukis[0]['pavarde'];
                $this->main_model->info['txt']['metai'] = $metai;
                $this->main_model->info['txt']['menesis'] = $menesis;

                $kiek = $this->galvijai_model->tikinti_gyvulius_ikelti($metai, $menesis, $ukininkas);
                $this->main_model->info['txt']['galviju_sk'] = $kiek;
                if($kiek > 0) {
                    $data = array("ukininkas" => $ukininkas, "metai" => $metai, "menesis" => $menesis);
                    $this->galvijai_model->istrinti_galvijus($data);
                    $istrinta = $this->galvijai_model->tikinti_gyvulius_ikelti($metai, $menesis, $ukininkas);
                    if($istrinta > 0){
                        $this->main_model->info['error'][] = $metai . ' ' . $this->main_model->menesiai[$menesis - 1] . ', nepavyko ištrinti duomenų!';
                    }else{$this->main_model->info['error'][] = $metai . ' ' . $this->main_model->menesiai[$menesis - 1] . ', duomeny sėkmingai ištrinti!';}
                }else{$this->main_model->info['error'][] = $metai . ' ' . $this->main_model->menesiai[$menesis - 1] . ', dar nesate įkėlęs galvijų!';}
            }else{$this->main_model->info['error'][] = "Ūkininkas neegzistuoja, ar / arba klaidos sistemoje, praneškite adminitratoriui!";}
        }else{ $this->main_model->info['error'][] = "Problemos, nepasirinktas ukininkas, blogi metai, ar menesis";}
        $this->load->view("galvijai/istrinti_duomenis");
    }

    public function galviju_judejimas(){
        $sesija = $this->session->userdata();

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('ukininkas', 'Vardas Pavardė', 'required',  array('required' => 'Pasirinkite ūkininką.'));
        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
        $this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

        if ($this->form_validation->run()) {
            $ukininkas = $this->input->post('ukininkas');
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');
            //nuskaitom ukininko duomenis
            $ukis = $this->ukininkai_model->ukininkas($ukininkas);
            if(count($ukis) > 0){
            //jei sesijos duomenis neatitinka su pasirinktu ukininku, atnaujinam sesijos informacija
            if($sesija['nr'] != $ukininkas){
                $new = array('vardas' => $ukis[0]['vardas'], 'pavarde' => $ukis[0]['pavarde'], 'nr' => $ukininkas);
                $this->session->set_userdata($new);
            }
            //sukeliam informacija kuria naudosim
            $this->main_model->info['txt']['vardas'] = $ukis[0]['vardas'];
            $this->main_model->info['txt']['pavarde'] = $ukis[0]['pavarde'];
            $this->main_model->info['txt']['metai'] = $metai;
            $this->main_model->info['txt']['menesis'] = $menesis;
            $this->main_model->info['txt']['banda'] = $ukis[0]['banda'];
            //bandos nustatymas
            //1: pieniniai
            //2: mesiniai
            //3: pieniniai ir mesiniai reikia atskirti
            $banda = $ukis[0]['banda'];

            //nuskaitom visus gyvulius, pasirinkto menesio
            $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
            $rezultatai_dabar = $this->galvijai_model->nuskaityti_gyvulius($dat);
            //pakeiciam kintamuju vardus, jei pagrindinius noresim veliau panaudoti kad nesusigadintu
            $met = $metai;  $men = $menesis;
            if($men>1){$men--; }else{$men=12; $met--;}
            //nuskaitom visus gyvulius, pries tai buvusio menesio
            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'amzius !=' => "" );
            $rezultatai_vakar = $this->galvijai_model->nuskaityti_gyvulius($dat);

            if(count($rezultatai_dabar) > 0 && count($rezultatai_vakar) > 0) {
                //nuskaitom gyvuliu kieki menesio pradzioje, tik kieki, daugiau nieko nereikia
                foreach ($rezultatai_vakar as $sk) {
                    $one = explode(" ", $sk['lytis']);
                    if ($one[0] == "Karvė") {
                        if ($banda == '3') {
                            if ($sk['veisle'] == "Limuzinai") {
                                $this->galvijai_model->mesiniai['karves']['pradzia']++;
                            } else {
                                $this->galvijai_model->galvijai['karves']['pradzia']++;
                            }
                        } else {
                            $this->galvijai_model->galvijai['karves']['pradzia']++;
                        }
                    }

                    if ($one[0] == "Buliukas") {
                        if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['buliai_12']['pradzia']++;
                                } else {
                                    $this->galvijai_model->galvijai['buliai_12']['pradzia']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['buliai_12']['pradzia']++;
                            }
                        }
                        if ($sk['amzius'] >= 24) {
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['buliai_24']['pradzia']++;
                                } else {
                                    $this->galvijai_model->galvijai['buliai_24']['pradzia']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['buliai_24']['pradzia']++;
                            }
                        }
                        if ($sk['amzius'] < 12 AND $sk['amzius'] != "") {
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['verseliai']['pradzia']++;
                                } else {
                                    $this->galvijai_model->galvijai['verseliai']['pradzia']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['verseliai']['pradzia']++;
                            }
                        }
                    }

                    if ($one[0] == "Telyčaitė") {
                        if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['telycios_12']['pradzia']++;
                                } else {
                                    $this->galvijai_model->galvijai['telycios_12']['pradzia']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['telycios_12']['pradzia']++;
                            }
                        }
                        if ($sk['amzius'] >= 24) {
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['telycios_24']['pradzia']++;
                                } else {
                                    $this->galvijai_model->galvijai['telycios_24']['pradzia']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['telycios_24']['pradzia']++;
                            }
                        }
                        if ($sk['amzius'] < 12 AND $sk['amzius'] != "") {
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['verseliai']['pradzia']++;
                                } else {
                                    $this->galvijai_model->galvijai['verseliai']['pradzia']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['verseliai']['pradzia']++;
                            }
                        }
                    }
                }

                //skaiciuojam kiek gyvuliu menesio gale
                foreach ($rezultatai_dabar as $sk) {
                    $one = explode(" ", $sk['lytis']);
                    //Karviu skaiciavimas
                    if ($one[0] == "Karvė") {
                        //karve vis dar egzistuoja
                        if ($sk['amzius'] != "") {
                            //skaiciuojam menesio pabaiga
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['karves']['pabaiga']++;
                                } else {
                                    $this->galvijai_model->galvijai['karves']['pabaiga']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['karves']['pabaiga']++;
                            }
                            //nupirktos karves
                            $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                            $laikas = explode(".", $sk['laikymo_pradzia']);
                            if ($laikas[0] == $metai AND $laikas[1] == $menesis) {
                                if ($banda == '3') {
                                    if ($sk['veisle'] == "Limuzinai") {
                                        $this->galvijai_model->mesiniai['karves']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['karves'][] = $da;
                                    } else {
                                        $this->galvijai_model->galvijai['karves']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['karves'][] = $da;
                                    }
                                } else {
                                    $this->galvijai_model->galvijai['karves']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['karves'][] = $da;
                                }
                            }
                            //karviu judejimas is telyciu
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $this->galvijai_model->karviu_judejimas($dat, $banda);
                        } else {
                            //is telyciu pereina i karves ir parduodama, dingsta
                            //karviu judejimas is telyciu
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $this->galvijai_model->karviu_judejimas($dat, $banda);

                            //issifiltruojam ivykio koda
                            $pp = $this->galvijai_model->ivykio_kodas($sk['laikymo_pabaiga']);
                            //tikrinsim pagal ivykio koda kas nutiko gyvuliui
                            $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                            $this->galvijai_model->ivykio_skaiciavimas($pp, $banda, "karves", $dd);
                        }
                    }

                    //Buliuku skaiciavimas
                    if ($one[0] == "Buliukas") {
                        //buliukai nuo 12 iki 24
                        if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['buliai_12']['pabaiga']++;
                                } else {
                                    $this->galvijai_model->galvijai['buliai_12']['pabaiga']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['buliai_12']['pabaiga']++;
                            }
                            //$this->galvijai_model->galvijai['buliai_12']['pabaiga']++;
                            if ($sk['amzius'] >= 12 AND $sk['amzius'] < 14) {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                                if (!empty($am)) {
                                    if ($am[0]['amzius'] < 12) {
                                        if ($banda == '3') {
                                            if ($sk['veisle'] == "Limuzinai") {
                                                $this->galvijai_model->mesiniai['buliai_12']['j_i']++;
                                                $this->galvijai_model->mesiniai['verseliai']['j_is']++;
                                            } else {
                                                $this->galvijai_model->galvijai['buliai_12']['j_i']++;
                                                $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                            }
                                        } else {
                                            $this->galvijai_model->galvijai['buliai_12']['j_i']++;
                                            $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                        }
                                        //$this->galvijai_model->galvijai['buliai_12']['j_i']++;
                                        //$this->galvijai_model->galvijai['verseliai']['j_is']++;
                                    }
                                }
                            }
                            //tikrinam ar nera nupirktas
                            $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                            $lka = explode(".", $sk['laikymo_pradzia']);
                            $info = explode(" ", $sk['informacija']);
                            if ($lka[0] == $metai AND $lka[1] == $menesis AND $info[1] == 'Atvyko') {
                                if ($banda == '3') {
                                    if ($sk['veisle'] == "Limuzinai") {
                                        $this->galvijai_model->mesiniai['buliai_12']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['buliai_12'][] = $da;
                                    } else {
                                        $this->galvijai_model->galvijai['buliai_12']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['buliai_12'][] = $da;
                                    }
                                } else {
                                    $this->galvijai_model->galvijai['buliai_12']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['buliai_12'][] = $da;
                                }
                            }
                        }

                        //Buliukai virs 24
                        if ($sk['amzius'] >= 24) {
                            //$this->galvijai_model->galvijai['buliai_24']['pabaiga']++;
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['buliai_24']['pabaiga']++;
                                } else {
                                    $this->galvijai_model->galvijai['buliai_24']['pabaiga']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['buliai_24']['pabaiga']++;
                            }
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                            if (!empty($am)) {
                                if ($am[0]['amzius'] < 24) {
                                    if ($banda == '3') {
                                        if ($sk['veisle'] == "Limuzinai") {
                                            $this->galvijai_model->mesiniai['buliai_24']['j_i']++;
                                            $this->galvijai_model->mesiniai['buliai_12']['j_is']++;
                                        } else {
                                            $this->galvijai_model->galvijai['buliai_24']['j_i']++;
                                            $this->galvijai_model->galvijai['buliai_12']['j_is']++;
                                        }
                                    } else {
                                        $this->galvijai_model->galvijai['buliai_24']['j_i']++;
                                        $this->galvijai_model->galvijai['buliai_12']['j_is']++;
                                    }
                                    //$this->galvijai_model->galvijai['buliai_24']['j_i']++;
                                    //$this->galvijai_model->galvijai['buliai_12']['j_is']++;
                                }
                            }
                            //tikrinam ar nera nupirktas
                            $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                            $lk = explode(".", $sk['laikymo_pradzia']);
                            $info = explode(" ", $sk['informacija']);
                            if ($lk[0] == $metai AND $lk[1] == $menesis AND $info[1] == 'Atvyko') {
                                if ($banda == '3') {
                                    if ($sk['veisle'] == "Limuzinai") {
                                        $this->galvijai_model->mesiniai['buliai_24']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['buliai_24'][] = $da;
                                    } else {
                                        $this->galvijai_model->galvijai['buliai_24']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['buliai_24'][] = $da;
                                    }
                                } else {
                                    $this->galvijai_model->galvijai['buliai_24']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['buliai_24'][] = $da;
                                }
                            }
                        }

                        //Buliukai mezesni negu 12
                        if ($sk['amzius'] < 12 AND $sk['amzius'] != "") {
                            //$this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['verseliai']['pabaiga']++;
                                } else {
                                    $this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                            }

                            //tikrinti gimimus pagal laikymo pradzia, nes jei pagal gimimo data buna kad neatitinka data, buna gimsta sausi, laikymo pradzia vasari
                            //nevisada pagal gimimo data tinka gimimui indentifikuoti
                            $lp = explode(".", $sk['laikymo_pradzia']);
                            $info = explode(" ", $sk['informacija']);
                            if ($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs') {
                                //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                if ($banda == '3') {
                                    if ($sk['veisle'] == "Limuzinai") {
                                        $this->galvijai_model->mesiniai['verseliai']['gimimai']++;
                                    } else {
                                        $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    }
                                } else {
                                    $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                }
                            }
                            //reik del gimimu dar patikrinti ar nera atgaline tvarka irasytas
                            if ($lp[0] == $metai AND $lp[1] == $menesis - 1 AND $info[1] == 'Gimęs') {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                                if (empty($am)) {
                                    //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    if ($banda == '3') {
                                        if ($sk['veisle'] == "Limuzinai") {
                                            $this->galvijai_model->mesiniai['verseliai']['gimimai']++;
                                        } else {
                                            $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                        }
                                    } else {
                                        $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    }
                                }
                            }
                            $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                            if ($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Atvyko') {
                                if ($banda == '3') {
                                    if ($sk['veisle'] == "Limuzinai") {
                                        $this->galvijai_model->mesiniai['verseliai']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['verseliai'][] = $da;
                                    } else {
                                        $this->galvijai_model->galvijai['verseliai']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['verseliai'][] = $da;
                                    }
                                } else {
                                    $this->galvijai_model->galvijai['verseliai']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['verseliai'][] = $da;
                                }
                            }
                        }

                        //jei yra tuscias, reikia galvijai kazkur iskeliavo, reik issiaiskintu kur
                        if ($sk['amzius'] == "") {
                            $pr = str_replace(".", "-", $sk['gimimo_data']);
                            if (strstr($sk['laikymo_pabaiga'], '*')) {
                                $pp = explode("*", $sk['laikymo_pabaiga']);
                                $pp = explode(" ", $pp[1]);
                            } else {
                                $pp = explode(" ", $sk['laikymo_pabaiga']);
                            }

                            $pb = str_replace(".", "-", $pp[0]);
                            $pb = str_replace(">", "", $pb);

                            $da = $this->galvijai_model->dateDifference($pr, $pb, '%y-%m-%d');
                            $dd = explode("-", $da);
                            $mo = $dd[0] * 12 + $dd[1];

                            //reik atsifiltruoti dingimo koduka, gali buti ne tik parduota bet ir kritimas arba suvartota sau
                            $pa = $this->galvijai_model->ivykio_kodas($sk['laikymo_pabaiga']);


                            if ($mo >= 12 AND $mo < 24) {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                                if ($am[0]['amzius'] < 12) {
                                    if ($banda == '3') {
                                        if ($sk['veisle'] == "Limuzinai") {
                                            $this->galvijai_model->mesiniai['buliai_12']['j_i']++;
                                            $this->galvijai_model->mesiniai['verseliai']['j_is']++;
                                        } else {
                                            $this->galvijai_model->galvijai['buliai_12']['j_i']++;
                                            $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                        }
                                    } else {
                                        $this->galvijai_model->galvijai['buliai_12']['j_i']++;
                                        $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                    }
                                    //$this->galvijai_model->galvijai['verseliai']['j_is']++;
                                    //$this->galvijai_model->galvijai['buliai_12']['j_i']++;
                                }
                                $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                                $this->galvijai_model->ivykio_skaiciavimas($pa, $banda, "buliai_12", $dd);
                            }
                            if ($mo >= 24) {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                                if ($am[0]['amzius'] < 24) {
                                    if ($banda == '3') {
                                        if ($sk['veisle'] == "Limuzinai") {
                                            $this->galvijai_model->mesiniai['buliai_24']['j_i']++;
                                            $this->galvijai_model->mesiniai['buliai_12']['j_is']++;
                                        } else {
                                            $this->galvijai_model->galvijai['buliai_24']['j_i']++;
                                            $this->galvijai_model->galvijai['buliai_12']['j_is']++;
                                        }
                                    } else {
                                        $this->galvijai_model->galvijai['buliai_24']['j_i']++;
                                        $this->galvijai_model->galvijai['buliai_12']['j_is']++;
                                    }
                                    //$this->galvijai_model->galvijai['buliai_12']['j_is']++;
                                    //$this->galvijai_model->galvijai['buliai_24']['j_i']++;
                                }
                                $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                                $this->galvijai_model->ivykio_skaiciavimas($pa, $banda, "buliai_24", $dd);
                            }
                            if ($mo < 12) {
                                $lp = explode(".", $sk['laikymo_pradzia']);
                                $info = explode(" ", $sk['informacija']);
                                if ($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs') {
                                    //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    if ($banda == '3') {
                                        if ($sk['veisle'] == "Limuzinai") {
                                            $this->galvijai_model->mesiniai['verseliai']['gimimai']++;
                                        } else {
                                            $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                        }
                                    } else {
                                        $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    }
                                }
                                $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                                $this->galvijai_model->ivykio_skaiciavimas($pa, $banda, "verseliai", $dd);
                            }


                        }
                    }

                    if ($one[0] == "Telyčaitė") {
                        //Telycaites nuo 12 iki 24
                        if ($sk['amzius'] >= 12 AND $sk['amzius'] < 24) {
                            //$this->galvijai_model->galvijai['telycios_12']['pabaiga']++;
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['telycios_12']['pabaiga']++;
                                } else {
                                    $this->galvijai_model->galvijai['telycios_12']['pabaiga']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['telycios_12']['pabaiga']++;
                            }

                            if ($sk['amzius'] >= 12 AND $sk['amzius'] < 14) {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                                if (!empty($am) AND $am[0]['amzius'] < 12) {
                                    if ($banda == '3') {
                                        if ($sk['veisle'] == "Limuzinai") {
                                            $this->galvijai_model->mesiniai['telycios_12']['j_i']++;
                                            $this->galvijai_model->mesiniai['verseliai']['j_is']++;
                                        } else {
                                            $this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                            $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                        }
                                    } else {
                                        $this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                        $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                    }
                                    //$this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                    //$this->galvijai_model->galvijai['verseliai']['j_is']++;
                                }
                            }
                            //pirkimai
                            $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                            $lk = explode(".", $sk['laikymo_pradzia']);
                            $info = explode(" ", $sk['informacija']);
                            if ($lk[0] == $metai AND $lk[1] == $menesis AND $info[1] == 'Atvyko') {
                                if ($banda == '3') {
                                    if ($sk['veisle'] == "Limuzinai") {
                                        $this->galvijai_model->mesiniai['telycios_12']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['telycios_12'][] = $da;
                                    } else {
                                        $this->galvijai_model->galvijai['telycios_12']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['telycios_12'][] = $da;
                                    }
                                } else {
                                    $this->galvijai_model->galvijai['telycios_12']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['telycios_12'][] = $da;
                                }
                            }

                        }

                        //Telycaites virs 24
                        if ($sk['amzius'] >= 24) {
                            //$this->galvijai_model->galvijai['telycios_24']['pabaiga']++;
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['telycios_24']['pabaiga']++;
                                } else {
                                    $this->galvijai_model->galvijai['telycios_24']['pabaiga']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['telycios_24']['pabaiga']++;
                            }

                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                            if (!empty($am)) {
                                if ($am[0]['amzius'] < 24) {
                                    if ($banda == '3') {
                                        if ($sk['veisle'] == "Limuzinai") {
                                            $this->galvijai_model->mesiniai['telycios_24']['j_i']++;
                                            $this->galvijai_model->mesiniai['telycios_12']['j_is']++;
                                        } else {
                                            $this->galvijai_model->galvijai['telycios_24']['j_i']++;
                                            $this->galvijai_model->galvijai['telycios_12']['j_is']++;
                                        }
                                    } else {
                                        $this->galvijai_model->galvijai['telycios_24']['j_i']++;
                                        $this->galvijai_model->galvijai['telycios_12']['j_is']++;
                                    }
                                    //$this->galvijai_model->galvijai['telycios_24']['j_i']++;
                                    //$this->galvijai_model->galvijai['telycios_12']['j_is']++;
                                }
                            }
                            //pirkimai
                            $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                            $lk = explode(".", $sk['laikymo_pradzia']);
                            $info = explode(" ", $sk['informacija']);
                            if ($lk[0] == $metai AND $lk[1] == $menesis AND $info[1] == 'Atvyko') {
                                if ($banda == '3') {
                                    if ($sk['veisle'] == "Limuzinai") {
                                        $this->galvijai_model->mesiniai['telycios_24']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['telycios_24'][] = $da;
                                    } else {
                                        $this->galvijai_model->galvijai['telycios_24']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['telycios_24'][] = $da;
                                    }
                                } else {
                                    $this->galvijai_model->galvijai['telycios_24']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['telycios_24'][] = $da;
                                }
                            }
                        }

                        //Telycaites mazesnios negu 12
                        if ($sk['amzius'] < 12 AND $sk['amzius'] != "") {
                            //$this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                            if ($banda == '3') {
                                if ($sk['veisle'] == "Limuzinai") {
                                    $this->galvijai_model->mesiniai['verseliai']['pabaiga']++;
                                } else {
                                    $this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                                }
                            } else {
                                $this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                            }

                            $lp = explode(".", $sk['laikymo_pradzia']);
                            $info = explode(" ", $sk['informacija']);
                            if ($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs') {
                                //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                if ($banda == '3') {
                                    if ($sk['veisle'] == "Limuzinai") {
                                        $this->galvijai_model->mesiniai['verseliai']['gimimai']++;
                                    } else {
                                        $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    }
                                } else {
                                    $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                }
                            }
                            //reik del gimimu dar patikrinti ar nera atgaline tvarka irasytas
                            if ($lp[0] == $metai AND $lp[1] == $menesis - 1 AND $info[1] == 'Gimęs') {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                                if (empty($am)) {
                                    //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    if ($banda == '3') {
                                        if ($sk['veisle'] == "Limuzinai") {
                                            $this->galvijai_model->mesiniai['verseliai']['gimimai']++;
                                        } else {
                                            $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                        }
                                    } else {
                                        $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    }
                                }
                            }

                            $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                            if ($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Atvyko') {
                                //$this->galvijai_model->galvijai['verseliai']['pirkimai']++;
                                if ($banda == '3') {
                                    if ($sk['veisle'] == "Limuzinai") {
                                        $this->galvijai_model->mesiniai['verseliai']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['verseliai'][] = $da;
                                    } else {
                                        $this->galvijai_model->galvijai['verseliai']['pirkimai']++;
                                        $this->galvijai_model->pirkimai['verseliai'][] = $da;
                                    }
                                } else {
                                    $this->galvijai_model->galvijai['verseliai']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['verseliai'][] = $da;
                                }
                            }
                        }

                        //jei yra tuscias, reikia galvijai kazkur iskeliavo, reik issiaiskintu kur
                        //reik atsifiltruoti dingimo koduka, gali buti ne tik parduota bet ir kritimas arba suvartota sau
                        ////////////////////////////////////////////
                        //pasitikrinti amziu ar pries pardavima nebuvo kitoje kategorijoje, perejo ir iskart pardave

                        if ($sk['amzius'] == "") {
                            $pr = str_replace(".", "-", $sk['gimimo_data']);

                            if (strstr($sk['laikymo_pabaiga'], '*')) {
                                $pp = explode("*", $sk['laikymo_pabaiga']);
                                $pp = explode(" ", $pp[1]);
                            } else {
                                $pp = explode(" ", $sk['laikymo_pabaiga']);
                            }
                            $pb = str_replace(".", "-", $pp[0]);
                            $pb = str_replace(">", "", $pb);

                            $da = $this->galvijai_model->dateDifference($pr, $pb, '%y-%m-%d');
                            $dd = explode("-", $da);
                            $mo = $dd[0] * 12 + $dd[1];
                            //reik atsifiltruoti dingimo koduka, gali buti ne tik parduota bet ir kritimas arba suvartota sau
                            $pa = $this->galvijai_model->ivykio_kodas($sk['laikymo_pabaiga']);

                            //tikrinama kas atsitiko gyvuliams, kur dingo?
                            if ($mo >= 12 AND $mo < 24) {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                                if ($am[0]['amzius'] < 12) {
                                    if ($banda == '3') {
                                        if ($sk['veisle'] == "Limuzinai") {
                                            $this->galvijai_model->mesiniai['telycios_12']['j_i']++;
                                            $this->galvijai_model->mesiniai['verseliai']['j_is']++;
                                        } else {
                                            $this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                            $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                        }
                                    } else {
                                        $this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                        $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                    }
                                    //$this->galvijai_model->galvijai['verseliai']['j_is']++;
                                    //$this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                }
                                $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                                $this->galvijai_model->ivykio_skaiciavimas($pa, $banda, "telycios_12", $dd);
                            }
                            if ($mo >= 24) {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                                if ($am[0]['amzius'] < 24) {
                                    if ($banda == '3') {
                                        if ($sk['veisle'] == "Limuzinai") {
                                            $this->galvijai_model->mesiniai['telycios_24']['j_i']++;
                                            $this->galvijai_model->mesiniai['telycios_12']['j_is']++;
                                        } else {
                                            $this->galvijai_model->galvijai['telycios_24']['j_i']++;
                                            $this->galvijai_model->galvijai['telycios_12']['j_is']++;
                                        }
                                    } else {
                                        $this->galvijai_model->galvijai['telycios_24']['j_i']++;
                                        $this->galvijai_model->galvijai['telycios_12']['j_is']++;
                                    }
                                    //$this->galvijai_model->galvijai['telycios_12']['j_is']++;
                                    //$this->galvijai_model->galvijai['telycios_24']['j_i']++;
                                }
                                $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                                $this->galvijai_model->ivykio_skaiciavimas($pa, $banda, "telycios_24", $dd);
                            }
                            if ($mo < 12) {
                                $lp = explode(".", $sk['laikymo_pradzia']);
                                $info = explode(" ", $sk['informacija']);
                                if ($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs') {
                                    //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    if ($banda == '3') {
                                        if ($sk['veisle'] == "Limuzinai") {
                                            $this->galvijai_model->mesiniai['verseliai']['gimimai']++;
                                        } else {
                                            $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                        }
                                    } else {
                                        $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    }
                                }
                                $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                                $this->galvijai_model->ivykio_skaiciavimas($pa, $banda, "verseliai", $dd);
                            }
                        }
                    }
                }
                //suskaiciuoti lenteleje, viso kiekius GYVULIAI
                $keys = array_keys($this->galvijai_model->galvijai['karves']);
                foreach ($keys as $ro) {
                    $sumDetail = $ro;
                    $this->galvijai_model->galvijai['viso'][$ro] = array_reduce($this->galvijai_model->galvijai,
                        function ($runningTotal, $record) use ($sumDetail) {
                            $runningTotal += $record[$sumDetail];
                            return $runningTotal;
                        }, 0);
                }

                //suskaiciuoti lenteleje, viso kiekius MESINIAI
                if ($banda == '3') {
                    $keys = array_keys($this->galvijai_model->mesiniai['karves']);
                    foreach ($keys as $ro) {
                        $sumDetail = $ro;
                        $this->galvijai_model->mesiniai['viso'][$ro] = array_reduce($this->galvijai_model->mesiniai,
                            function ($runningTotal, $record) use ($sumDetail) {
                                $runningTotal += $record[$sumDetail];
                                return $runningTotal;
                            }, 0);
                    }
                }
            }else{$this->main_model->info['error'][] = "Norint suskaičiuoti galvijų judėjimą, reikia pasirinkto menesio ir vieno menesio pries tai, duomenu";}
            }else{$this->main_model->info['error'][] = "Ūkininkas neegzistuoja, ar / arba klaidos sistemoje, praneškite adminitratoriui!";}
        }else{ $this->main_model->info['error'][] = "Problemos, nepasirinktas ukininkas, blogi metai, ar menesis";}
        $this->load->view("galvijai/galviju_judejimas");
    }


    ///////////////////////////////////////////////////////////////////////////////// SENA ////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////// RODOMAS GYVULIU SARASAS //////////////////////////////////////////////
    public function gyvuliu_sarasas(){
        $gyvu = array();
        $dt = $this->session->userdata();

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($dt['vardas'] == "" AND $dt['pavarde'] == "") {
            $this->form_validation->set_rules('ukininkas', 'Vardas Pavardė', 'required', array('required' => 'Pasirinkite ūkininką.'));
            $ukininkas = $this->input->post('ukininkas');
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

            $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
            $this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

            if ($this->form_validation->run()) {
                $metai = $this->input->post('metai');
                $menesis = $this->input->post('menesis');

                $this->main_model->info['txt']['metai'] = $metai;
                $this->main_model->info['txt']['menesis'] = $menesis;

                $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
                $psl = $this->galvijai_model->nuskaityti_gyvulius($dat);
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

                $this->main_model->info['error']['action'] = true;
            }
        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Galvijai";
        $this->main_model->info['txt']['info'] = "Galvijų sąrašas";

        $user = $this->ion_auth->user()->row();
        //Nuskaitom ukininku sarasa, kad butu visada po ranka
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas( $user->id, TRUE);
        $this->load->view("main_view", array('gyvu' => $gyvu));
    }

    ///////////////////////////////////////////// IKELIAMI DUOMENYS IS VIC.LT  //////////////////////////////////////////////
    public function nuskaityti_vic(){
        $dt = $this->session->userdata();

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if($dt['vardas'] == "" AND $dt['pavarde'] == "") {
            $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required',  array('required' => 'Pasirinkite ūkininką.'));
            $ukininkas = $this->input->post('ukininko_vardas');
            $uk = $this->ukininkai_model->ukininkas($ukininkas);
            $this->main_model->info['txt']['vardas'] = $uk[0]['vardas'];
            $this->main_model->info['txt']['pavarde'] = $uk[0]['pavarde'];
            $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
            $this->session->set_userdata($new);
        }else{
            $ukininkas = $dt['nr'];
            $this->main_model->info['txt']['vardas'] = $dt['vardas'];
            $this->main_model->info['txt']['pavarde'] = $dt['pavarde'];
        }

        $this->form_validation->set_rules('data1', 'Data-1', 'required', array('required' => 'Pasirinkite data.'));
        $this->form_validation->set_rules('data2', 'Data-2', 'required', array('required' => 'Pasirinkite data.'));

        if ($this->form_validation->run()) {
            $data1 = $this->input->post('data1');
            $data2 = $this->input->post('data2');

            $this->main_model->info['txt']['data1'] = $data1;
            $this->main_model->info['txt']['data2'] = $data2;

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

            $page = $this->galvijai_model->get_VIC($gyvi_url, $post1, $auth);
            $page2 = $this->galvijai_model->get_VIC($visi_url, $post2, $auth);

            $data_gyvi = $this->galvijai_model->Gyvi_gyvunai($page['content']);
            $data_visi = $this->galvijai_model->Visi_gyvunai($page2['content']);

            //apdoroti duomenis prie irasant i duomenu baze.
            //kiekviena irasa reikia patikrinti, artoks nera, nes prie visi galvijai dubliuojasi
            $kiek = $this->galvijai_model->tikinti_gyvulius_ikelti($metai, $menesis, $ukininkas);
            $men = array("Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa",
                "Rugpjūtis", "Rugsėjis", "Spalis","Lapkritis", "Gruodis");
            //reik patikrinti ar antra karta neitraukia gyvulio ta pati menesi
            //buna kad prie visu gyvuliu pagal nr dubliuojasi
            if($kiek>0){
                $this->main_model->info['error']['jau_yra'] = $metai.' '.$men[$menesis-1].', jau esate pridejes gyvulius!';
            }else{
                //ikelia duomenis i duomenu baze
                $this->galvijai_model->Irasyti_visus($data_visi, $ukininkas, $metai, $menesis);
                $this->galvijai_model->Atnaujinti_visus($data_gyvi, $ukininkas, $metai, $menesis);
                $this->main_model->info['error']['OK'] = $metai.' '.$men[$menesis-1].' galvijai įtraukti į duomenų bazę!';
            }
        }
        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Galvijai";
        $this->main_model->info['txt']['info'] = "Naujų galvijų įtraukimas";

        $user = $this->ion_auth->user()->row();
        //Nuskaitom ukininku sarasa, kad butu visada po ranka
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas( $user->id, TRUE);
        $this->load->view("main_view");
    }

    ///////////////////////////////////////////// SKAICIUOJAMI GALVIJAI //////////////////////////////////////////////
    public function skaiciuoti_gyvulius(){
        $dt = $this->session->userdata();

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if($dt['vardas'] == "" AND $dt['pavarde'] == "") {
            $this->form_validation->set_rules('ukininko_vardas', 'Vardas Pavardė', 'required',  array('required' => 'Pasirinkite ūkininką.'));
            $ukininkas = $this->input->post('ukininko_vardas');
            $uk = $this->ukininkai_model->ukininkas($ukininkas);
            $this->main_model->info['txt']['vardas'] = $uk[0]['vardas'];
            $this->main_model->info['txt']['pavarde'] = $uk[0]['pavarde'];
            $new = array('vardas' => $uk[0]['vardas'], 'pavarde' => $uk[0]['pavarde'], 'nr' => $ukininkas);
            $this->session->set_userdata($new);
        }else{
            $ukininkas = $dt['nr'];
            $uk = $this->ukininkai_model->ukininkas($ukininkas);
            $this->main_model->info['txt']['vardas'] = $dt['vardas'];
            $this->main_model->info['txt']['pavarde'] = $dt['pavarde'];
        }
        $this->form_validation->set_rules('metai', 'Metai', 'required', array('required' => 'Pasirinkite metus.'));
        $this->form_validation->set_rules('menesis', 'Menesis', 'required', array('required' => 'Pasirinkite menesį.'));

        if ($this->form_validation->run()) {
            //gaunami ukininko nustatymai
            $metai = $this->input->post('metai');
            $menesis = $this->input->post('menesis');

            $this->main_model->info['txt']['metai'] = $metai;
            $this->main_model->info['txt']['menesis'] = $menesis;
            $this->main_model->info['txt']['banda'] = $uk[0]['banda'];
            //bandos nustatymas
            //1: pieniniai
            //2: mesiniai
            //3: pieniniai ir mesiniai reikia atskirti
            $banda = $uk[0]['banda'];

            //nuskaitom visus gyvulius, pasirinkto menesio
            $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
            $rezultatai_dabar = $this->galvijai_model->nuskaityti_gyvulius($dat);
            //pakeiciam kintamuju vardus, jei pagrindinius noresim veliau panaudoti kad nesusigadintu
            $met = $metai;  $men = $menesis;
            if($men>1){$men--; }else{$men=12; $met--;}
            //nuskaitom visus gyvulius, pries tai buvusio menesio
            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'amzius !=' => "" );
            $rezultatai_vakar = $this->galvijai_model->nuskaityti_gyvulius($dat);

            //nuskaitom gyvuliu kieki menesio pradzioje, tik kieki, daugiau nieko nereikia
            foreach($rezultatai_vakar as $sk){
                $one = explode(" ", $sk['lytis']);
                if($one[0] == "Karvė"){
                    if($banda == '3'){
                        if($sk['veisle'] == "Limuzinai"){
                        $this->galvijai_model->mesiniai['karves']['pradzia']++;}else{
                            $this->galvijai_model->galvijai['karves']['pradzia']++;
                        }
                    }else{
                        $this->galvijai_model->galvijai['karves']['pradzia']++;
                    }
                }

                if($one[0] == "Buliukas"){
                    if($sk['amzius']>=12 AND $sk['amzius']<24){
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['buliai_12']['pradzia']++;}else{
                                $this->galvijai_model->galvijai['buliai_12']['pradzia']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['buliai_12']['pradzia']++;
                        }
                    }
                    if($sk['amzius']>=24){
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['buliai_24']['pradzia']++;}else{
                                $this->galvijai_model->galvijai['buliai_24']['pradzia']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['buliai_24']['pradzia']++;
                        }
                    }
                    if($sk['amzius']<12 AND $sk['amzius']!=""){
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['verseliai']['pradzia']++;}else{
                                $this->galvijai_model->galvijai['verseliai']['pradzia']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['verseliai']['pradzia']++;
                        }
                    }
            }

                if($one[0] == "Telyčaitė"){
                    if($sk['amzius']>=12 AND $sk['amzius']<24){
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['telycios_12']['pradzia']++;}else{
                                $this->galvijai_model->galvijai['telycios_12']['pradzia']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['telycios_12']['pradzia']++;
                        }
                    }
                    if($sk['amzius']>=24){
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['telycios_24']['pradzia']++;}else{
                                $this->galvijai_model->galvijai['telycios_24']['pradzia']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['telycios_24']['pradzia']++;
                        }
                    }
                    if($sk['amzius']<12 AND $sk['amzius']!=""){
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['verseliai']['pradzia']++;}else{
                                $this->galvijai_model->galvijai['verseliai']['pradzia']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['verseliai']['pradzia']++;
                        }
                    }
                }
            }

            //skaiciuojam kiek gyvuliu menesio gale
            foreach($rezultatai_dabar as $sk){
                $one = explode(" ", $sk['lytis']);
                //Karviu skaiciavimas
                if($one[0] == "Karvė"){
                    //karve vis dar egzistuoja
                    if($sk['amzius'] != ""){
                        //skaiciuojam menesio pabaiga
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['karves']['pabaiga']++;}else{
                                $this->galvijai_model->galvijai['karves']['pabaiga']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['karves']['pabaiga']++;
                        }
                        //nupirktos karves
                        $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                        $laikas = explode(".",$sk['laikymo_pradzia']);
                        if($laikas[0] == $metai AND $laikas[1] == $menesis){
                            if($banda == '3'){
                                if($sk['veisle'] == "Limuzinai"){
                                    $this->galvijai_model->mesiniai['karves']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['karves'][] = $da;
                                }else{
                                    $this->galvijai_model->galvijai['karves']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['karves'][] = $da;
                                }
                            }else{
                                $this->galvijai_model->galvijai['karves']['pirkimai']++;
                                $this->galvijai_model->pirkimai['karves'][] = $da;
                            }
                        }
                        //karviu judejimas is telyciu
                        $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                        $this->galvijai_model->karviu_judejimas($dat, $banda);
                    }else{
                        //is telyciu pereina i karves ir parduodama, dingsta
                        //karviu judejimas is telyciu
                        $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                        $this->galvijai_model->karviu_judejimas($dat, $banda);

                        //issifiltruojam ivykio koda
                        $pp = $this->galvijai_model->ivykio_kodas($sk['laikymo_pabaiga']);
                        //tikrinsim pagal ivykio koda kas nutiko gyvuliui
                        $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                        $this->galvijai_model->ivykio_skaiciavimas($pp, $banda,  "karves", $dd);
                    }
                }

                //Buliuku skaiciavimas
                if($one[0] == "Buliukas"){
                    //buliukai nuo 12 iki 24
                    if($sk['amzius']>=12 AND $sk['amzius']<24){
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['buliai_12']['pabaiga']++;}else{
                                $this->galvijai_model->galvijai['buliai_12']['pabaiga']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['buliai_12']['pabaiga']++;
                        }
                        //$this->galvijai_model->galvijai['buliai_12']['pabaiga']++;
                        if($sk['amzius']>=12 AND $sk['amzius']<14) {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                            if (!empty($am)) {
                                if ($am[0]['amzius'] < 12) {
                                    if($banda == '3'){
                                        if($sk['veisle'] == "Limuzinai"){
                                            $this->galvijai_model->mesiniai['buliai_12']['j_i']++;
                                            $this->galvijai_model->mesiniai['verseliai']['j_is']++;
                                        }else{
                                            $this->galvijai_model->galvijai['buliai_12']['j_i']++;
                                            $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                        }
                                    }else{
                                        $this->galvijai_model->galvijai['buliai_12']['j_i']++;
                                        $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                    }
                                    //$this->galvijai_model->galvijai['buliai_12']['j_i']++;
                                    //$this->galvijai_model->galvijai['verseliai']['j_is']++;
                                }
                            }
                        }
                        //tikrinam ar nera nupirktas
                        $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                        $lka = explode(".", $sk['laikymo_pradzia']);
                        $info = explode(" ",$sk['informacija']);
                        if($lka[0] == $metai AND $lka[1] == $menesis AND $info[1] == 'Atvyko'){
                            if($banda == '3'){
                                if($sk['veisle'] == "Limuzinai"){
                                    $this->galvijai_model->mesiniai['buliai_12']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['buliai_12'][] = $da;
                                }else{
                                    $this->galvijai_model->galvijai['buliai_12']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['buliai_12'][] = $da;
                                }
                            }else{
                                $this->galvijai_model->galvijai['buliai_12']['pirkimai']++;
                                $this->galvijai_model->pirkimai['buliai_12'][] = $da;
                            }
                        }

                    }

                    //Buliukai virs 24
                    if ($sk['amzius'] >= 24) {
                        //$this->galvijai_model->galvijai['buliai_24']['pabaiga']++;
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['buliai_24']['pabaiga']++;}else{
                                $this->galvijai_model->galvijai['buliai_24']['pabaiga']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['buliai_24']['pabaiga']++;
                        }
                        $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                        $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                        if(!empty($am)){
                            if($am[0]['amzius'] < 24){
                                if($banda == '3'){
                                    if($sk['veisle'] == "Limuzinai"){
                                        $this->galvijai_model->mesiniai['buliai_24']['j_i']++;
                                        $this->galvijai_model->mesiniai['buliai_12']['j_is']++;
                                    }else{
                                        $this->galvijai_model->galvijai['buliai_24']['j_i']++;
                                        $this->galvijai_model->galvijai['buliai_12']['j_is']++;
                                    }
                                }else{
                                    $this->galvijai_model->galvijai['buliai_24']['j_i']++;
                                    $this->galvijai_model->galvijai['buliai_12']['j_is']++;
                                }
                                //$this->galvijai_model->galvijai['buliai_24']['j_i']++;
                                //$this->galvijai_model->galvijai['buliai_12']['j_is']++;
                            }
                        }
                        //tikrinam ar nera nupirktas
                        $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                        $lk = explode(".", $sk['laikymo_pradzia']);
                        $info = explode(" ",$sk['informacija']);
                        if($lk[0] == $metai AND $lk[1] == $menesis AND $info[1] == 'Atvyko'){
                            if($banda == '3'){
                                if($sk['veisle'] == "Limuzinai"){
                                    $this->galvijai_model->mesiniai['buliai_24']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['buliai_24'][] = $da;
                                }else{
                                    $this->galvijai_model->galvijai['buliai_24']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['buliai_24'][] = $da;
                                }
                            }else{
                                $this->galvijai_model->galvijai['buliai_24']['pirkimai']++;
                                $this->galvijai_model->pirkimai['buliai_24'][] = $da;
                            }
                        }
                    }

                    //Buliukai mezesni negu 12
                    if ($sk['amzius']<12 AND $sk['amzius'] != "") {
                        //$this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['verseliai']['pabaiga']++;}else{
                                $this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                        }

                        //tikrinti gimimus pagal laikymo pradzia, nes jei pagal gimimo data buna kad neatitinka data, buna gimsta sausi, laikymo pradzia vasari
                        //nevisada pagal gimimo data tinka gimimui indentifikuoti
                        $lp = explode(".", $sk['laikymo_pradzia']);
                        $info = explode(" ",$sk['informacija']);
                        if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs'){
                            //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                            if($banda == '3'){
                                if($sk['veisle'] == "Limuzinai"){
                                    $this->galvijai_model->mesiniai['verseliai']['gimimai']++;}else{
                                    $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                }
                            }else{
                                $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                            }
                        }
                        //reik del gimimu dar patikrinti ar nera atgaline tvarka irasytas
                        if($lp[0] == $metai AND $lp[1] == $menesis-1 AND $info[1] == 'Gimęs') {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                            if(empty($am)){
                                //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                if($banda == '3'){
                                    if($sk['veisle'] == "Limuzinai"){
                                        $this->galvijai_model->mesiniai['verseliai']['gimimai']++;}else{
                                        $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    }
                                }else{
                                    $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                }
                        }
                    }
                        $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                        if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Atvyko'){
                            if($banda == '3'){
                                if($sk['veisle'] == "Limuzinai"){
                                    $this->galvijai_model->mesiniai['verseliai']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['verseliai'][] = $da;
                                }else{
                                    $this->galvijai_model->galvijai['verseliai']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['verseliai'][] = $da;
                                }
                            }else{
                                $this->galvijai_model->galvijai['verseliai']['pirkimai']++;
                                $this->galvijai_model->pirkimai['verseliai'][] = $da;
                            }
                        }
                    }

                    //jei yra tuscias, reikia galvijai kazkur iskeliavo, reik issiaiskintu kur
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

                        $da = $this->galvijai_model->dateDifference($pr, $pb, '%y-%m-%d');
                        $dd = explode("-", $da);
                        $mo = $dd[0] * 12 + $dd[1];

                        //reik atsifiltruoti dingimo koduka, gali buti ne tik parduota bet ir kritimas arba suvartota sau
                       $pa = $this->galvijai_model->ivykio_kodas($sk['laikymo_pabaiga']);


                        if ($mo >= 12 AND $mo < 24) {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                            if($am[0]['amzius']<12){
                                if($banda == '3'){
                                    if($sk['veisle'] == "Limuzinai"){
                                        $this->galvijai_model->mesiniai['buliai_12']['j_i']++;
                                        $this->galvijai_model->mesiniai['verseliai']['j_is']++;
                                    }else{
                                        $this->galvijai_model->galvijai['buliai_12']['j_i']++;
                                        $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                    }
                                }else{
                                    $this->galvijai_model->galvijai['buliai_12']['j_i']++;
                                    $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                }
                                //$this->galvijai_model->galvijai['verseliai']['j_is']++;
                                //$this->galvijai_model->galvijai['buliai_12']['j_i']++;
                            }
                            $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                            $this->galvijai_model->ivykio_skaiciavimas($pa, $banda, "buliai_12", $dd);
                        }
                        if ($mo >= 24) {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                            if($am[0]['amzius']<24){
                                if($banda == '3'){
                                    if($sk['veisle'] == "Limuzinai"){
                                        $this->galvijai_model->mesiniai['buliai_24']['j_i']++;
                                        $this->galvijai_model->mesiniai['buliai_12']['j_is']++;
                                    }else{
                                        $this->galvijai_model->galvijai['buliai_24']['j_i']++;
                                        $this->galvijai_model->galvijai['buliai_12']['j_is']++;
                                    }
                                }else{
                                    $this->galvijai_model->galvijai['buliai_24']['j_i']++;
                                    $this->galvijai_model->galvijai['buliai_12']['j_is']++;
                                }
                                //$this->galvijai_model->galvijai['buliai_12']['j_is']++;
                                //$this->galvijai_model->galvijai['buliai_24']['j_i']++;
                            }
                            $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                            $this->galvijai_model->ivykio_skaiciavimas($pa, $banda, "buliai_24", $dd);
                        }
                        if ($mo < 12) {
                            $lp = explode(".", $sk['laikymo_pradzia']);
                            $info = explode(" ",$sk['informacija']);
                            if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs'){
                                //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                if($banda == '3'){
                                    if($sk['veisle'] == "Limuzinai"){
                                        $this->galvijai_model->mesiniai['verseliai']['gimimai']++;}else{
                                        $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    }
                                }else{
                                    $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                }
                            }
                            $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                            $this->galvijai_model->ivykio_skaiciavimas($pa, $banda, "verseliai", $dd);
                        }



                    }
                }

                if($one[0] == "Telyčaitė"){
                    //Telycaites nuo 12 iki 24
                    if($sk['amzius']>=12 AND $sk['amzius']<24){
                        //$this->galvijai_model->galvijai['telycios_12']['pabaiga']++;
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['telycios_12']['pabaiga']++;}else{
                                $this->galvijai_model->galvijai['telycios_12']['pabaiga']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['telycios_12']['pabaiga']++;
                        }

                        if($sk['amzius']>=12 AND $sk['amzius']<14) {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                            if(!empty($am) AND $am[0]['amzius']<12){
                                if($banda == '3'){
                                    if($sk['veisle'] == "Limuzinai"){
                                        $this->galvijai_model->mesiniai['telycios_12']['j_i']++;
                                        $this->galvijai_model->mesiniai['verseliai']['j_is']++;
                                    }else{
                                        $this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                        $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                    }
                                }else{
                                    $this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                    $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                }
                                //$this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                //$this->galvijai_model->galvijai['verseliai']['j_is']++;
                            }
                        }
                        //pirkimai
                        $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                        $lk = explode(".", $sk['laikymo_pradzia']);
                        $info = explode(" ",$sk['informacija']);
                        if($lk[0] == $metai AND $lk[1] == $menesis AND $info[1] == 'Atvyko'){
                            if($banda == '3'){
                                if($sk['veisle'] == "Limuzinai"){
                                    $this->galvijai_model->mesiniai['telycios_12']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['telycios_12'][] = $da;
                                }else{
                                    $this->galvijai_model->galvijai['telycios_12']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['telycios_12'][] = $da;
                                }
                            }else{
                                $this->galvijai_model->galvijai['telycios_12']['pirkimai']++;
                                $this->galvijai_model->pirkimai['telycios_12'][] = $da;
                            }
                        }

                    }

                    //Telycaites virs 24
                    if ($sk['amzius'] >= 24) {
                        //$this->galvijai_model->galvijai['telycios_24']['pabaiga']++;
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['telycios_24']['pabaiga']++;}else{
                                $this->galvijai_model->galvijai['telycios_24']['pabaiga']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['telycios_24']['pabaiga']++;
                        }

                        $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                        $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                        if(!empty($am)){
                            if($am[0]['amzius']<24){
                                if($banda == '3'){
                                    if($sk['veisle'] == "Limuzinai"){
                                        $this->galvijai_model->mesiniai['telycios_24']['j_i']++;
                                        $this->galvijai_model->mesiniai['telycios_12']['j_is']++;
                                    }else{
                                        $this->galvijai_model->galvijai['telycios_24']['j_i']++;
                                        $this->galvijai_model->galvijai['telycios_12']['j_is']++;
                                    }
                                }else{
                                    $this->galvijai_model->galvijai['telycios_24']['j_i']++;
                                    $this->galvijai_model->galvijai['telycios_12']['j_is']++;
                                }
                            //$this->galvijai_model->galvijai['telycios_24']['j_i']++;
                            //$this->galvijai_model->galvijai['telycios_12']['j_is']++;
                            }
                        }
                        //pirkimai
                        $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                        $lk = explode(".", $sk['laikymo_pradzia']);
                        $info = explode(" ",$sk['informacija']);
                        if($lk[0] == $metai AND $lk[1] == $menesis AND $info[1] == 'Atvyko'){
                            if($banda == '3'){
                                if($sk['veisle'] == "Limuzinai"){
                                    $this->galvijai_model->mesiniai['telycios_24']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['telycios_24'][] = $da;
                                }else{
                                    $this->galvijai_model->galvijai['telycios_24']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['telycios_24'][] = $da;
                                }
                            }else{
                                $this->galvijai_model->galvijai['telycios_24']['pirkimai']++;
                                $this->galvijai_model->pirkimai['telycios_24'][] = $da;
                            }
                        }
                    }

                    //Telycaites mazesnios negu 12
                    if ($sk['amzius']<12 AND $sk['amzius'] != "") {
                        //$this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                        if($banda == '3'){
                            if($sk['veisle'] == "Limuzinai"){
                                $this->galvijai_model->mesiniai['verseliai']['pabaiga']++;}else{
                                $this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                            }
                        }else{
                            $this->galvijai_model->galvijai['verseliai']['pabaiga']++;
                        }

                        $lp = explode(".", $sk['laikymo_pradzia']);
                        $info = explode(" ",$sk['informacija']);
                        if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs'){
                            //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                            if($banda == '3'){
                                if($sk['veisle'] == "Limuzinai"){
                                    $this->galvijai_model->mesiniai['verseliai']['gimimai']++;}else{
                                    $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                }
                            }else{
                                $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                            }
                        }
                        //reik del gimimu dar patikrinti ar nera atgaline tvarka irasytas
                        if($lp[0] == $metai AND $lp[1] == $menesis-1 AND $info[1] == 'Gimęs') {
                            $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                            $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                            if(empty($am)){
                                //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                if($banda == '3'){
                                    if($sk['veisle'] == "Limuzinai"){
                                        $this->galvijai_model->mesiniai['verseliai']['gimimai']++;}else{
                                        $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    }
                                }else{
                                    $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                }
                            }
                        }

                        $da = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);

                        if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Atvyko'){
                            //$this->galvijai_model->galvijai['verseliai']['pirkimai']++;
                            if($banda == '3'){
                                if($sk['veisle'] == "Limuzinai"){
                                    $this->galvijai_model->mesiniai['verseliai']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['verseliai'][] = $da;
                                }else{
                                    $this->galvijai_model->galvijai['verseliai']['pirkimai']++;
                                    $this->galvijai_model->pirkimai['verseliai'][] = $da;
                                }
                            }else{
                                $this->galvijai_model->galvijai['verseliai']['pirkimai']++;
                                $this->galvijai_model->pirkimai['verseliai'][] = $da;
                            }
                        }
                    }

                    //jei yra tuscias, reikia galvijai kazkur iskeliavo, reik issiaiskintu kur
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

                        $da = $this->galvijai_model->dateDifference($pr, $pb, '%y-%m-%d');
                        $dd = explode("-", $da);
                        $mo = $dd[0] * 12 + $dd[1];
                        //reik atsifiltruoti dingimo koduka, gali buti ne tik parduota bet ir kritimas arba suvartota sau
                        $pa= $this->galvijai_model->ivykio_kodas($sk['laikymo_pabaiga']);

                        //tikrinama kas atsitiko gyvuliams, kur dingo?
                            if ($mo >= 12 AND $mo < 24) {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                                if($am[0]['amzius']<12){
                                    if($banda == '3'){
                                        if($sk['veisle'] == "Limuzinai"){
                                            $this->galvijai_model->mesiniai['telycios_12']['j_i']++;
                                            $this->galvijai_model->mesiniai['verseliai']['j_is']++;
                                        }else{
                                            $this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                            $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                        }
                                    }else{
                                        $this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                        $this->galvijai_model->galvijai['verseliai']['j_is']++;
                                    }
                                    //$this->galvijai_model->galvijai['verseliai']['j_is']++;
                                    //$this->galvijai_model->galvijai['telycios_12']['j_i']++;
                                }
                                $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                                $this->galvijai_model->ivykio_skaiciavimas($pa, $banda, "telycios_12", $dd);
                            }
                            if ($mo >= 24) {
                                $dat = array('ukininkas' => $ukininkas, 'metai' => $met, 'menesis' => $men, 'numeris' => $sk['numeris']);
                                $am = $this->galvijai_model->nuskaityti_gyvulius($dat);
                                if($am[0]['amzius']<24){
                                    if($banda == '3'){
                                        if($sk['veisle'] == "Limuzinai"){
                                            $this->galvijai_model->mesiniai['telycios_24']['j_i']++;
                                            $this->galvijai_model->mesiniai['telycios_12']['j_is']++;
                                        }else{
                                            $this->galvijai_model->galvijai['telycios_24']['j_i']++;
                                            $this->galvijai_model->galvijai['telycios_12']['j_is']++;
                                        }
                                    }else{
                                        $this->galvijai_model->galvijai['telycios_24']['j_i']++;
                                        $this->galvijai_model->galvijai['telycios_12']['j_is']++;
                                    }
                                    //$this->galvijai_model->galvijai['telycios_12']['j_is']++;
                                    //$this->galvijai_model->galvijai['telycios_24']['j_i']++;
                                }
                                $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                                $this->galvijai_model->ivykio_skaiciavimas($pa, $banda, "telycios_24", $dd);
                            }
                            if ($mo < 12) {
                                $lp = explode(".", $sk['laikymo_pradzia']);
                                $info = explode(" ",$sk['informacija']);
                                if($lp[0] == $metai AND $lp[1] == $menesis AND $info[1] == 'Gimęs'){
                                    //$this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    if($banda == '3'){
                                        if($sk['veisle'] == "Limuzinai"){
                                            $this->galvijai_model->mesiniai['verseliai']['gimimai']++;}else{
                                            $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                        }
                                    }else{
                                        $this->galvijai_model->galvijai['verseliai']['gimimai']++;
                                    }
                                }
                                $dd = array('numeris' => $sk['numeris'], 'kam' => $sk['informacija']);
                                $this->galvijai_model->ivykio_skaiciavimas($pa, $banda,  "verseliai", $dd);
                            }
                    }
                }
            }
            //suskaiciuoti lenteleje, viso kiekius GYVULIAI
            $keys = array_keys($this->galvijai_model->galvijai['karves']);
            foreach($keys as $ro){
                $sumDetail = $ro;
                $this->galvijai_model->galvijai['viso'][$ro] = array_reduce($this->galvijai_model->galvijai,
                    function($runningTotal, $record) use($sumDetail) {
                        $runningTotal += $record[$sumDetail];
                        return $runningTotal;}, 0 );
            }

            //suskaiciuoti lenteleje, viso kiekius MESINIAI
            if($banda == '3') {
                $keys = array_keys($this->galvijai_model->mesiniai['karves']);
                foreach ($keys as $ro) {
                    $sumDetail = $ro;
                    $this->galvijai_model->mesiniai['viso'][$ro] = array_reduce($this->galvijai_model->mesiniai,
                        function ($runningTotal, $record) use ($sumDetail) {
                            $runningTotal += $record[$sumDetail];
                            return $runningTotal;
                        }, 0);
                }
            }

            $this->main_model->info['error']['action'] = true;
        }

        //sukeliam info, informaciniam meniu
        $this->main_model->info['txt']['meniu'] = "Galvijai";
        $this->main_model->info['txt']['info'] = "Galvijų skaičiavimas";

        $user = $this->ion_auth->user()->row();
        //Nuskaitom ukininku sarasa, kad butu visada po ranka
        $this->main_model->info['ukininkai'] = $this->ukininkai_model->ukininku_sarasas( $user->id, TRUE);
        $this->load->view("main_view");

    }

}
?>
