<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property Galvijai_model     $galvijai_model     Galvijai models
 */
class Galvijai_model extends CI_Model{
    public $galvijai = array(
        'karves' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'verseliai' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'telycios_12' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'buliai_12' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'telycios_24' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'buliai_24' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'viso' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0)
    );

    public $mesiniai = array(
        'karves' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'verseliai' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'telycios_12' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'buliai_12' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'telycios_24' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'buliai_24' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0),
        'viso' => array('pradzia' => 0, 'gimimai' => 0, 'pirkimai' => 0, 'j_is' => 0, 'j_i' => 0, 'kritimai' => 0, 'suvartota' => 0, 'parduota' => 0, 'pabaiga' => 0)
    );

    public $pardavimai = array(
    'karves' => array(),
    'verseliai' => array(),
    'telycios_12' => array(),
    'buliai_12' => array(),
    'telycios_24' => array(),
    'buliai_24' => array(),
);
    public $pirkimai = array(
        'karves' => array(),
        'verseliai' => array(),
        'telycios_12' => array(),
        'buliai_12' => array(),
        'telycios_24' => array(),
        'buliai_24' => array(),
    );

    public function __construct(){
        parent::__construct();

    }

    //is filtruojamas kodas pagal kuri nustatom kur dingo gyvuliukas
    public function ivykio_kodas($data){
        if(strstr($data, '*')){
            $pa = explode("*", $data);
            $pa = explode(" ", $pa[1]);
        }else{
            $pa = explode(" ", $data);
        }

        $pa = str_replace("(", "", $pa[1]);
        $pa = str_replace(")", "", $pa);
        return $pa;
    }

    public function galvijai_trinti(){

    }

    //suskaiciuoja karviu judejima
    public function karviu_judejimas($dat, $banda){
        $pi = $this->nuskaityti_gyvulius($dat);
        if (!empty($pi)) {
            if ($pi[0]['lytis'] == "Telyčaitė (Karvė)" OR $pi[0]['lytis'] == "Telyčaitė (Telyčaitė)") {
                //reikia patikrinti amziu, nes i karves galiu judeti ir is telyciu iki 24 menesiu
                if($pi[0]['amzius']>=24){
                    if($banda == '3'){
                        if($sk['veisle'] == "Limuzinai"){
                            $this->galvijai_model->mesiniai['karves']['j_i']++;
                            $this->galvijai_model->mesiniai['telycios_24']['j_is']++;
                        }else{
                            $this->galvijai_model->galvijai['karves']['j_i']++;
                            $this->galvijai_model->galvijai['telycios_24']['j_is']++;
                        }
                    }else{
                        $this->galvijai_model->galvijai['karves']['j_i']++;
                        $this->galvijai_model->galvijai['telycios_24']['j_is']++;
                    }
                    //$this->galvijai['karves']['j_i']++;
                    //$this->galvijai['telycios_24']['j_is']++;
                }else{
                    if($banda == '3'){
                        if($sk['veisle'] == "Limuzinai"){
                            $this->galvijai_model->mesiniai['karves']['j_i']++;
                            $this->galvijai_model->mesiniai['telycios_12']['j_is']++;
                        }else{
                            $this->galvijai_model->galvijai['karves']['j_i']++;
                            $this->galvijai_model->galvijai['telycios_12']['j_is']++;
                        }
                    }else{
                        $this->galvijai_model->galvijai['karves']['j_i']++;
                        $this->galvijai_model->galvijai['telycios_12']['j_is']++;
                    }
                    //$this->galvijai['telycios_12']['j_is']++;
                    //$this->galvijai['karves']['j_i']++;
                }
            }
        }
    }

    //galviju pirkimas
    /*public function galviju_pirkimas($pradzia, $informacija, $banda, $gyvunas, $duomenys){
        $lka = explode(".", $pradzia);
        $info = explode(" ",$informacija);
        if($lka[0] == $metai AND $lka[1] == $menesis AND $info[1] == 'Atvyko'){
            if($banda == '3'){
                if($sk['veisle'] == "Limuzinai"){
                    $this->galvijai_model->mesiniai[$gyvunas]['pirkimai']++;
                    $this->galvijai_model->pirkimai[$gyvunas][] = $duomenys;
                }else{
                    $this->galvijai_model->galvijai[$gyvunas]['pirkimai']++;
                    $this->galvijai_model->pirkimai[$gyvunas][] = $duomenys;
                }
            }else{
                $this->galvijai_model->galvijai[$gyvunas]['pirkimai']++;
                $this->galvijai_model->pirkimai[$gyvunas][] = $duomenys;
            }
        }
    }*/

    //skaiciuja kur dingo gyvunai pagal koda
    public function ivykio_skaiciavimas($pp, $banda, $gyvunas, $duomenys){
        if($pp == '07' || $pp == '05'){
            if($banda == '3'){
                if($sk['veisle'] == "Limuzinai"){
                    $this->galvijai_model->mesiniai[$gyvunas]['parduota']++;
                    $this->galvijai_model->pardavimai[$gyvunas][] = $duomenys;
                }else{
                    $this->galvijai_model->galvijai[$gyvunas]['parduota']++;
                    $this->galvijai_model->pardavimai[$gyvunas][] = $duomenys;
                }
            }else{
                $this->galvijai_model->galvijai[$gyvunas]['parduota']++;
                $this->galvijai_model->pardavimai[$gyvunas][] = $duomenys;
            }
            //$this->galvijai[$gyvunas]['parduota']++;
        }
        if($pp == '03'){
            if($banda == '3'){
                if($sk['veisle'] == "Limuzinai"){
                    $this->galvijai_model->mesiniai[$gyvunas]['kritimai']++;}else{
                    $this->galvijai_model->galvijai[$gyvunas]['kritimai']++;
                }
            }else{
                $this->galvijai_model->galvijai[$gyvunas]['kritimai']++;
            }
            //$this->galvijai[$gyvunas]['kritimai']++;
            }
        if($pp == '14'){
            if($banda == '3'){
                if($sk['veisle'] == "Limuzinai"){
                    $this->galvijai_model->mesiniai[$gyvunas]['suvartota']++;}else{
                    $this->galvijai_model->galvijai[$gyvunas]['suvartota']++;
                }
            }else{
                $this->galvijai_model->galvijai[$gyvunas]['suvartota']++;
            }
            //$this->galvijai[$gyvunas]['suvartota']++;
        }
        if($pp == '02'){
            if($banda == '3'){
                if($sk['veisle'] == "Limuzinai"){
                    $this->galvijai_model->mesiniai[$gyvunas]['parduota']++;
                    $this->galvijai_model->pardavimai[$gyvunas][] = $duomenys;
                }else{
                    $this->galvijai_model->galvijai[$gyvunas]['parduota']++;
                    $this->galvijai_model->pardavimai[$gyvunas][] = $duomenys;
                }
            }else{
                $this->galvijai_model->galvijai[$gyvunas]['parduota']++;
                $this->galvijai_model->pardavimai[$gyvunas][] = $duomenys;
            }
            //$this->galvijai[$gyvunas]['parduota']++;
        }
    }

    //nustatymai, perkelti prie (ukininkai)
    public function nustatymai($nr){
        $this->db->from('nustatymai');
        $this->db->where('u_id', $nr);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    //nuskaitomas gyvuliu sarasas, iskart puslapiavimui
    public function gyvuliu_sarasas_limit($dat, $limit, $start) {
        $data = array();
        $this->db->where($dat);
        $this->db->limit($limit, $start);
        $query = $this->db->get("galvijai");

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

   //pagal m dvi datas suskaiciuoja kiek menesiu praeje
   public function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' ){
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);
    }

    //nuskaito gyvulius, pagal duodama uzklausa
    public function nuskaityti_gyvulius($dat){
        if (isset($dat['lytis']) && count($dat['lytis']) > 1) {
            $this->db->where_in('lytis', $dat['lytis']);
        unset($dat['lytis']);
    }
    $this->db->where($dat);
    $query = $this->db->get("galvijai");
    $data = $query->result_array();
    return $data;
    }

    //patikrinam ar toks gyvunas nera jau ikeltas, kad nesidubliutu
    public function tikinti_gyvulius_ikelti($metai, $menesis, $valdos_nr) {
        $this->db->select('id');
        $this->db->from('galvijai');
        $array = array('ukininkas' => $valdos_nr, 'metai' => $metai, 'menesis' => $menesis);
        $this->db->where($array);
        $result = $this->db->count_all_results();
        return $result;
    }

    //irasom visu gyvuliu sarasa i duomenu baze
    public function Irasyti_visus($data, $ukininkas, $metai, $menuo){
        for($i =1; $i<count($data); $i++){
            $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menuo, 'numeris' => $data[$i][2]);
            $rezultatai = $this->galvijai_model->nuskaityti_gyvulius($dat);
            if(count($rezultatai)<1){
            $sql = array(
                'menesis' => $menuo ,
                'metai' => $metai,
                'ukininkas' => $ukininkas,
                'numeris' => $data[$i][2] ,
                'lytis' => $data[$i][4],
                'veisle' => $data[$i][5] ,
                'gimimo_data' => $data[$i][6] ,
                'laikymo_pradzia' => $data[$i][7],
                'laikymo_pabaiga' => $data[$i][8] ,
                'informacija' => $data[$i][9]);
            $this->db->insert('galvijai', $sql);
            }
        }
        return TRUE;
    }

    //atnaujinam duomenu bazes lentele, ir pridedam amziu tam tikram gyvuliui
    public function Atnaujinti_visus($data, $ukininkas, $metai, $menuo){
        for($i=1; $i<count($data); $i++) {
            $dat = array('ukininkas' => $ukininkas, 'metai' => $metai, 'menesis' => $menuo, 'numeris' => str_replace("*","",$data[$i][2]));
            $this->db->where($dat);
            $this->db->update('galvijai', array('amzius' => $data[$i][7]));
        }
        return true;
    }

    //curl issitraukiam duomenis is vic.lt pagal ukinko prisijungimo duomenis
    public function get_VIC($url, $post, $auth){
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:54.0) Gecko/20100101 Firefox/54.0", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => 0,        // Disabled SSL Cert checks
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_USERPWD        => $auth,
            CURLOPT_POSTFIELDS     => $post,
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        //$info = curl_getinfo($ch);
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }

    //parsinam duomenis ir HTMl failu apie gyvulius
    public function Visi_gyvunai($url){
        $dom = new DOMDocument();
        @$dom->loadHTML($url);
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
        $rows = $tables->item(7)->getElementsByTagName('tr');
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

    public function Gyvi_gyvunai($url){
        $dom = new DOMDocument();
        @$dom->loadHTML($url);
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
            $rows = $tables->item(8)->getElementsByTagName('tr');
            foreach ($rows as $row) {
                // get each column by tag name
                $cols = $row->getElementsByTagName('td');
                $row = array();
                $i = 0;
                foreach ($cols as $node) {
                    if ($row_headers == NULL)
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
