<div class="wrapper wrapper-content">
    <div class="row">
        <?php  foreach($data['results'] as $row) {
            $ukio_tipas = array("GYVULININKYSTĖ", "AUGALININKYSTĖ", "ŽUVININKYSTĖ", "MIŠKININKYSTĖ");?>
            <div class="col-lg-4">
                <div class="contact-box center-version">
                    <div class="alert alert-info">
                        <h3 class="m-b-xs"><strong><?php echo $row['vardas_pavarde']; ?></strong></h3>
                    </div>
                    <div class="font-bold"><?php echo "Valdos NR.: <b>".$row['valdos_numeris']."</b>"; ?></div>
                    <address class="m-t-md">
                        <strong><?php echo $row['adresas']; ?></strong><br>
                        <strong><?php echo $row['adresas_2']; ?></strong><br>
                        <strong><?php echo $row['adresas_3']; ?></strong><br>
                        <strong><?php echo $row['adresas_4']; ?></strong><br>
                        <?php echo"Telefonas: "; if($row['telefonas']){echo $row['telefonas'];}else{echo"Neturi";} ?><br>
                    </address>
                </div>
            </div>
        <?php } ?>
        <?php echo $data['links']; ?>
    </div>
</div>