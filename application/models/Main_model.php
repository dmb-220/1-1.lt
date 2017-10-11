<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model{
    //Kintamasis / masyvas i kuria sukrausiu informacija siunciama i VIEW faila
    public $info = array();

    public function __construct(){
        parent::__construct();
    }

   }
