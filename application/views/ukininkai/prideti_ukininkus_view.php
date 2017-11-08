<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Pridėti naują ūkininką</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
                    <form class="form-horizontal form-bordered" action="<?= base_url(); ?>ukininkai/prideti_ukininka" method="POST">
                        <fieldset>
                            <?php
                            if($this->main_model->info['error']['yra']){
                                echo'<div class="alert alert-danger">';
                                echo $this->main_model->info['error']['yra'];
                                echo '</div>';
                            }
                            if($this->main_model->info['error']['ok']) {
                                echo '<div class="alert alert-danger">';
                                echo $this->main_model->info['error']['ok'];
                                echo '</div>';
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
                                <label class="col-md-4 control-label">Slaptažodis</label>
                                <div class="col-md-6">
                                    <?php echo form_error('slaptazodis'); ?>
                                    <input name="slaptazodis" type="password" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Galvijų banda:</label>
                                <div class="col-md-6">
                                    <div class="row row-space-12">
                                        <?php echo form_error('banda'); ?>
                                        <div class="col-md-2 m-b-15">
                                            <div class="radio radio-info radio-inline">
                                                <?php if($this->main_model->info['txt']['banda'] == 2){
                                                    echo"<input type='radio' value='2' name='banda' checked>";}else{
                                                    echo"<input type='radio' value='2' name='banda'>";
                                                } ?>
                                                <label> MĖSINIAI </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2 m-b-15">
                                            <div class="radio radio-info radio-inline">
                                                <?php if($this->main_model->info['txt']['banda'] == 1){
                                                    echo"<input type='radio' value='1' name='banda' checked>";}else{
                                                    echo"<input type='radio' value='1' name='banda'>";
                                                } ?>
                                                <label> PIENINIAI </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2 m-b-15">
                                            <div class="radio radio-info radio-inline">
                                                <?php if($this->main_model->info['txt']['banda'] == 3){
                                                    echo"<input type='radio' value='3' name='banda' checked>";}else{
                                                    echo"<input type='radio' value='3' name='banda'>";
                                                } ?>
                                                <label> MIŠRŪS </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4"></label>
                                <div class="col-md-6 col-sm-6">
                                    <button class="btn btn-block btn-outline btn-primary" type="submit">
                                        <i class="fa fa-check-circle-o fa-lg"> PRIDĖTI</i>
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- end panel -->
</div>
<!-- end #content -->