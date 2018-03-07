<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Pasirinkite laikotarpį</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
        <div class="table-responsive" id="table-responsive">
            <?php
            $galviju = array(
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
            $ploto = array(
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
            ); ?>

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Ūkininkas</th>
                    <th>Ūkis</th>
                    <th>Dydis</th>
                    <th>Galvijai</th>
                    <th>Žemė</th>
                    <th>Menesis</th>
                    <th>Metai</th>
                    <th>Ūkio dydis</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($this->main_model->info['ukininkai'] as $row) {
                    $ukio_tipas = array("GYVULININKYSTĖ", "AUGALININKYSTĖ", "ŽUVININKYSTĖ", "MIŠKININKYSTĖ");
                    $galviju_kiekis = $this->sutartys_model->galvijai_vidurkis($row['valdos_nr']);
                    $dat = array('ukininkas' => $row['valdos_nr'], 'metai' => '2017');
                    $zemes_kiekis =  $this->sutartys_model->deklaruotas_plotas($dat);

                    $sk_gal = $this->sutartys_model->rasti_skaiciu($galviju, $galviju_kiekis);
                    $sk_plo = $this->sutartys_model->rasti_skaiciu($ploto, $zemes_kiekis);

                    $suma = $this->sutartys_model->sutarties_suma($row['valdos_nr'], "2017");
                    ?>

                    <tr>
                        <td><?php echo $row['vardas']." ".$row['pavarde']; ?></td>
                        <td><?php echo $ukio_tipas[$row['ukio_tipas']]; ?></td>
                        <td><?php echo $sk_gal." - ".$sk_plo; ?></td>
                        <td><?php if($row['ukio_tipas'] == 0) { echo "Galvijų vidurkis: " . $galviju_kiekis;} ?></td>
                        <td><?php echo "Žemės vidurkis: " . $zemes_kiekis; ?></td>
                        <td><?php echo $suma[0]['uz_menesi']; ?></td>
                        <td><?php echo $suma[0]['uz_metus']; ?></td>
                        <td><form action='<?= base_url(); ?>sutartys/ukio_dydis' method='POST'>
                                <input type="hidden" value="<?= $row['valdos_nr']; ?>" name="ukio_id[]">
                                <select name='dydis[]' class='form-control' onchange='if(this.value != 0) { this.form.submit(); }'>
                            <?php
                            echo"<option value='0'>Pasirinkite...</option>";
                               for($i = 1; $i < 6; $i++ ){
                                   if($row['dydis'] == $i){echo"<option value='$i' selected>$i</option>";}else{
                                       echo"<option value='$i'>$i</option>";
                                   }
                               }
                               echo"</select></form>";
                            ?>
                        </td>
                    </tr>

                <?php } ?>
                </tbody>
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