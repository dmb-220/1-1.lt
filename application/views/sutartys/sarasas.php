<div class="wrapper wrapper-content">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                ...
            </div>
            <div class="ibox-content">
        <div class="table-responsive" id="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Ūkininkas</th>
                    <th>Sutarties NR.</th>
                    <th>Menesis</th>
                    <th>Metai</th>
                    <th>...</th>
                </tr>
                </thead>
        <?php
        if(count($this->main_model->info['sarasas']) > 0){
        foreach($this->main_model->info['sarasas'] as $row) {
            $data = unserialize($row['sutartis']);

            //var_dump($data);
            $ukio_tipas = array("GYVULININKYSTĖ", "AUGALININKYSTĖ", "ŽUVININKYSTĖ", "MIŠKININKYSTĖ");?>
            <tbody>
            <tr>
                <td><a href="<?php echo"perziureti/".$row['valdos_nr']; ?>"><?php echo $row['vardas']." ".$row['pavarde']; ?></a></td>
                <td><?php echo "Sutarties NR.: <b>".$row['numeris']."</b>"; ?></td>
                <td><?php echo"Viso per menesį: ".$data['viso_menesis']; ?></td>
                <td><?php echo "Viso per metus: ".$data['viso_metai']." "; ?></td>
                <td class="nerodyt"><a class="btn btn-sm btn-warning" href="<?php echo"istrinti/".$row['valdos_nr']; ?>"><i class="glyphicon glyphicon-remove"></i> Ištrinti </a></td>
            </tr>
            </tbody>
        <?php }
        }else{
            echo"<div class='ibox float-e-margins'>";
            echo"<div class='ibox-content'>";
            echo"Ūkininkų sutarčių nerasta";
            echo"</div></div>";
        }
        ?>
            </table>
        </div>
                <div class="form-group">
                    <button class="btn btn-block btn-outline btn-primary" type="button" onclick="printDiv('table-responsive')">
                        <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
                    </button>
                </div>
            </div>
    </div>
</div>