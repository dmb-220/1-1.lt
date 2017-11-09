<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property Sutartys_model     $sutartys_model     Sutartys models
 */

class Sutartys_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    //

    public function galvijai_vidurkis(){
        $sk = 0;
        $dt = $this->session->userdata();
        $metai = date('Y');
        $menesis = date('m') -1;
        //$m = $menesis;
        //$nuskaityti gyvulius
        for($i=0; $i<9; $i++) {
            if($menesis <= 1){$menesis = 12; $metai = $metai - 1;}else{$menesis = $menesis - 1;}
            $array = array('ukininkas' => $dt['nr'], 'metai' => $metai, 'menesis' => $menesis, 'amzius !=' => "");
            $s = $this->sutartys_model->skaitciuoti_galvijus($array);
            $sk = $sk + $s;
        }
        return round($sk/9, 0);
    }

    //suskaiciuoti gyvulius
    public function skaitciuoti_galvijus($data) {
        $this->db->from('galvijai');
        $this->db->where($data);
        $result = $this->db->count_all_results();
        return $result;
    }

    public function skaiciuoti_deklaruota_plota($dat){
        $plotas = 0;
        $dek = $this->paseliai_model->nuskaityti_deklaracija($dat);
        //sukuriamas masyvas, jis bus sukuriamas pagal deklaracijos duomenis
        $da = array();
        foreach($dek as $row){
            $dat = array('sutrumpinimas' =>  $row['kodas']);
            $de = $this->paseliai_model->nuskaityti_paselius($dat);
            if(!empty($de[0]['sekla'])){
                $plotas += $row['plotas'];
            }
        }
        return round($plotas, 0);
    }


}
