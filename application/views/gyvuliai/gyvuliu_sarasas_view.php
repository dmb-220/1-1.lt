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
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>gyvuliai/gyvuliu_sarasas" method="POST">
                <?php $dt = $this->session->userdata(); ?>
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
                                <i class="fa fa-check-circle-o fa-lg"> RODYTI GYVULIŲ SĄRAŠĄ</i>
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

<?php
if($error['action']){
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
                    if($col['amzius'] == ""){echo'<tr class="danger">';}else{echo'<tr>';}
                    foreach($col as $row){
                            echo "<td>";
                            echo $row;
                            echo "</td>";
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
