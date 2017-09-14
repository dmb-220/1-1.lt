<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Pasirinkite laikotarpį</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>galvijai/skaiciuoti_gyvulius" method="POST">
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
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> SKAIČIUTI GYVULIUS</i>
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

            <?php
            if($error['action']){ ?>
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
                    <h4><strong>
                            <p class="text-center">GYVULIŲ JUDĖJIMO LENTELĖ</p>
                        </strong></h4><br><br>
                    <div class="pull-left">
                        <?php echo $this->linksniai->getName($inf['vardas'], 'kil')." ".$this->linksniai->getName($inf['pavarde'],'kil')." ūkis"; ?>
                    </div>
                    <div class="pull-right">
                        <?php
                        $num_day = cal_days_in_month(CAL_GREGORIAN, $inf['menesis'], $inf['metai']);
                        echo $inf['metai']." ".$men[$inf['menesis']-1]." 1 - ".$num_day;
                        ?>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Gyvuliai</th>
                            <th>Mėnesio pradžioje</th>
                            <th>Gimimai</th>
                            <th>Pirkimai</th>
                            <th>Judėjimas IŠ</th>
                            <th>Judėjimas Į</th>
                            <th>Kritimai</th>
                            <th>Suvartota ūkyje</th>
                            <th>Parduota</th>
                            <th>Mėnesio pabaigoje</th>
                        </tr>
                        </thead>
                        <tbody>
                <?php

                    $x = 0;
                    $ss = 0;
                    if($inf['karves'] == 1){$karves = 'Melžiamos karvės';}else
                        if($inf['karves'] == 2){$karves = 'Mėsinės karvės';}else{
                            $karves = 'Karvės';
                        }
                    $pavad = array($karves, 'Veršeliai iki 1m.', 'Telyčios 1-2 m.', 'Buliai 1-2 m.', 'Tel. virš 2 m.', 'Buliai 2 m. ir daugiau', 'Iš viso:');
                    foreach ($galvijai as $col) {
                        $ss = $col['pradzia'] + $col['pirkimai'] + $col['gimimai'] - $col['j_is'] + $col['j_i'] - $col['kritimai'] - $col['suvartota'] - $col['parduota'];
                        if ($col['pabaiga'] != $ss) {
                            echo '<tr class="danger">';
                        } else {
                            echo '<tr>';
                        }
                        echo "<td>";
                        echo $pavad[$x];
                        echo "</td>";
                        foreach ($col as $row) {
                            echo "<td><b>";
                            if ($row != 0) {
                                echo $row;
                            }
                            echo "</b></td>";
                        }
                        echo "</tr>";
                        $x++;
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
