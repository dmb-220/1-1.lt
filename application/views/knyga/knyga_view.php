<?php
$men = array("Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa",
    "Rugpjūtis", "Rugsėjis", "Spalis","Lapkritis", "Gruodis");
?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Laikotarpis</h5>
                <?php
                $num_day = cal_days_in_month(CAL_GREGORIAN, $inf['menesis'], $inf['metai']);
                echo $inf['metai']." ".$men[$inf['menesis']-1]." 1 - ".$num_day;
                ?>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>zalia_knyga/knyga" method="POST">
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
                                <i class="fa fa-check-circle-o fa-lg"> PASIRINKTI</i>
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <!-- Klaidu pranesimai is, naujo PVM tarifo sukurimo -->
    <?php
    //i masyva surasom klaidu pavadinimus(masyvo raktai)
    $array_error = array("pvm_ok", "pvm_kodas", "pvm_tarifas");
    foreach ($array_error as $err){
    if($this->session->flashdata($err)){ ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Informacija
            </div>
            <div class="panel-body">
                <?php echo $this->session->flashdata($err); ?>
            </div>
        </div>
    <?php }
    }
    ?>


    <div class="alert alert-success" role="alert">
        <!-- Nauajas irasas-->
        <a data-toggle="modal" href="#naujas_irasas" class="btn btn-default" type="button">
            <i class="fa fa-plus-square-o fa-lg"> NAUJAS ĮRAŠAS</i>
        </a>

        <!-- PVM-->
        <a data-toggle="modal" href="#pvm" class="btn btn-default" type="button">
            <i class="fa fa-plus-square-o fa-lg"> PVM</i>
        </a>
    </div>


     <?php
     $this->load->view("knyga/naujas_irasas_view");
     ?>

    <!-- Pagrindinis langas -->

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Pagrindinis</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <h4><strong>
                        <p class="text-center"> PINIGŲ, PIRKIMO IR PARDAVIMO OPERACIJOS</p>
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
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <td rowspan=2><b>Data</b></td>
                        <td rowspan=2><b>Operacija</b></td>
                        <td rowspan=2><b>Kiekis</b></td>
                        <td rowspan=2><b>Mato vnt.</b></td>
                        <td colspan=3><b>Pirkimas</b></td>
                        <td colspan=3><b>Pardavimas</b></td>
                        <td rowspan=2><b>Veiksmai</b></td>
                    </tr>
                    <tr>
                        <td>Vertė</td>
                        <td>PVM</td>
                        <td>Kodas</td>
                        <td>Vertė</td>
                        <td>PVM</td>
                        <td>Kodas</td>
                    </tr>
                    </thead>
                    <tbody
                    <tr>
                        <td>2017.08.26</td>
                        <td>Pardavimas (Pienas)</td>
                        <td>348</td>
                        <td>Litrai</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>143 eurų</td>
                        <td>21 %</td>
                        <td>PVM1</td>
                        <td>
                            <a data-toggle='modal' href='#redaguoti-form' id=".$data[$i]['gid'].">Red.</a> |
                            <a data-toggle='modal' href='#istrinti-form' id=".$data[$i]['gid'].">Išt.</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2017.09.25</td>
                        <td>Pirkimas (Grudai)</td>
                        <td>100</td>
                        <td>KG</td>
                        <td>14 eurų</td>
                        <td>21 %</td>
                        <td>PVM6</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a data-toggle='modal' href='#redaguoti-form' id=".$data[$i]['gid'].">Red.</a> |
                            <a data-toggle='modal' href='#istrinti-form' id=".$data[$i]['gid'].">Išt.</a>
                        </td>
                    </tr>
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
</div>


