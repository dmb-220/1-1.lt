<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ukininkai_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }


    public function irasyti_ukininka($vardas, $pavarde, $valdos_nr, $v_vardas, $slaptazodis){
        $sql = array(
            'vardas' => $vardas ,
            'pavarde' => $pavarde ,
            'valdos_nr' => $valdos_nr,
            'VIC_vartotojo_vardas' => $v_vardas,
            'VIC_slaptazodis' => $slaptazodis,
        );
        $this->db->insert('ukininkai', $sql);
}

    public function tikinti_ukininka($valdos_nr) {
        $this->db->select('id');
        $this->db->from('ukininkai');
        $this->db->where('valdos_nr', $valdos_nr);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            return $row->id;
        } else {
            return 0;
        }
    }

    public function ukininku_sarasas(){
        $query = $this->db->get("ukininkai");
        $data = $query->result_array();
        return $data;
    }

    public function ukininkas($nr){
        //$this->db->select('vardas, pavarde, ');
        $this->db->from('ukininkai');
        $this->db->where('valdos_nr', $nr);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }
}

?>
