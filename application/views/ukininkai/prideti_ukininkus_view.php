<!-- begin #content -->
<div id="content" class="content">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-4">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Ūkininkai</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" action="<?= base_url(); ?>ukininkai/prideti_ukininka" method="POST">
                        <fieldset>
                            <legend>Naujas ūkininkas</legend>
                            <?php
                            if($data[action]=='OK'){
                                echo"Naujas ukininkas pridetas!";
                            }
                            if($data[action]=='YRA'){
                                echo"TOKS ukininkas jau yra!";
                            }
                            ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Vardas</label>
                                <div class="col-md-6">
                                    <?php echo form_error('vardas'); ?>
                                    <input name="vardas" type="text" class="form-control" placeholder= "" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Pavardė</label>
                                <div class="col-md-6">
                                    <?php echo form_error('pavarde'); ?>
                                    <input name="pavarde" type="text" class="form-control" placeholder=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Valdos numeris</label>
                                <div class="col-md-6">
                                    <?php echo form_error('valdos_nr'); ?>
                                    <input name="valdos_nr" type="text" class="form-control" placeholder="" />
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Vartotojo vardas</label>
                                <div class="col-md-6">
                                    <?php echo form_error('v_vardas'); ?>
                                    <input name="v_vardas" type="text" class="form-control" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Slaptazodis</label>
                                <div class="col-md-6">
                                    <?php echo form_error('slaptazodis'); ?>
                                    <input name="slaptazodis" type="password" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-sm btn-primary m-r-5">Pridėti</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- end panel -->
</div>
<!-- end #content -->