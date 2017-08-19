<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pasarai_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
    }


    public function nuskaityti_pasarus($id){
        $dat = array('gid' => $id);
        $this->db->where($dat);
        $query = $this->db->get("pasarai");
        $data = $query->result_array();
        return $data;
    }

    public function nuskaityti_viska(){
        $query = $this->db->get("pasarai");
        $data = $query->result_array();
        return $data;
    }

}
?>
