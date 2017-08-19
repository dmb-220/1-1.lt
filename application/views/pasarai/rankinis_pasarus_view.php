<!-- begin #content -->
<div id="content" class="content">
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Pašarų normos 1 gyvuliui per parą</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>pasarai/rankinis_pasarus" method="POST">
                <fieldset>
                    <legend>Rankinis pašarų skaičiavimas</legend>
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
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-sm btn-primary m-r-5">Skaičiuoti</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <!-- end panel -->
</div>
<!-- end #content -->

<?php
//var_dump($gyvuliai);
if($error['action']){ ?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">
                ...
            </h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <h4><strong>
                        <p class="text-center">GYVULIŲ PAŠARŲ LENTELĖ</p>
                    </strong></h4></br></br>
                <p class="alignleft">
                    <?php echo $this->linksniai->getName($inf['vardas'], 'kil')." ".$this->linksniai->getName($inf['pavarde'],'kil')." ūkis"; ?>
                </p>
                <p class="alignright">
                    <?php
                    if($inf['menesis']){
                        $num_day = cal_days_in_month(CAL_GREGORIAN, $inf['menesis'], $inf['metai']);
                        echo $inf['metai']." ".$men[$inf['menesis']-1]." 1 - ".$num_day;
                    }
                    if($inf['laikotarpis']){
                        echo $inf['metai']." <b>".$inf['laikotarpis']."</b>";
                    }
                    ?>
                </p>
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

            <input type="button" value="Spausdinti" onclick="PrintElem('.table-responsive')" />

            </div>
            </div>

            <?php }
            ?>
        </div>
    </div>
    <!-- end panel -->
</div>
<!-- end #content -->