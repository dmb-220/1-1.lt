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
                <h4 class="modal-title">Naujas PVM įrašas</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>zalia_knyga/pvm_irasas" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Kodas</label>
                            <div class="col-md-6">
                                <?php echo form_error('kodas'); ?>
                                <input name="kodas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Tarifas ( % )</label>
                            <div class="col-md-6">
                                <?php echo form_error('tarifas'); ?>
                                <input name="tarifas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Aprašymas</label>
                            <div class="col-md-6">
                                <?php echo form_error('aprasymas'); ?>
                                <textarea class="form-control" rows="2" name="aprasymas"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Pavyzdžiai</label>
                            <div class="col-md-6">
                                <?php echo form_error('pvz'); ?>
                                <textarea class="form-control" rows="2" name="pvz"></textarea>
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