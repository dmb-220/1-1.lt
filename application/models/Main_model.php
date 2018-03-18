<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public $menesiai = array(
        "Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis",
        "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis","Lapkritis", "Gruodis"
    );


    //Kintamasis / masyvas i kuria sukrausiu informacija siunciama i VIEW faila
    public $info = array();

    public function gimtadieniai($user_id){
        $this->db->select('asmens_kodas');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get("ukininkai");
        $data = $query->result_array();
        return $data;
    }

   }
