<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Redaguoti informacija</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <?php
            var_dump($this->main_model->info['ukininkas']);
            ?>
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>ukininkai/redaguoti" method="POST">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Ūkininkas:</label>
                        <div class="col-md-6">
                            <?php echo form_error('ukininko_vardas'); ?>
                            <input name="ukininko_vardas" type="text" class="form-control" placeholder="" value="<?= $this->main_model->info['ukininkas'][0]['vardas']." ".
                            $this->main_model->info['ukininkas'][0]['pavarde'] ?>" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Asmens kodas:</label>
                        <div class="col-md-6">
                            <?php echo form_error('kodas'); ?>
                            <input name="kodas" type="text" class="form-control" placeholder=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Adresas:</label>
                        <div class="col-md-6">
                            <?php echo form_error('adresas'); ?>
                            <input name="adresas" type="text" class="form-control" placeholder="" />
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Sąskaitos numeris:</label>
                        <div class="col-md-6">
                            <?php echo form_error('numeris'); ?>
                            <input name="numeris" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Bankas</label>
                        <div class="col-md-6">
                            <?php echo form_error('Bankas'); ?>
                            <input name="bankas" type="password" class="form-control" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">El. paštas:</label>
                        <div class="col-md-6">
                            <?php echo form_error('email'); ?>
                            <input name="email" type="password" class="form-control" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Telefono numeris</label>
                        <div class="col-md-6">
                            <?php echo form_error('telefonas'); ?>
                            <input name="telefonas" type="password" class="form-control" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> IŠSAUGOTI</i>
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
