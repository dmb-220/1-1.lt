<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property Sutartys_model     $sutartys_model     Sutartys models
 */

class Sutartys_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function galvijai_vidurkis(){
        $sk = 0;
        $dt = $this->session->userdata();
        $metai = date('Y');
        $menesis = date('m') - 2;
        $m = $menesis;
        //$nuskaityti gyvulius
        for($i=0; $i<9; $i++) {
            if(($m - $i) <= 1){$menesis = 12; $metai = $metai - 1;}else{$menesis = $menesis -1;}
            $array = array('ukininkas' => $dt['nr'], 'metai' => $metai, 'menesis' => $menesis, 'amzius !=' => "");
            $s = $this->galvijai_model->skaitciuoti_galvijus($array);
            $sk = $sk + $s;
        }
        return round($sk/9, 0);
    }

    public function skaiciuoti_deklaruota_plota($dat){
        $this->db->select_sum('plotas');
        $this->db->where($dat);
        $query = $this->db->get("deklaracija");
        $data = $query->result_array();
        return round($data[0]['plotas'], 0);
    }


}
