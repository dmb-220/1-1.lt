<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Mėšlo skaičiavimas laikotarpiui</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>pasarai/meslas" method="POST">
                    <?php
                    $dt = $this->session->userdata();
                    ?>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Ūkininkas</label>
                            <div class="col-md-6">
                                <?php echo form_error('ukininko_vardas');
                                if($dt['vardas'] == "" AND $dt['pavarde'] == "") { ?>
                                    <select name="ukininko_vardas" class="form-control">
                                        <option value="">Pasirinkite...</option>
                                        <?php
                                        foreach ($this->main_model->info['ukininkai'] as $row) {
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
                                    <option value="2016">2015 - 2016</option>
                                    <option value="2017">2016 - 2017</option>
                                    <option value="2018" selected="selected">2017 - 2018</option>
                                    <option value="2019">2018 - 2019</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Laikotarpis</label>
                            <div class="col-md-6">
                                <?php
                                $men = array("Visas sezonas", "Spalis", "Lapkritis", "Gruodis", "Sausis", "Vasaris", "Kovas", "Balandis");
                                ?>
                                <?php echo form_error('laikotarpis'); ?>
                                <select name="laikotarpis" class="form-control">
                                    <option value="">Pasirinkite...</option>
                                    <?php
                                    for($i=0; $i<count($men); $i++) {
                                        echo"<option value=".$i.">";
                                        echo $men[$i];
                                        echo"</option>";
                                    } ?>
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
                        <h4><strong>GYVULIŲ MĖŠLO LENTELĖ</strong></h4>
                    </div>
                    <br><br>
                    <div class="pull-left">
                        <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                        ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
                    </div>
                    <div class="pull-right">
                        <?php
                        $men = array("Visas sezonas", "Spalis", "Lapkritis", "Gruodis", "Sausis", "Vasaris", "Kovas", "Balandis");
                        $sezo = $this->main_model->info['txt']['sezonas']-1;
                        echo $sezo." - ".$this->main_model->info['txt']['sezonas']." sezonas: <b>".$this->main_model->info['txt']['metai']." ".$men[$this->main_model->info['txt']['laikotarpis']]."</b>";
                        ?>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Pavadinimas</th>
                            <th>Kiekis</th>
                            <th>Mėslas</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $viso = 0;

                        foreach($gyvu as $col){
                            echo'<tr>';
                            echo"<td>";  echo $col['pavadinimas'];  echo"</td>";
                            echo"<td>";  echo $col['kiek'];  echo"</td>";
                            echo"<td>";  echo $col['meslas'];  echo" t.</td>";
                            echo"</tr>";

                            $viso += $col['meslas'];
                        }
                        echo"<tr>";
                        echo"<td class='success' colspan='2'><b>Viso</b></td>";
                        echo"<td class='danger'><b>".$viso." t.</b></td>";
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
            '00', '11', '12', '01', '02', '03', '04', 'viso'
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
                        <h4><strong>GYVULIŲ MĖŠLO LENTELĖ</strong></h4>
                    </div>
                    <br><br>
                    <div class="pull-left">
                        <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                        ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
                    </div>
                    <div class="pull-right">
                        <?php
                        $men = array("Visas sezonas", "Lapkritis", "Gruodis", "Sausis", "Vasaris", "Kovas", "Balandis");
                        $sezo = $this->main_model->info['txt']['sezonas']-1;
                        echo $sezo." - ".$this->main_model->info['txt']['sezonas']." sezonas: <b>".$men[$this->main_model->info['txt']['laikotarpis']]."</b>";
                        ?>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td rowspan=2><b>Pavadinimas</b></td>
                            <td colspan=2><b>Lapkritis</b></td>
                            <td colspan=2><b>Gruodis</b></td>
                            <td colspan=2><b>Sausis</b></td>
                            <td colspan=2><b>Vasaris</b></td>
                            <td colspan=2><b>Kovas</b></td>
                            <td colspan=2><b>Balandis</b></td>
                            <td colspan=2><b>VISO</b></td>
                        </tr>
                        <tr>
                            <td>Kiekis</td>
                            <td>Mėšlas</td>
                            <td>Kiekis</td>
                            <td>Mėšlas</td>
                            <td>Kiekis</td>
                            <td>Mėšlas</td>
                            <td>Kiekis</td>
                            <td>Mėšlas</td>
                            <td>Kiekis</td>
                            <td>Mėšlas</td>
                            <td>Kiekis</td>
                            <td>Mėšlas</td>
                            <td>Kiekis</td>
                            <td>Mėšlas</td>
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
                                echo "<td>" . $col[$arr[$i]]['meslas'] . " t.</td>";
                            }
                            echo"</tr>";

                            $viso += $col['viso']['meslas'];
                        }
                        echo"<tr>";
                        echo"<td class='success' colspan='14'><b>Viso</b></td>";
                        echo"<td class='danger'><b>".$viso." t.</b></td>";
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