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
            <h4 class="panel-title">Gyvuliai</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>gyvuliai/skaiciuoti_gyvulius" method="POST">
                <?php
                $dt = $this->session->userdata();

                //$pradzia = array_column($debug['verseliai'], 'numeris');
                //$pabaiga = array_column($debug2['verseliai'], 'numeris');

                //foreach($debug['verseliai'] as $ver) {
                    //$key = array_search($ver['numeris'], $pabaiga);
                   // echo"+++++++++++++++++++++++++++++++++++++++";
                    //echo $key;
                    //echo"<br>";
                   // if(!$key){$arr[] = $ver;}
               // }
                //$key = array_search('100', array_column($userdb, 'uid'));
                //var_dump($arr);
                ?>

                <fieldset>
                    <legend>Suskaičiuoti gyvulius</legend>
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
                        <label class="col-md-4 control-label">Metai</label>
                        <div class="col-md-6">
                            <?php echo form_error('metai'); ?>
                            <select name="metai" class="form-control">
                                <option value="2016">2016</option>
                                <option value="2017" selected="selected">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                            </select>
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
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-sm btn-primary m-r-5">Skaičiuoti gyvulius</button>
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
                            <p class="text-center">GYVULIŲ JUDĖJIMO LENTELĖ</p>
                        </strong></h4></br></br>
                    <p class="alignleft">
                        <?php echo $this->linksniai->getName($inf['vardas'], 'kil')." ".$this->linksniai->getName($inf['pavarde'],'kil')." ūkis"; ?>
                    </p>
                    <p class="alignright">
                        <?php
                        $num_day = cal_days_in_month(CAL_GREGORIAN, $inf['menesis'], $inf['metai']);
                        echo $inf['metai']." ".$men[$inf['menesis']-1]." 1 - ".$num_day;
                        ?>
                    </p>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Gyvuliai</th>
                            <th>Menesio pradžioje</th>
                            <th>Gimimai</th>
                            <th>Pirkimai</th>
                            <th>Judėjimas IŠ</th>
                            <th>Judėjimas Į</th>
                            <th>Kritimai</th>
                            <th>Suvartota ūkyje</th>
                            <th>Parduota</th>
                            <th>Menesio pabaigoje</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $x = 0;
                        $ss = 0;
                        $pavad = array('Melžiamos karvės', 'Veršeliai iki 1m.', 'Telyčios 1-2 m.', 'Buliai 1-2 m.', 'Tel. virš 2 m.', 'Buliai 2 m. ir daugiau', 'Iš viso:');
                        foreach($gyvuliai as $col){
                            $ss = $col['pradzia'] + $col['pirkimai'] + $col['gimimai'] - $col['j_is'] + $col['j_i'] - $col['kritimai'] - $col['suvartota'] - $col['parduota'];
                            if($col['pabaiga'] != $ss){echo'<tr class="danger">';}else{echo'<tr>';}
                            echo"<td>";  echo $pavad[$x];  echo"</td>";
                            foreach($col as $row){
                                echo"<td><b>";
                                if($row != 0){
                                echo $row;}
                                echo"</b></td>";


                            }
                            echo"</tr>";
                            $x++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            <input type="button" value="Spausdinti" onclick="PrintElem('.table-responsive')" />


        </div>
    </div>
    <!-- end panel -->
</div>
<!-- end #content -->
            <?php }
            ?>