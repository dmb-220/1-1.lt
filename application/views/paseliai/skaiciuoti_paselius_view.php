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
            <h4 class="panel-title">Pasėliai</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>paseliai/skaiciuoti_paselius" method="POST">
                <?php
                $dt = $this->session->userdata();
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
                            <p class="text-center">PASĖLIŲ DEKLARAVIMO LENTELĖ</p>
                        </strong></h4></br></br>
                    <p class="alignleft">
                        <?php echo $this->linksniai->getName($inf['vardas'], 'kil')." ".$this->linksniai->getName($inf['pavarde'],'kil')." ūkis"; ?>
                    </p>
                    <p class="alignright">
                        <?php
                        echo $inf['metai']." m." ;
                        ?>
                    </p>
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

                <input type="button" value="Spausdinti" onclick="PrintElem('.table-responsive')" />


            </div>
        </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-danger" data-sortable-id="ui-widget-13">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Informacija</h4>
            </div>
            <div class="panel-body">
                <div class="note note-success">
                    Rodom visus deklaruotas paselius, lenteleje, rodomi tik tie paseliai kurie turi duomenis, kiek seklu reik i 1 ha.
                    Itraukite naujus paselius ir atsiras lenteleje deklaruotas plotas.
                    </div>
                <?php
                var_dump($da);
                ?>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end #content -->
<?php }
?>