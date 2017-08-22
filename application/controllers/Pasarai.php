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
class Pasarai extends CI_Controller{
    public function __construct(){
        parent::__construct();
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $this->load->library('Ion_auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('main/auth_error');
        }
    }

    public function meslas(){
        $data = array();
        $error = array();

        $dt = $this->session->userdata();

        $this->load->library('form_validation');
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

        if ($this->form_validation->run()) {
            $metai = $this->input->post('sezonas');
            $laikotarpis = $this->input->post('laikotarpis');

            $inf['metai'] = $metai;
            $inf['laikotarpis'] = $laikotarpis;

            $error['action'] = TRUE;
        }

        //sukeliam info, informaciniam meniu
        $inf['meniu'] = "Pašarai";
        $inf['active'] = "Pašarų normos";

        $this->load->view("main_view", array('data'=> $data, 'error' => $error, 'inf' => $inf));
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

            $this->load->model('gyvuliai_model');
            if($menesis AND !$laikotarpis) {
                //skaiciuojam nurodyto menesio pasaru kieki galvijams
                //nuskaitom visus gyvulius, pasirinkto menesio
                $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis);
                $rezultatai = $this->gyvuliai_model->nuskaityti_gyvulius($dat);

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
                        $rezultatai = $this->gyvuliai_model->nuskaityti_gyvulius($dat);

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
