<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Atsiskaitymas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    private function sum_index($arr, $col_name){
        $sum = 0;
        foreach ($arr as $item) {
            $sum += $item[$col_name];
        }
        return $sum;
    }

    public function banko_israsas_sarasas($metai, $men){
        $this->db->from('banko_israsai');
        $this->db->where('YEAR(mokejimo_data)', $metai);
        $this->db->where('MONTH(mokejimo_data)', $men);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function ukis_sumokejo($u_id, $metai, $men){
        $this->db->select('operacijos_suma');
        $this->db->from('banko_israsai');
        $this->db->where("u_id", $u_id);
        $this->db->where('YEAR(mokejimo_data)', $metai);
        $this->db->where('MONTH(mokejimo_data)', $men);
        $result = $this->db->get();
        return $this->sum_index($result->result_array(), "operacijos_suma");
    }

    //suskaiciuoti atitinkamos klases suma
    public function klases_suma($klase, $deb_kre){
        $this->db->select('kodas');
        $this->db->from('saskaitu_planas');
        $this->db->where(array("klase" => $klase));
        $result = $this->db->get();
        return $result->result_array();
    }

    //sakaitu palnas istraukiam sarasa
    public function sakiatu_planas($data){
        $this->db->from('saskaitu_planas');
        $this->db->where($data);
        $this->db->order_by("id", "asc");
        $result = $this->db->get();
        return $result->result_array();
    }

    //reik paimti duomenis is banko israsu DB pagal tam tikra kredita ir debeta
    public function gauti_debeta($kodas){
        $this->db->select('operacijos_suma');
        $this->db->from('banko_israsai');
        $this->db->where(array("debetas" => $kodas));
        $result = $this->db->get();
        return $this->sum_index($result->result_array(), "operacijos_suma");
    }
    public function gauti_kredita($kodas){
        $this->db->select('operacijos_suma');
        $this->db->from('banko_israsai');
        $this->db->where(array("kreditas" => $kodas));
        $result = $this->db->get();
        return $this->sum_index($result->result_array(), "operacijos_suma");
    }

    //irasom naujus duomenis i Duomenu baze is banko israso
    public function banko_israsas($data){
        return $this->db->insert('banko_israsai', $data);
    }

    //surandam ukininka pagal varda ir pavarde, ir priskiriam jo ID
    public function randam_ukininka($data){
        $this->db->from('ukininkai');
        $this->db->where($data);
        $result = $this->db->get();
        return $result->result_array();
    }

    //suzinom ar jau toks banko irasas itrauktas i duomenu baze ar ne
    public function ar_egzistuoja_irasas($data){
        $this->db->select('id');
        $this->db->from('banko_israsai');
        $this->db->where($data);
        $result = $this->db->count_all_results();
        return $result;
    }



}
?>