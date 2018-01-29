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
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>galvijai/gyvuliu_sarasas" method="POST">
                <?php $dt = $this->session->userdata(); ?>
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Ūkininkas</label>
                        <div class="col-md-6">
                            <?php echo form_error('ukininkas');
                            if($dt['vardas'] == "" AND $dt['pavarde'] == "") { ?>
                                <select name="ukininkas" class="form-control">
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
                                <i class="fa fa-check-circle-o fa-lg"> RODYTI GYVULIŲ SĄRAŠĄ</i>
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

<?php
if($this->main_model->info['error']['action']){
    ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Gyvulių sąrašas</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    <a class="close-link"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <h4><strong>
                            <p class="text-center">GYVULIŲ SĄRAŠAS</p>
                        </strong></h4><br><br>
                    <div class="pull-left">
                        <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                        ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
                    </div>
                    <div class="pull-right">
                        <?php
                        $num_day = cal_days_in_month(CAL_GREGORIAN, $this->main_model->info['txt']['menesis'], $this->main_model->info['txt']['metai']);
                        echo $this->main_model->info['txt']['metai']." ".$men[$this->main_model->info['txt']['menesis']-1]." 1 - ".$num_day;
                        ?>
                    </div>
                    <hr>
                    Sutartinis žymėjimas:
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Karvė (Karvė)</th>
                            <th>Telyčaitė (Telyčaitė)</th>
                            <th>Buliukas (Buliukas)</th>
                            <th>Telyčaitė (Karvė)</th>
                            <th>Iškeliavęs gyvulys</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td bgcolor="#faebd7"></td>
                            <td bgcolor="#f0e68c"></td>
                            <td bgcolor="#90ee90"></td>
                            <td bgcolor="#add8e6"></td>
                            <td bgcolor="#dc143c"></td>
                        </tr>
                        </tbody>
                    </table>

                    <hr>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Numeris</th>
                            <th>Lytis</th>
                            <th>Veislė</th>
                            <th>Gimimo data</th>
                            <th>Laikymo pradžia</th>
                            <th>Laikymo pabaiga</th>
                            <th>Amžius</th>
                            <th>Informacija</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                foreach($gyvu as $col){
                    switch ($col['lytis']) {
                        case "Karvė (Karvė)": echo'<tr bgcolor="#faebd7">'; break;
                        case "Telyčaitė (Telyčaitė)": echo'<tr bgcolor="#f0e68c">'; break;
                        case "Buliukas (Buliukas)": echo'<tr bgcolor="#90ee90">'; break;
                        case "Telyčaitė (Karvė)": echo'<tr bgcolor="#add8e6">'; break;
                        default: echo'<tr>';
                    }

                    foreach($col as $row){
                        if($row == ""){
                            echo "<td bgcolor='#dc143c'>".$row."</td>";
                        }else{
                            echo "<td>".$row."</td>";
                        }
                    }
                    echo"</tr>";
                }
                        ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

<?php
}
?>
</div>
