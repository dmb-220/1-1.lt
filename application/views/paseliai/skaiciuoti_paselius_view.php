<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Pasirinkite laikotarpį pašarų skaičiavimui</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>paseliai/skaiciuoti_paselius" method="POST">
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
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> SKAIČIUOTI</i>
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

<?php
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
                        <h4><strong>PASĖLIŲ DEKLARAVIMO LENTELĖ</strong></h4>
                    </div>
                    <br><br>
                    <div class="pull-left">
                        <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                        ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
                    </div>
                    <div class="pull-right">
                        <?php
                        echo $this->main_model->info['txt']['metai']." m." ;
                        ?>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Pasėliai</th>
                            <th>Kodas</th>
                            <th>Plotas</th>
                            <th>Sėkla</th>
                            <th>Derlius</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($da as $key => $col){
                            if (array_key_exists('sekla', $col)) {
                                echo"<tr><td>".$col['pavadinimas']."</td>";
                                echo"<td>".$key."</td>";
                                echo"<td>".$col['plotas']." ha.</td>";
                                if($col['sekla']['vid'] != $col['sekla']['min'] AND $col['sekla']['vid'] != $col['sekla']['max']){
                                    echo"<td>MIN: ".round($col['sekla']['min']/1000, 2)." T.<br>
                                    VID: ".round($col['sekla']['vid']/1000, 2)."T.<br>
                                    MAX: ".round($col['sekla']['max']/1000, 2)." T.</td>";
                                }else{
                                    echo"<td>".round($col['sekla']['vid']/1000, 2)." T.</td>";
                                }
                                if($col['derlius']['vid'] != $col['derlius']['min'] AND $col['derlius']['vid'] != $col['derlius']['max']){
                                    echo"<td>MIN: ".round($col['derlius']['min']/1000, 2)." T.<br>
                                    VID: ".round($col['derlius']['vid']/1000, 2)." T.<br>
                                    MAX: ".round($col['derlius']['max']/1000, 2)." T.</td></tr>";
                                }else{
                                echo"<td>".round($col['derlius']['vid']/1000, 2)." T.</td>";
                                }
                            }
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

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Informacija</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    <a class="close-link"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="alert alert-info">
                    Rodom visus deklaruotas paselius, lenteleje, rodomi tik tie paseliai kurie turi duomenis, kiek seklu reik i 1 ha.
                    Itraukite naujus paselius ir atsiras lenteleje deklaruotas plotas.
                    </div>
                <?php
                var_dump($da);
                ?>
            </div>
        </div>
<?php }
?>
</div>
