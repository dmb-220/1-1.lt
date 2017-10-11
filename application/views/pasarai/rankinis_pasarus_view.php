<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Įveskite turimų gyvulių kiekius</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>pasarai/rankinis_pasarus" method="POST">
                <fieldset>
                    <?php
                    if($this->main_model->info['error']['laikas']){
                        echo'<div class="alert alert-danger">';
                        echo $this->main_model->info['error']['laikas'];
                        echo '</div>';
                    }
                    if($this->main_model->info['error']['laikas2']) {
                        echo '<div class="alert alert-danger">';
                        echo $this->main_model->info['error']['laikas2'];
                        echo '</div>';
                    }

                    foreach($data as $key => $row) {
                        if($key!="viso") {
                            echo "<div class=\"form-group\">
                        <label class=\"col-md-4 control-label\">" . $row['pavadinimas'] . "</label>
                        <div class=\"col-md-6\">";
                            echo form_error($key);
                            echo "<input name=" . $key . " type=\"text\" class=\"form-control\" placeholder=\"\" />
                        </div>
                        </div>";
                        }
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Ūkininkas</label>
                        <div class="col-md-6">
                            <?php echo form_error('ukininko_vardas'); ?>
                            <div class="row row-space-10">
                                <div class="col-md-6 m-b-15">
                                    <?php echo form_error('vardas'); ?>
                                    <input type="text" name="vardas" class="form-control" placeholder="Vardas">
                                </div>
                                <div class="col-md-6 m-b-15">
                                    <?php echo form_error('pavarde'); ?>
                                    <input type="text" name="pavarde" class="form-control" placeholder="Pavardė">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Menesis</label>
                        <div class="col-md-6">
                            <?php
                            $men = array("Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa",
                                "Rugpjūtis", "Rugsejis", "Spalis","Lapkritis", "Gruodis");
                            ?>
                            <?php echo form_error('menesis'); ?>
                            <select name="menesis" class="form-control">
                                <option value="">Pasirinkite...</option>
                                <?php
                                for($i=0; $i<count($men); $i++) {
                                    $mm = $i+1;
                                    echo"<option value=".$mm.">";
                                    echo $men[$i];
                                    echo"</option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Laikotarpis</label>
                        <div class="col-md-6">
                            <?php
                            $lai = array("I pusmetis", "II pusmetis", "I ketvirtis", "II ketvirtis", "III ketvirtis", "IV ketvirtis");
                            ?>
                            <?php echo form_error('laikotarpis'); ?>
                            <select name="laikotarpis" class="form-control">
                                <option value="">Pasirinkite...</option>
                                <?php
                                for($i=0; $i<count($lai); $i++) {
                                    $mm = $i+1;
                                    echo"<option value=".$mm.">";
                                    echo $lai[$i];
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
//var_dump($gyvuliai);
if($this->main_model->info['error']['action']){ ?>
    <div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Informacija</h5>
        <div class="ibox-tools">
            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            <a class="close-link"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="ibox-content">
            <div class="table-responsive">
                <div class="text-center">
                    <h4><strong>GYVULIŲ PAŠARŲ LENTELĖ</strong></h4>
                </div>
                <br><br>
                <div class="pull-left">
                    <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                    ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
                </div>
                <div class="pull-right">
                    <?php
                    if($this->main_model->info['txt']['menesis']){
                        $num_day = cal_days_in_month(CAL_GREGORIAN, $this->main_model->info['txt']['menesis'], $this->main_model->info['txt']['metai']);
                        echo $this->main_model->info['txt']['metai']." ".$men[$this->main_model->info['txt']['menesis']-1]." 1 - ".$num_day;
                    }
                    if($this->main_model->info['txt']['laikotarpis']){
                        echo $this->main_model->info['txt']['metai']." <b>".$inf['laikotarpis']."</b>";
                    }
                    ?>
                </div>
                <hr>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Gyvuliai</th>
                        <th>Kiek</th>
                        <th>Šienas</th>
                        <th>Šiaudai</th>
                        <th>Grudai</th>
                        <th>Šakniavaisiai</th>
                        <th>Šienainis</th>
                        <th>Bulves</th>
                        <th>Silosas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach($data as $col){
                        $ke = array_keys($col);
                        echo"<tr>";
                        for($i = 0; $i < count($ke); $i++) {
                            echo "<td>";
                            if ($col[$ke[$i]] != 0 OR $col[$ke[$i]] != '') {
                                if ($ke[$i] == 'kiek') {
                                    echo $col[$ke[$i]];
                                    echo " vnt.";
                                } else if ($ke[$i] == 'pavadinimas') {
                                    echo $col[$ke[$i]];
                                } else {
                                    if ($col[$ke[$i]]['vid'] != 0 OR $col[$ke[$i]]['vid'] != '') {
                                        if( $col[$ke[$i]]['vid'] ==  $col[$ke[$i]]['min'] AND $col[$ke[$i]]['vid'] == $col[$ke[$i]]['max']){
                                            echo round($col[$ke[$i]]['vid'] / 1000, 2)." T.<br>";
                                        }else{
                                            echo "MIN: ".round($col[$ke[$i]]['min'] / 1000, 2)." T.<br>";
                                            echo "VID: ".round($col[$ke[$i]]['vid'] / 1000, 2)." T.<br>";
                                            echo "MAX: ".round($col[$ke[$i]]['max'] / 1000, 2)." T.";
                                        }
                                    }
                                }
                            }
                            echo "</td>";
                        }
                        echo"</tr>";
                    }

                    ?>
                    </tbody>
                </table>
                </div>

        <div class="form-group">
            <button class="btn btn-block btn-outline btn-primary" type="button" onclick="PrintElem('.table-responsive')">
                <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
            </button>
        </div>
            </div>
            </div>

            <?php }
            ?>
        </div>
