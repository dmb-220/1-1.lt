<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function count_group_users($id){
        $this->db->select('*');
        $this->db->from('users_groups');
        $data = array('group_id' => $id);
        $this->db->where($data);
        return $this->db->count_all_results();
    }


}