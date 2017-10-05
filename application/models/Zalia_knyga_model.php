<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Zalia_knyga_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    ///////////////////////////////////// PVM ////////////////////////////////////
    //patikrinam ar toks pvm tarifas nera jau ikeltas, kad nesidubliutu
    public function tikrinti_pvm($pvm, $pavadinimas) {
        $this->db->select('id');
        $this->db->from('pvm');
        $this->db->where(array("kodas" => $pvm, "pavadinimas" => $pavadinimas));
        $result = $this->db->count_all_results();
        return $result;
    }
    //naujas irasas pwm tarifas
    public function naujas_irasas($pavadinimas, $kodas, $tarifas){
        return $this->db->insert('pvm', array("pavadinimas" => $pavadinimas, "kodas" => $kodas, "tarifas" => $tarifas));
    }
    //nuskaito pvm irasus
    public function nuskaityti_pvm(){
        $query = $this->db->get("pvm");
        $data = $query->result_array();
        return $data;
    }
    ///////////////////////////////////// KNYGA ///////////////////////////////////
    //patikrinam ar toks pvm tarifas nera jau ikeltas, kad nesidubliutu
    public function tikrinti_irasa($data) {
        $this->db->select('id');
        $this->db->from('zalia_knyga');
        $this->db->where($data);
        $result = $this->db->count_all_results();
        return $result;
    }
    //naujas irasas
    public function naujas_irasas_knyga($data){
        return $this->db->insert('zalia_knyga', $data);
    }
    //nuskaito knygos irasus
    public function nuskaityti_knyga($dat){
        $this->db->where($dat);
        $this->db->join('pvm', 'pvm.id = zalia_knyga.pvm_id', 'left');
        $query = $this->db->get("zalia_knyga");
        $data = $query->result_array();
        return $data;
    }
    //kiti metodai, model

    public function nuskaityti_saskaitas(){
            $this->db->select ( '*' );
            $this->db->from ( 'saskaitu_grupe' );
            $this->db->join ( 'saskaitu_grupe_pogrupis', 'saskaitu_grupe_pogrupis.po_id = saskaitu_grupe.id' , 'left' );
            //$this->db->join ( 'saskaitu_grupe', 'saskaitu_grupe.id = saskaitu_pogrupis.id' , 'left' );
            $query = $this->db->get ();
            return $query->result_array();
        }
}