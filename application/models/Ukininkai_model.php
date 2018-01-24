<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ukininkai_model extends CI_Model{
    public $ukininkas;

    public function __construct(){
        parent::__construct();
    }

    //priskiriamas ukininkas
    public function priskirti($nr){
        $this->ukininkas = $nr;
    }

    //atnaujinam ukikinku duomenis
    public function atnaujinti_ukininka($nr, $data){
        $where = array('valdos_nr' => $nr);
        $this->db->where($where);
        $this->db->update('ukininkai', $data);
    }

    //irasom nauja ukininka i duomenu baze
    public function irasyti_ukininka($sql){
        $this->db->insert('ukininkai', $sql);
    }

    //patikrinam ar toks ukininkas nera itrauktas i DB
    public function tikinti_ukininka($vardas, $pavarde) {
        $this->db->select('id');
        $this->db->from('ukininkai');
        $this->db->where(array('vardas' => $vardas, 'pavarde' => $pavarde));
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            return $row->id;
        } else {
            return 0;
        }
    }

    public function read_iban($nr){
        $this->db->from('iban');
        $this->db->where('kodas', $nr);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    //nuskaitom visus ukininkus, jei reiksme TRUE, paimam tik pagrindinius duomenis
    public function ukininku_sarasas($id = "", $ar = ""){
        if($ar){
            $this->db->select('vardas, pavarde, valdos_nr');}
        if($id){
            $this->db->where('user_id', $id);}
        $query = $this->db->get("ukininkai");
        $data = $query->result_array();
        return $data;
    }

    //gaunam informacija apie konkretu ukininka
    public function ukininkas($nr){
        $this->db->from('ukininkai');
        $this->db->where('valdos_nr', $nr);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }
}

?>
