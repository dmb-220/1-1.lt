<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property Sutartys_model     $sutartys_model     Sutartys models
 * @property Paseliai_model     $paseliai_model     Paseliai models
 */

class Sutartys_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function atnaujinti_ukio_dydi($nr, $data){
        $where = array('valdos_nr' => $nr);
        $this->db->where($where);
        return $this->db->update('ukininkai', $data);
    }

    public function tikrinti_sutarti($id, $kokia) {
        $this->db->from('sutartys');
        $this->db->where(array("sutarties_id" => $kokia, "u_id" => $id));
        return $this->db->count_all_results();

    }

    //istrinama ukininko sutartis
    public function istrinti_sutarti($kokia = 1, $id){
        $this->db->where(array("sutarties_id" => $kokia, "u_id" => $id));
        return $this->db->delete("sutartys");

    }

    //Gaunamas ukininko sutartis
    public function ukininko_sutartis($kokia = 1, $id){
        $this->db->where(array("sutarties_id" => $kokia, "u_id" => $id));
        //$this->db->join('ukininkai', 'ukininkai.valdos_nr = sutartys.u_id', 'left');
        $query = $this->db->get("sutartys");
        $data = $query->result_array();
        return $data;
    }

    //Gaunamas Sutarciu sarasas
    public function sutarciu_sarasas(){
        $this->db->join('ukininkai', 'ukininkai.valdos_nr = sutartys.u_id', 'left');
        $query = $this->db->get("sutartys");
        $data = $query->result_array();
        return $data;
    }

    //
    public function rasti_skaiciu($masyvas, $skaicius){
        foreach ($masyvas as $row){
            if($row['kiekis'] >= $skaicius){
                $array[] = $row['kodas'];
            }
        }
        //var_dump($array); die;
       return $array[0];
    }

    public function sutarties_suma($id, $metai){
        $this->db->from('ikainiai');
        $this->db->where(array("u_id" => $id, "metai" => $metai));
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    public function  sutarties_nr(){
        $num = 0;
        //gaunam didziasia sutartnies numeri
        $query = $this->db->get("sutartys");
        $this->db->where(array("sutarties_id" => 1));
        $data = $query->result_array();
        $nr = 0;
        foreach ($data as $row) {
            $no = explode("-", $row['numeris']);
            if((int)$no[1] > $nr){$nr = (int)$no[1];}
        }

        //suskaiciuojam kiek yra sutarciu irasytu
        //jei neatitinka, reiksmia yra skyliu. reik uzlopyti
        $this->db->from('sutartys');
        $this->db->where(array("sutarties_id" => 1));
        $result = $this->db->count_all_results();

        if($result != $nr){
            //surasti skyle ir uzpildyti
            $arr = array();
            for($i = 1; $i <= $nr; $i++){
                foreach ($data as $row){
                    $no = explode("-", $row['numeris']);
                    if($no[1] == $i){
                        $arr[$i] = $i;
                    }
                }
                if(!key_exists($i, $arr)){
                    $num = $i;
                    //break;
                }
            }
        }else{
            $num = $nr+1;
        }
        return $num;
    }

    public function sutartis_irasyti($data){
        $this->db->insert('sutartys', $data);
    }

    public function galvijai_vidurkis($ukininkas){
        $sk = 0;
        //$dt = $this->session->userdata();
        $metai = date('Y');
        $menesis = date('m') -1;
        //$m = $menesis;
        //$nuskaityti gyvulius
        for($i=0; $i<9; $i++) {
            if($menesis <= 1){$menesis = 12; $metai = $metai - 1;}else{$menesis = $menesis - 1;}
            $array = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menesis, 'amzius !=' => "");
            $s = $this->sutartys_model->skaitciuoti_galvijus($array);
            $sk = $sk + $s;
        }
        return round($sk/9, 0);
    }

    //suskaiciuoti gyvulius
    public function skaitciuoti_galvijus($data) {
        $this->db->from('galvijai');
        $this->db->where($data);
        $result = $this->db->count_all_results();
        return $result;
    }

    public function deklaruotas_plotas($dat){
        $plotas = 0;
        $dek = $this->paseliai_model->nuskaityti_deklaracija($dat);
        //sukuriamas masyvas, jis bus sukuriamas pagal deklaracijos duomenis
        foreach($dek as $row){
            $plotas = $plotas + $row['plotas'];
        }
        return round($plotas, 0);
    }

    public function skaiciuoti_deklaruota_plota($dat){
        $plotas = 0;
        $dek = $this->paseliai_model->nuskaityti_deklaracija($dat);
        //sukuriamas masyvas, jis bus sukuriamas pagal deklaracijos duomenis
        $da = array();
        foreach($dek as $row){
            $dat = array('sutrumpinimas' =>  $row['kodas']);
            $de = $this->paseliai_model->nuskaityti_paselius($dat);
            if(!empty($de[0]['sekla'])){
                $plotas += $row['plotas'];
            }
        }
        return round($plotas, 0);
    }


}
