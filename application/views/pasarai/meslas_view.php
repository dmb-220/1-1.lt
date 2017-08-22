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
                                            echo $row[vardas];
                                            echo " ";
                                            echo $row[pavarde];
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
                                <?php echo form_error('metai'); ?>
                                <select name="sezonas" class="form-control">
                                    <option value="2016">2015 - 2016</option>
                                    <option value="2017" selected="selected">2016 - 2017</option>
                                    <option value="2018">2017 - 2018</option>
                                    <option value="2019">2018 - 2019</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Laikotarpis</label>
                            <div class="col-md-6">
                                <?php
                                $men = array("Visas sezonas", "Lapkritis", "Gruodis", "Sausis", "Vasaris", "Kovas", "Balandis");
                                ?>
                                <?php echo form_error('menesis'); ?>
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
</div>