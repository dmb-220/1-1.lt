<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Sutarties informacija</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <?php
            $data = unserialize($this->main_model->info['sutartis'][0]['sutartis']);
            //var_dump($data);
            ?>
            <div class="text-center">
                <strong>PASLAUGŲ TEIKIMO SUTARTIS Nr. <?php echo $this->main_model->info['sutartis'][0]['numeris']; ?></strong>
            </div>
            <div class="text-center">
                <?php echo $this->main_model->info['sutartis'][0]['data']; ?>
            </div>
            <div class="text-center">
                Šiauliai
            </div>
            <br>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Paslauga</th>
                    <th>Kiekis</th>
                    <th>Kaina už menesį</th>
                    <th>Kaina už metus</th>
                </tr>
                </thead>
                <tbody>
                <tr><td class='success' colspan='4'>BAZINĖ KAINA</td></tr>
                <?php
                if($data['pirminiai'] != ""){
                    echo"<tr>
                    <td>Pirminiai dokumentai</td>
                    <td>".$data['pirminiai']." vnt.</td>
                    <td>".$data['pirminiai_menuo']."</td>
                    <td>".$data['pirminiai_metai']."</td>
                </tr>";
                }

                if($data['inventorizacija_kiekis'] !=""){
                    echo"<tr>
                    <td>Metinė inventorizacija</td>
                    <td>".$data['inventorizacija_kiekis']." vnt.</td>
                    <td>".$data['inventorizacija_menesis']."</td>
                    <td>".$data['inventorizacija_metai']."</td>
                </tr>";}

                if($data['bankai'] > 0){
                    echo"<tr>
                    <td>Bankai</td>
                    <td>".$data['bankai']." vnt.</td>
                    <td>".$data['bankai_menesis']."</td>
                    <td>".$data['bankai_metai']."</td>
                </tr>";}

                if($data['kreditai'] > 0){
                    echo"<tr>
                    <td>Kreditai</td>
                    <td>".$data['kreditai']." vnt.</td>
                    <td>".$data['kreditai_menesis']."</td>
                    <td>".$data['kreditai_metai']."</td>
                </tr>";}

                if($data['saskaita'] =="on"){
                    echo"<tr>
                    <td>Sąskaitų planas</td>
                    <td> </td>
                    <td>".$data['saskaita_menesis']."</td>
                    <td>".$data['saskaita_metai']."</td>
                </tr>";
                }


                if($data['is_darbininkai_2'] == "on" && $data['darbuotojai_2_kiekis'] > 0) {
                    echo "<tr><td class='success' colspan='4'>DARBO UŽMOKESČIO APSKAITOS KAINA</td></tr>";

                    if ($data['is_darbininkai_2'] == "on" && $data['darbuotojai_2_kiekis'] > 0) {
                        echo "<tr>
                    <td>Darbuotojai</td>
                    <td>" . $data['darbuotojai_2_kiekis'] . " vnt.</td>
                    <td>" . $data['darbuotojai_2_menesis'] . "</td>
                    <td>" . $data['darbuotojai_2_metai'] . "</td>
                </tr>";
                    }

                    if ($data['is_darbininkai'] == "on" && $data['darbuotojai_kiekis'] > 0) {
                        echo "<tr>
                    <td>Darbuotojai *</td>
                    <td>" . $data['darbuotojai_kiekis'] . " vnt.</td>
                    <td>" . $data['darbuotojai_menesis'] . "</td>
                    <td>" . $data['darbuotojai_metai'] . "</td>
                </tr>";
                    }

                    //<!-- FR572 keiciam i GPM313 FR573 keiciam i GPM312 -->
                    if ($data['darbuotojai_kiekis'] > 0 || $data['darbuotojai_2_kiekis'] > 0) {
                        echo "<tr>
                    <td>GPM313 forma</td>
                    <td> </td>
                    <td>" . $data['fr572_menesis'] . "</td>
                    <td>" . $data['fr572_metai'] . "</td>
                </tr>";
                    }

                    if ($data['darbuotojai_kiekis'] > 0 || $data['darbuotojai_2_kiekis'] > 0) {
                        echo "<tr>
                    <td>GPM312 forma</td>
                    <td> </td>
                    <td>" . $data['fr573_menesis'] . "</td>
                    <td>" . $data['fr573_metai'] . "</td>
                </tr>";
                    }

                    if ($data['sam_kiekis'] > 0) {
                        echo "<tr>
                    <td>SAM pranešimai</td>
                    <td>" . $data['sam_kiekis'] . " vnt.</td>
                    <td>" . $data['sam_menesis'] . "</td>
                    <td>" . $data['sam_metai'] . "</td>
                </tr>";
                    }

                    if ($data['sd_kiekis'] > 0) {
                        echo "<tr>
                    <td>SD pranešimai</td>
                    <td>" . $data['sd_kiekis'] . " vnt.</td>
                    <td>" . $data['sd_menesis'] . "</td>
                    <td>" . $data['sd_metai'] . "</td>
                </tr>";
                    }
                }

                if($data['galvijai_kiekis'] > 0 || $data['dek_plotas'] > 0 || $data['technika_kiekis']) {
                    echo "<tr><td class='success' colspan='4'>";
                    if ($this->main_model->info['txt']['ukis'] == 0) {
                        echo 'GYVULININKYSTĖS APSKAITOS KAINA';
                    }
                    if ($this->main_model->info['txt']['ukis'] == 1) {
                        echo 'AUGALININKYSTĖS APSKAITOS KAINA';
                    }
                    echo "</td></tr>";

                    if ($data['galvijai_kiekis'] > 0) {
                        echo "<tr>
                    <td>Galvijai</td>
                    <td>" . $data['galvijai_kiekis'] . " vnt.</td>
                    <td>" . $data['galvijai_menesis'] . "</td>
                    <td>" . $data['galvijai_metai'] . "</td>
                </tr>";
                    }

                    if($data['judejimas'] == "on"){
                        echo"<tr>
                    <td>Galvijų judejimas</td>
                    <td> </td>
                    <td>".$data['judejimas_menesis']."</td>
                    <td>".$data['judejimas_metai']."</td>
                </tr>";}

                    if ($data['dek_plotas'] > 0) {
                        echo "<tr>
                    <td>Deklaruojamas plotas</td>
                    <td>" . $data['dek_plotas'] . " ha.</td>
                    <td>" . $data['suma_menesis'] . "</td>
                    <td>" . $data['suma_metai'] . "</td>
                </tr>";
                    }

                    if ($data['technika'] == "on" && $data['technika_kiekis']) {
                        echo "<tr>
                    <td>Technika</td>
                    <td>" . $data['technika_kiekis'] . " vnt.</td>
                    <td>" . $data['technika_menesis'] . "</td>
                    <td>" . $data['technika_metai'] . "</td>
                </tr>";
                    }
                }

                if($data['pvm_x12'] == "on" || $data['pvm_x2'] == "on" || $data['fr457_kiekis'] > 0 || $data['gpm308'] == "on" ||
                    $data['sav1_kiekis'] > 0 || $data['ivaz_kiekis'] > 0 || $data['isaf_12'] == "on" || $data['isaf_2'] == "on") {
                    echo "<tr><td class='success' colspan='4'>DEKLARACIJŲ KAINA</td></tr>";

                    if ($data['pvm_x12'] == "on") {
                        echo "<tr>
                    <td>PVM x12</td>
                    <td> </td>
                    <td>" . $data['pvm_x12_menesis'] . "</td>
                    <td>" . $data['pvm_x12_metai'] . "</td>
                </tr>";
                    }

                    if ($data['pvm_x2'] == "on") {
                        echo "<tr>
                    <td>PVM x2</td>
                    <td> </td>
                    <td>" . $data['pvm_x2_menesis'] . "</td>
                    <td>" . $data['pvm_x2_metai'] . "</td>
                </tr>";
                    }

                    if ($data['fr457'] == "on" && $data['fr457_kiekis'] > 0) {
                        echo "<tr>
                    <td>FR457 forma</td>
                    <td> </td>
                    <td>" . $data['fr457_menesis'] . "</td>
                    <td>" . $data['fr457_metai'] . "</td>
                </tr>";
                    }

                    if ($data['gpm308'] == "on") {
                        echo "<tr>
                    <td>GPM308 forma</td>
                    <td> </td>
                    <td>" . $data['gpm308_menesis'] . "</td>
                    <td>" . $data['gpm308_metai'] . "</td>
                </tr>";
                    }

                    if ($data['sav1'] == "on" && $data['sav1_kiekis'] > 0) {
                        echo "<tr>
                    <td>SAV1 forma</td>
                    <td> </td>
                    <td>" . $data['sav1_menesis'] . "</td>
                    <td>" . $data['sav1_metai'] . "</td>
                </tr>";
                    }

                    if ($data['ivaz'] == "on" && $data['ivaz_kiekis'] > 0) {
                        echo "<tr>
                    <td>I-VAZ</td>
                    <td>" . $data['ivaz_kiekis'] . "</td>
                    <td>" . $data['ivaz_menesis'] . "</td>
                    <td>" . $data['ivaz_metai'] . "</td>
                </tr>";
                    }

                    if ($data['isaf_12'] == "on") {
                        echo "<tr>
                    <td>I-SAF x12</td>
                    <td> </td>
                    <td>" . $data['isaf_12_menesis'] . "</td>
                    <td>" . $data['isaf_12_metai'] . "</td>
                </tr>";
                    }

                    if ($data['isaf_2'] == "on") {
                        echo "<tr>
                    <td>I-SAF x2</td>
                    <td> </td>
                    <td>" . $data['isaf_2_menesis'] . "</td>
                    <td>" . $data['isaf_2_metai'] . "</td>
                </tr>";
                    }
                }


                if($data['kuras_kiekis'] > 0 || $data['gamtos_apsauga'] == "on" || $data['zemes_kiekis'] > 0 || $data['europa'] == "on") {
                    echo "<tr><td class='success' colspan='4'>KITŲ PASLAUGŲ KAINA</td></tr>";

                    if ($data['gamtos_apsauga'] == "on") {
                        echo "<tr>
                    <td>Aplinkos taršos mokestis</td>
                    <td> </td>
                    <td>" . $data['apsauga_menesis'] . "</td>
                    <td>" . $data['apsauga_metai'] . "</td>
                </tr>";
                    }

                    if ($data['zemes_mokestis'] == "on" && $data['zemes_kiekis'] > 0) {
                        echo "<tr>
                    <td>Žemės mokestis</td>
                    <td>" . $data['zemes_kiekis'] . " vnt.</td>
                    <td>" . $data['zemes_menesis'] . "</td>
                    <td>" . $data['zemes_metai'] . "</td>
                </tr>";
                    }

                    if ($data['europa'] == "on") {
                        echo "<tr>
                    <td>Europos parama</td>
                    <td> </td>
                    <td>" . $data['europa_menesis'] . "</td>
                    <td>" . $data['europa_metai'] . "</td>
                </tr>";
                    }


                    if ($data['kuras'] == "on" && $data['kuras_kiekis'] > 0) {
                        echo "<tr>
                    <td>Kuro apskaita</td>
                    <td>" . $data['kuras_kiekis'] . " vnt.</td>
                    <td>" . $data['kuras_menesis'] . "</td>
                    <td>" . $data['kuras_metai'] . "</td>
                </tr>";
                    }
                }

                ?>
                </tbody>
            </table>
            <hr>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th> </th>
                    <th>Už menesį</th>
                    <th>Už metus</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $be_nuolaidos_menuo = str_replace(" €", "", $data['viso_menesis']) + str_replace(" €", "", $data['nuolaida_menesis']);
                $be_nuolaidos_metai = str_replace(" €", "", $data['viso_metai']) + str_replace(" €", "", $data['nuolaida_metai']);
                echo"<tr>
                    <td>Be nuolaidos</td>
                    <td>".$be_nuolaidos_menuo." €</td>
                    <td>".$be_nuolaidos_metai." €</td>
                </tr>";
                if($data['nuolaida'] > 0){
                    echo"<tr>
                    <td>Nuolaida ( ".$data['nuolaida']."% ), iš jų:<br>";
                    if($data['laiku_atsiskaito'] == "on"){echo"Laiku atsiskaito: ( 2% )<br>";}
                    if($data['seimos_nariai'] == "on"){echo"Šeimos nariai veda apskaitą: ( 5% )<br>";}
                    if($data['laiku_dokumentai'] == "on"){echo"Laiku pateikia pirminius dokumentus: ( 10% )";}
                    echo"</td>
                    <td>".$data['nuolaida_menesis']."</td>
                    <td>".$data['nuolaida_metai']."</td>
                </tr>";}else{
                    echo"<tr>
                    <td>Nuolaida ( 0% )</td>
                    <td>0 €</td>
                    <td>0 €</td>
                </tr>";
                }
                echo"<tr class='danger'>
                    <td>Viso</td>
                    <td>".$data['viso_menesis']."</td>
                    <td>".$data['viso_metai']."</td>
                </tr>";
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end panel -->
</div>
<!-- end #content -->