<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Ganyklinių pašarų skaičiavimas laikotarpiui</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>pasarai/ganykliniai_pasarai" method="POST">
                    <?php
                    $dt = $this->session->userdata();
                    ?>
                    <fieldset>
                        <?php
                        if($error['laikas']){
                            echo'<div class="alert alert-danger">';
                            echo $error['laikas'];
                            echo '</div>';
                        }
                        if($error['laikas2']) {
                            echo '<div class="alert alert-danger">';
                            echo $error['laikas2'];
                            echo '</div>';
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Ūkininkas</label>
                            <div class="col-md-6">
                                <?php echo form_error('ukininko_vardas');
                                if($dt['vardas'] == "" AND $dt['pavarde'] == "") { ?>
                                    <select name="ukininko_vardas" class="form-control">
                                        <option value="">Pasirinkite...</option>
                                        <?php
                                        foreach ($data as $row) {
                                            echo "<option value='$row[valdos_nr]'>";
                                            echo $row['vardas'];
                                            echo " ";
                                            echo $row['pavarde'];
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }else{
                                    echo '<select name="ukininko_vardas" class="form-control" disabled>';
                                    echo'<option value='.$dt['nr'].' selected="selected">'.$dt['vardas'].' '.$dt['pavarde'].'</option>';
                                    echo'</select>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Sezonas</label>
                            <div class="col-md-6">
                                <?php echo form_error('sezonas'); ?>
                                <select name="sezonas" class="form-control">
                                    <option value="2016">2016</option>
                                    <option value="2017" selected="selected">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Laikotarpis</label>
                            <div class="col-md-6">
                                <?php
                                $men = array("Visas sezonas", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis");
                                $arr = array('00', '05', '06', '07', '08', '09', '10');
                                ?>
                                <?php echo form_error('laikotarpis'); ?>
                                <select name="laikotarpis" class="form-control">
                                    <option value="">Pasirinkite...</option>
                                    <?php
                                    $me = date('m');
                                    for($i=0; $i<count($men); $i++) {
                                        //reik sutvarkyti, jei sezonas praejes, leistu apskaiciuoti visa
                                        if($me > $arr[$i] && $arr[$i] != '00' && $arr[$i] != '10'){
                                                echo "<option value=" . $i . ">".$men[$i]."</option>";}
                                                //cia istaisyti kai ateina spalis
                                                if($arr[$i] == 10 /*&& date('d') > 15 */){
                                                    echo "<option value=" . $i . ">Iki ".$this->linksniai->getName($men[$i], 'kil')." 15 d.</option>";
                                                }
                                    }
                                    /*if(date('m') == 10 && date('d') > 15){
                                        echo "<option value='00'>Visas sezonas</option>";
                                    }*/
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4"></label>
                            <div class="col-md-6 col-sm-6">
                                <button class="btn btn-block btn-outline btn-primary" type="submit">
                                    <i class="fa fa-check-circle-o fa-lg"> SKAITČIUOTI</i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
    </div>

    <?php
    if($this->main_model->info['error']['action'] == 1) {
        //var_dump($this->main_model->info['txt']);
        ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Informacija</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                    <a class="close-link"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <div class="text-center">
                        <h4><strong>GYVULIŲ GANYKLINIŲ PAŠARŲ LENTELĖ</strong></h4>
                    </div>
                    <br><br>
                    <div class="pull-left">
                        <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                        ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
                    </div>
                    <div class="pull-right">
                        <?php
                        $men = array("Visas sezonas", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis");
                        echo $this->main_model->info['txt']['sezonas']." sezonas: ";
                        if($this->main_model->info['txt']['laikotarpis'] == 6){
                            echo"<b>".$men[$this->main_model->info['txt']['laikotarpis']]." 1 - 15 d.</b>";}else{
                            echo"<b>".$men[$this->main_model->info['txt']['laikotarpis']]."</b>";
                        }
                        ?>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Pavadinimas</th>
                            <th>Kiekis</th>
                            <th>Ganykliniai pašarai</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $viso = 0;

                        foreach($gyvu as $col){
                            echo'<tr>';
                            echo"<td>";  echo $col['pavadinimas'];  echo"</td>";
                            echo"<td>";  echo $col['kiek'];  echo"</td>";
                            echo"<td>";  echo $col['pasarai']/1000;  echo" t.</td>";
                            echo"</tr>";

                            $viso += $col['pasarai'];
                        }
                        echo"<tr>";
                        echo"<td class='success' colspan='2'><b>Viso</b></td>";
                        echo"<td class='danger'><b>";
                        echo $viso/1000;
                            echo" t.</b></td>";
                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- Spauzdinti myktukas -->
                <div class="form-group">
                    <button class="btn btn-block btn-outline btn-primary" type="button" onclick="PrintElem('.table-responsive')">
                        <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
                    </button>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <?php
    if($this->main_model->info['error']['action'] == 2) {
        //var_dump($gyvu);
        $arr = array(
            '00', '05', '06', '07', '08', '09', '10', 'viso'
        );
        ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Informacija</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                    <a class="close-link"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                            <div class="text-center">
                                <h4><strong>GYVULIŲ GANYKLINIŲ PAŠARŲ LENTELĖ</strong></h4>
                            </div>
                        <br><br>
                    <p class="alignleft">
                        <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                        ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
                    </p>
                    <p class="alignright">
                        <?php
                        $men = array("Visas sezonas", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis");
                        echo $this->main_model->info['txt']['sezonas']." sezonas: <b>Visas sezonas</b>";
                        ?>
                    </p>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td rowspan=2><b>Pavadinimas</b></td>
                            <td colspan=2><b>Gegužė</b></td>
                            <td colspan=2><b>Birželis</b></td>
                            <td colspan=2><b>Liepa</b></td>
                            <td colspan=2><b>Rugpjūtis</b></td>
                            <td colspan=2><b>Rugsėjis</b></td>
                            <td colspan=2><b>Spalis</b></td>
                            <td colspan=2><b>VISO</b></td>
                        </tr>
                        <tr>
                            <td>Kiekis</td>
                            <td>Ganykliniai pašarai</td>
                            <td>Kiekis</td>
                            <td>Ganykliniai pašarai</td>
                            <td>Kiekis</td>
                            <td>Ganykliniai pašarai</td>
                            <td>Kiekis</td>
                            <td>Ganykliniai pašarai</td>
                            <td>Kiekis</td>
                            <td>Ganykliniai pašarai</td>
                            <td>Kiekis</td>
                            <td>Ganykliniai pašarai</td>
                            <td>Kiekis</td>
                            <td>Ganykliniai pašarai</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $viso = 0;

                        foreach($gyvu as $col){
                            echo'<tr><td>';
                            echo $col['pavadinimas'];  echo"</td>";
                            for($i = 1; $i < count($arr); $i++) {
                                echo "<td>" . $col[$arr[$i]]['kiek'] . "</td>";
                                echo "<td>" . $col[$arr[$i]]['pasarai']/1000 . " t.</td>";
                            }
                            echo"</tr>";

                            $viso += $col['viso']['pasarai'];
                        }
                        echo"<tr>";
                        echo"<td class='success' colspan='14'><b>Viso</b></td>";
                        echo"<td class='danger'><b>";
                        echo $viso/1000;
                        echo" t.</b></td>";
                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- Spauzdinti myktukas -->
                <div class="form-group">
                    <button class="btn btn-block btn-outline btn-primary" type="button" onclick="PrintElem('.table-responsive')">
                        <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
                    </button>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

</div>