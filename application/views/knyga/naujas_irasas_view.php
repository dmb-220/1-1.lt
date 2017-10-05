<div id="laikotarpis" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Laikotarpis</h4>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>

<div id="naujas_irasas" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Naujas įrašas</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>zalia_knyga/naujas_irasas" method="POST">
                    <?php $dt = $this->session->userdata(); ?>
                    <fieldset>
                        <div class="form-group" id="data_knyga">
                            <label class="control-label col-md-4">Data</label>
                            <div class="col-md-6">
                                <?php echo form_error('data'); ?>
                                <div class="input-group date">
                                    <input type="text" name="data" class="form-control"/>
                                    <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Operacija</label>
                            <div class="col-md-6">
                                <?php echo form_error('operacija'); ?>
                                <select name="operacija" class="form-control">
                                    <option value="">Pasirinkite...</option>
                                    <?php
                                    foreach ($inf['pvm'] as $pvm){
                                        echo"<option value=".$pvm['id'].">";
                                        echo $pvm['pavadinimas'];
                                        echo"</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Kiekis</label>
                            <div class="col-md-6">
                                <input name="kiekis" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Mato vienetas</label>
                            <div class="col-md-6">
                                <?php echo form_error('vnt'); ?>
                                <select name="vnt" class="form-control">
                                    <option value="vnt">VNT</option>
                                    <option value="kg">KG</option>
                                    <option value="litrai">Litrai</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Vertė</label>
                            <div class="col-md-6">
                                <input name="verte" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4"></label>
                            <div class="col-md-6 col-sm-6">
                                <button class="btn btn-block btn-outline btn-primary" type="submit">
                                    <i class="fa fa-check-circle-o fa-lg"> ĮRAŠYTI</i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>

<div id="organizaciju_sarasas" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nauja operacija</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>zalia_knyga/organizaciju_irasas" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Organizacijos pavadinimas</label>
                            <div class="col-md-6">
                                <input name="pavadinimas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Įmonė kodas</label>
                            <div class="col-md-6">
                                <input name="kodas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">PVM kodas (jei turi)</label>
                            <div class="col-md-6">
                                <input name="tarifas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4"></label>
                            <div class="col-md-6 col-sm-6">
                                <button class="btn btn-block btn-outline btn-primary" type="submit">
                                    <i class="fa fa-check-circle-o fa-lg"> ĮRAŠYTI</i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>

<div id="pvm" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nauja operacija</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>zalia_knyga/pvm_irasas" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Operacija</label>
                            <div class="col-md-6">
                                <input name="pavadinimas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Kodas</label>
                            <div class="col-md-6">
                                <input name="kodas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Tarifas ( % )</label>
                            <div class="col-md-6">
                                <input name="tarifas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4"></label>
                            <div class="col-md-6 col-sm-6">
                                <button class="btn btn-block btn-outline btn-primary" type="submit">
                                    <i class="fa fa-check-circle-o fa-lg"> ĮRAŠYTI</i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <hr>
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <td>Operacija</td>
                        <td><b>Kodas</b></td>
                        <td><b>Tarifas</b></td>
                    </tr>
                    </thead>
                    <tbody
                    <?php
                    foreach ($inf['pvm'] as $pvm){
                        echo"<tr>";
                        echo"<td>".$pvm['pavadinimas']."</td>";
                        if($pvm['kodas'] != ""){
                            echo"<td>".$pvm['kodas']."</td>";
                        }else{echo"<td>-</td>";}
                        if($pvm['tarifas'] != 0){
                            echo"<td>".$pvm['tarifas']."</td>";
                        }else{echo"<td> </td>";}
                        echo"</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>