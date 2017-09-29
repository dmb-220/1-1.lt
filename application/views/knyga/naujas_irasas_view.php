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