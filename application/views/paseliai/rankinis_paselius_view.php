<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Įveskite turimus pasėlius ir jų kiekius</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>paseliai/rankinis_paselius" method="POST">
                <fieldset>
                    <?php
                    if($error['plotas']){
                        echo'<div class="alert alert-info">';
                        echo $error['plotas'];
                        echo '</div>';
                    }

                    if($error['kodas']){
                        echo'<div class="alert alert-info">';
                        echo $error['kodas'];
                        echo '</div>';
                    }
                    ?>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Duomenu įvedimas:</label>
                        <div class="col-md-6">
                            <div class="row row-space-10 input-group control-group after-add-more">
                                <div class="col-md-3 m-b-15">
                                <input type="text" name="kodas[]" class="form-control" placeholder="Kodas" style="text-transform:uppercase">
                                    </div>
                                <div class="col-md-6 m-b-15">
                                <input type="text" name="plotas[]" class="form-control" placeholder="Įveskite plotą">
                                    </div>
                                <div class="col-md-6 m-b-15 input-group-btn">
                                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i></button>

                                </div>

                            </div>
                        </div>
                    </div>
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
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> SKAIČIUOTI</i>
                            </button>
                        </div>
                </fieldset>
            </form>

            <!-- Copy Fields -->

            <div class="copy hide">
                <div class="row row-space-10 control-group input-group" style="margin-top:10px">
                    <div class="col-md-3 m-b-15">
                    <input type="text" name="kodas[]" class="form-control" placeholder="Kodas" style="text-transform:uppercase">
                        </div>
                    <div class="col-md-6 m-b-15">
                    <input type="text" name="plotas[]" class="form-control" placeholder="Įveskite plotą">
                        </div>
                    <div class="col-md-6 m-b-15 input-group-btn">
                        <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php
if($error['action']){ ?>
    <div class="wrapper wrapper-content animated fadeInRight">
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
    </div>
<?php }
?>