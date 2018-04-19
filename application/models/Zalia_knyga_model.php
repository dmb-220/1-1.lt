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
    public function naujas_pvm($pavadinimas, $kodas, $tarifas, $pvz){
        return $this->db->insert('pvm', array("pavadinimas" => $pavadinimas, "kodas" => $kodas, "tarifas" => $tarifas, "pvz" => $pvz));
    }
    //nuskaito pvm irasus
    public function nuskaityti_pvm($id = ""){
        $query = $this->db->get("pvm");
        if($id){
            $this->db->where(array("id" => $id));
        }
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
        $this->db->select("zalia_knyga.*, zalia_knyga.id AS za_id, pvm.*, organizaciju_sarasas.*");
        $this->db->where($dat);
        $this->db->from("zalia_knyga");
        $this->db->join('pvm', 'pvm.id = zalia_knyga.pvm_id', 'left');
        $this->db->join('organizaciju_sarasas', 'organizaciju_sarasas.id = zalia_knyga.organizacija', 'left');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    /////////////////////////////////////////////////////////// ORGANIZACIJOS //////////////////////////////////////////
    //
    public function tikrinti_organizacija($kodas, $pavadinimas){
        $this->db->select('id');
        $this->db->from('organizaciju_sarasas');
        $this->db->where(array("imones_kodas" => $kodas, "pavadinimas" => $pavadinimas));
        $result = $this->db->count_all_results();
        return $result;
    }
    //
    public function nauja_organizacija($pavadinimas, $kodas, $pvm){
        return $this->db->insert('organizaciju_sarasas', array("pavadinimas" => $pavadinimas, "imones_kodas" => $kodas, "pvm_kodas" => $pvm));
    }
    //nuskaito pvm irasus
    public function nuskaityti_organizacijas($id = ""){
        $query = $this->db->get("organizaciju_sarasas");
        if ($id) {
            $this->db->where(array("id" => $id));
        }
        $data = $query->result_array();
        return $data;
    }
}