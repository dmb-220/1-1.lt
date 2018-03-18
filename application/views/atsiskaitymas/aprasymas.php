<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>APRAŠYMAS</h5>
        <div class="ibox-tools">
            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            <a class="close-link"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="ibox-content">
        <?php
        /*$arr = file_get_contents(base_url()."DATA/new.txt");
        $arr = explode(PHP_EOL, $arr);
        foreach ($arr as $row){
            $va = preg_split("/[\t]/", trim($row));
            $klase = substr($va[0], 0, 1);
            $grupe = substr($va[0], 1, 1);
            $pogrupis = substr($va[0], 2, 1);
            $sub_1 = substr($va[0], 3, 1);
            $sub_2 = substr($va[0], 4, 1);
            $sub_3 = substr($va[0], 5, 1);
            $data = array("kodas" => $va[0], "pavadinimas" => $va[1], "klase" => $klase,
                "pogrupis" => $pogrupis, "grupe" => $grupe, "sub_1" => $sub_1, "sub_2" => $sub_2, "sub_3" => $sub_3);
            //echo $klase."/".$grupe."/".$pogrupis."/".$sub_1."/".$sub_2."/".$sub_3."<br>";
            $this->db->insert('saskaitu_planas', $data);
            var_dump($va);
        }
        //var_dump($arr);

        $this->db->select('*');
        $this->db->from('saskaitu_planas');
        $this->db->where(array("klase" => 1,"pogrupis" => ""));
        $result = $this->db->get();
       var_dump($result->result_array());
        */
        ?>
    </div>
</div>