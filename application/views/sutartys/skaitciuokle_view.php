<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Sutarties skaičiuoklės</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <?php
            if($this->main_model->info['error']['login']){
                echo'<div class="alert alert-danger">';
                echo $this->main_model->info['error']['login'];
                echo '</div>';
            }
            ?>
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#gyvunai"> Gyvulininkystė</a></li>
                    <li class=""><a data-toggle="tab" href="#augalai"> Augalininkystė</a></li>
                </ul>
                <div class="tab-content">
                    <div id="gyvunai" class="tab-pane active">
                        <div class="panel-body">
                            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>sutartys/gyvunai" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Bazinė kaina:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Galvijai (vnt):</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <?php echo form_error('gyvuliai'); ?>
                                                <div class="col-md-2 m-b-15">
                                                    <div class="radio radio-info radio-inline">
                                                        <?php if($this->main_model->info['txt']['banda'] == 2){
                                                        echo"<input type='radio' value='2' name='gyvuliai' checked>";}else{
                                                            echo"<input type='radio' value='2' name='gyvuliai'>";
                                                        } ?>
                                                        <label> MĖSINIAI </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 m-b-15">
                                                    <div class="radio radio-info radio-inline">
                                                        <?php if($this->main_model->info['txt']['banda'] == 1){
                                                            echo"<input type='radio' value='1' name='gyvuliai' checked>";}else{
                                                            echo"<input type='radio' value='1' name='gyvuliai'>";
                                                        } ?>
                                                        <label> PIENINIAI </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 m-b-15">
                                                    <div class="radio radio-info radio-inline">
                                                        <?php if($this->main_model->info['txt']['banda'] == 3){
                                                            echo"<input type='radio' value='3' name='gyvuliai' checked>";}else{
                                                            echo"<input type='radio' value='3' name='gyvuliai'>";
                                                        } ?>
                                                        <label> MIŠRŪS </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis" value="<?=  $this->main_model->info['txt']['vidurkis'] ?>">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Deklaruotas plotas (ha):</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis" value="<?= $this->main_model->info['txt']['deklaruota'] ?>">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Samdomi darbuotojai:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Banko sąskaita:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Kreditai:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Deklaracijos:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Kiti spec. požymiai:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų turtas:</label>
                                        <div class="col-md-10">
                                            <input name="turtas" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų nuosavybė:</label>
                                        <div class="col-md-10">
                                            <input name="nuosavybe" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų pajamos:</label>
                                        <div class="col-md-10">
                                            <input name="pajamos" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų sąnaudos:</label>
                                        <div class="col-md-10">
                                            <input name="sanaudos" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2"></label>
                                        <div class="col-md-10 col-sm-10">
                                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                                <i class="fa fa-check-circle-o fa-lg"> SUBMIT</i>
                                            </button>
                                        </div>
                                    </div>

                                </fieldset>
                            </form>
                        </div>
                    </div>

                    <div id="augalai" class="tab-pane">
                        <div class="panel-body">
                            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>sutartys/augalai" method="POST">
                                <fieldset>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Bazinė kaina:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Deklaruotas plotas:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis" value="">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Samdomi darbuotojai:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Banko sąskaita:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Kreditai:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Deklaracijos:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Kiti spec. požymiai:</label>
                                        <div class="col-md-10">
                                            <div class="row row-space-12">
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('kiekis'); ?>
                                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_menesis'); ?>
                                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                                </div>
                                                <div class="col-md-4 m-b-15">
                                                    <?php echo form_error('suma_metai'); ?>
                                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų turtas:</label>
                                        <div class="col-md-10">
                                            <input name="turtas" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų nuosavybė:</label>
                                        <div class="col-md-10">
                                            <input name="nuosavybe" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų pajamos:</label>
                                        <div class="col-md-10">
                                            <input name="pajamos" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų sąnaudos:</label>
                                        <div class="col-md-10">
                                            <input name="sanaudos" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2"></label>
                                        <div class="col-md-10 col-sm-10">
                                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                                <i class="fa fa-check-circle-o fa-lg"> SUBMIT</i>
                                            </button>
                                        </div>
                                    </div>

                                </fieldset>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
    </div>
</div>
</div>
