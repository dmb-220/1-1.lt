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
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>gyvuliai/gyvuliu_sarasas" method="POST">
                <?php $dt = $this->session->userdata(); ?>
                <fieldset>
                    <legend>Gyvulių sąrašas</legend>
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
                            <button type="submit" class="btn btn-sm btn-primary m-r-5">Rodyti gyvulių sąrašą</button>
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
if($error['action']){
    ?>
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
                            <p class="text-center">GYVULIŲ SĄRAŠAS</p>
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
                    <button type="button" class="btn btn-default m-r-5 m-b-5 delete" id="<?php echo $inf['vardas']; ?>">Ištrinti</button>
                    dar neveikia, darysim su Jquery.
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
                            <th>Svoris</th>
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
    <!-- end panel -->
</div>
<!-- end #content -->
            <?php }
            ?>