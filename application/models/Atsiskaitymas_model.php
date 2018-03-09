<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Atsiskaitymas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //irasom naujus duomenis i Duomenu baze is banko israso
    public function banko_israsas($data){
        return $this->db->insert('banko_israsai', $data);
    }

    //surandam ukininka pagal varda ir pavarde, ir priskiriam jo ID
    public function randam_ukininka($data){
        //$this->db->from('ukininkai');
        //$this->db->where($data);
        //$result = $this->db->get();
        //return $result->result_array();
        return $data;
    }

}
?>