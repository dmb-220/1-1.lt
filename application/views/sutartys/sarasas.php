<div class="wrapper wrapper-content">
    <div class="row">
        <?php
        if(count($this->main_model->info['sarasas']) > 0){
        foreach($this->main_model->info['sarasas'] as $row) {
            $data = unserialize($row['sutartis']);

            //var_dump($data);
            $ukio_tipas = array("GYVULININKYSTĖ", "AUGALININKYSTĖ", "ŽUVININKYSTĖ", "MIŠKININKYSTĖ");?>
            <div class="col-lg-4">
                <div class="contact-box center-version">
                    <a href="<?php echo"perziureti/".$row['valdos_nr']; ?>">
                        <div class="alert alert-info">
                            <h3 class="m-b-xs"><strong><?php echo $row['vardas']." ".$row['pavarde']; ?></strong></h3></div>
                        <div class="font-bold"><?php echo "Sutarties NR.: <b>".$row['numeris']."</b>"; ?></div>
                        <address class="m-t-md text-left">
                            <strong><?php echo"Viso per menesį: ".$data['viso_menesis']; ?></strong><br>
                            <?php echo "Viso per metus: ".$data['viso_metai']." "; ?><br>
                        </address>

                    </a>
                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <!-- <a class="btn btn-sm btn-info" href="<?php //echo"redaguoti/".$row['valdos_nr']; ?>"><i class="glyphicon glyphicon-pencil"></i> Redaguoti </a> -->
                            <a class="btn btn-sm btn-warning" href="<?php echo"istrinti/".$row['valdos_nr']; ?>"><i class="glyphicon glyphicon-remove"></i> Ištrinti </a>
                        </div>
                    </div>

                </div>
            </div>
        <?php }
        }else{
            echo"<div class='ibox float-e-margins'>";
            echo"<div class='ibox-content'>";
            echo"Ūkininkų sutarčių nerasta";
            echo"</div></div>";
        }
        ?>
    </div>
</div>