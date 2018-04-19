<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property Sutartys_model     $sutartys_model     Sutartys models
 * @property Paseliai_model     $paseliai_model     Paseliai models
 */

class Sutartys_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public $galviju = array(
        array("kodas" => "U0", "kiekis" => 10),
        array("kodas" => "U1", "kiekis" => 30),
        array("kodas" => "U2", "kiekis" => 60),
        array("kodas" => "U3", "kiekis" => 90),
        array("kodas" => "U4", "kiekis" => 120),
        array("kodas" => "U5", "kiekis" => 150),
        array("kodas" => "U6", "kiekis" => 180),
        array("kodas" => "U7", "kiekis" => 210),
        array("kodas" => "U8", "kiekis" => 240),
        array("kodas" => "U9", "kiekis" => 270),
        array("kodas" => "U10", "kiekis" => 300),
        array("kodas" => "U11", "kiekis" => 350),
        array("kodas" => "U12", "kiekis" => 400),
        array("kodas" => "U13", "kiekis" => 450),
        array("kodas" => "U14", "kiekis" => 500),
        array("kodas" => "U15", "kiekis" => 750),
    );

    public $ploto = array(
        array("kodas" => "A0", "kiekis" => 5),
        array("kodas" => "A1", "kiekis" => 10),
        array("kodas" => "A2", "kiekis" => 15),
        array("kodas" => "A3", "kiekis" => 20),
        array("kodas" => "A4", "kiekis" => 25),
        array("kodas" => "A5", "kiekis" => 30),
        array("kodas" => "A6", "kiekis" => 35),
        array("kodas" => "A7", "kiekis" => 40),
        array("kodas" => "A8", "kiekis" => 50),
        array("kodas" => "A9", "kiekis" => 75),
        array("kodas" => "A10", "kiekis" => 100),
        array("kodas" => "A11", "kiekis" => 150),
        array("kodas" => "A12", "kiekis" => 200),
        array("kodas" => "A13", "kiekis" => 250),
        array("kodas" => "A14", "kiekis" => 300),
        array("kodas" => "A15", "kiekis" => 500),
    );

    public $EVRK = array(
        "A" => array("01", "02", "03"),
        "B" => array("04", "05", "06", "07", "08", "09"),
        "C" => array("10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33"),
        "D" => array("35"),
        "E" => array("36", "37", "38", "39"),
        "F" => array("41", "42", "43"),
        "G" => array("45", "46", "47"),
        "H" => array("49", "50", "51", "52", "53", "54", "55", "56", "57", "58", "59", "60", "61", "62", "63"),
        "K" => array("64", "65", "66"),
        "L" => array("68"),
        "M" => array("69", "70", "71", "72", "73", "74", "75"),
        "N" => array("77", "78", "79", "80", "81", "82"),
        "O" => array("84"),
        "P" => array("85"),
        "Q" => array("86", "87", "88"),
        "R" => array("90", "91", "92", "93"),
        "S" => array("94", "95", "96"),
        "T" => array("97", 98),
        "U" => array("99")
     );

    /////////////////////////////////////////////// JA /////////////////////////////////
    public function EVRK_sekcija(){
        $this->db->where(array("sekcija !=" => ""));
        $query = $this->db->get("EVRK_2");
        $data = $query->result_array();
        return $data;
    }

    public function EVRK_skyrius($sekcija){
        $this->db->where(array('skyrius !=' => ""));
        $this->db->where_in('skyrius', $this->EVRK[$sekcija]);
        $query = $this->db->get("EVRK_2");
        $data = $query->result_array();
        return $data;
    }

    public function EVRK_grupe($skyrius){
        $this->db->where(array('grupe !=' => ""));
        $this->db->like('grupe', $skyrius, 'after');
        $query = $this->db->get("EVRK_2");
        $data = $query->result_array();
        return $data;
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
