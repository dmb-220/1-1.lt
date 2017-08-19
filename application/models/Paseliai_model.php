<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paseliai_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function paseliai_count() {
        return $this->db->count_all("paseliai");
    }

    public function paseliai_limit($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("paseliai");

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function irasyti_paseli($data){
            $this->db->insert('paseliai', $data);
        return TRUE;
    }

    public function atnaujinti_paselius($data, $kam){
            $dat = array('sutrumpinimas' => $kam);
            $this->db->where($dat);
            $this->db->update('paseliai', $data);
        return true;
    }

    public function tikrinti_koda($kodas) {
        $this->db->select('id');
        $this->db->from('paseliai');
        $this->db->where(array('sutrumpinimas' => $kodas));
        $result = $this->db->count_all_results();
        return $result;
    }

    public function nuskaityti_pavadinima($sutrumpinimas){
        $this->db->where(array('sutrumpinimas' => $sutrumpinimas));
        $query = $this->db->get("paseliai");
        $data = $query->result_array();
        return $data;
    }

    public function nuskaityti_deklaracija($dat){
        $this->db->where($dat);
        $query = $this->db->get("deklaracija");
        $data = $query->result_array();
        return $data;
    }

    public function nuskaityti_paselius($dat){
        $this->db->where($dat);
        $query = $this->db->get("paseliai");
        $data = $query->result_array();
        return $data;
    }

    public function ar_deklaracija_ikelta($metai, $valdos_nr) {
        $this->db->select('id');
        $this->db->from('deklaracija');
        $array = array('ukininkas' => $valdos_nr, 'metai' => $metai);
        $this->db->where($array);
        $result = $this->db->count_all_results();
        return $result;
    }

    public function irasyti_deklaracija($data, $ukininkas, $metai){
        for($i = 2; $i<count($data)-1; $i++){
            $sql = array(
                'metai' => $metai,
                'ukininkas' => $ukininkas,
                'kodas' => $data[$i][3] ,
                'pavadinimas' => $data[$i][4],
                'plotas' => $data[$i][5] ,
            );
            $this->db->insert('deklaracija', $sql);
        }
        return TRUE;
    }

    public function deklaracija($url){
        $dom = new DOMDocument();
        $html = $dom->loadHTMLFile($url);
        $dom->preserveWhiteSpace = false;
        //the table by its tag name
        $tables = $dom->getElementsByTagName('table');
        //get all rows from the table
        $rows = $tables->item(0)->getElementsByTagName('tr');
        // get each column by tag name
        $cols = $rows->item(0)->getElementsByTagName('th');
        $row_headers = NULL;
        foreach ($cols as $node) {
            $row_headers[] = $node->nodeValue;
        }

        $table = array();
        //get all rows from the table
        $rows = $tables->item(6)->getElementsByTagName('tr');
        foreach ($rows as $row) {
            // get each column by tag name
            $cols = $row->getElementsByTagName('td');
            $row = array();
            $i=0;
            foreach ($cols as $node) {
                if($row_headers==NULL)
                    $row[] = $node->nodeValue;
                else
                    $row[$row_headers[$i]] = $node->nodeValue;
                $i++;
            }
            $table[] = $row;
        }
        return $table;
    }
}
?>
