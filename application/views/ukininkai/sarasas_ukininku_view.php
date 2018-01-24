<div class="wrapper wrapper-content">
    <div class="row">
        <?php  foreach($this->main_model->info['ukininkai'] as $row) {
            $ukio_tipas = array("GYVULININKYSTĖ", "AUGALININKYSTĖ", "ŽUVININKYSTĖ", "MIŠKININKYSTĖ");?>
        <div class="col-lg-4">
            <div class="contact-box center-version">
                <a href="<?php echo"profilis/".$row['valdos_nr']; ?>">
                    <div class="alert alert-info">
                    <h3 class="m-b-xs"><strong><?php echo $row['vardas']." ".$row['pavarde']; ?></strong></h3></div>
                    <div class="font-bold"><?php echo $ukio_tipas[$row['ukio_tipas']]; ?></div>
                    <address class="m-t-md">
                        <strong><?php echo $row['adresas']; ?></strong><br>
                        <?php echo"El. paštas: "; if($row['email']){echo $row['email'];}else{echo"Neturi";} ?><br>
                        <?php echo"Telefonas: "; if($row['telefonas']){echo $row['telefonas'];}else{echo"Neturi";} ?><br>
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a class="btn btn-xs btn-white" href="<?php echo"redaguoti/".$row['valdos_nr']; ?>"><i class="glyphicon glyphicon-pencil"></i> Redaguoti </a>
                        <a class="btn btn-xs btn-white" href="<?php echo"istrinti/".$row['valdos_nr']; ?>"><i class="glyphicon glyphicon-remove"></i> Ištrinti </a>
                    </div>
                </div>

            </div>
        </div>
        <?php } ?>
    </div>
</div>
