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
            //var_dump($this->main_model->info['ukininkas']);
            ?>
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>ukininkai/redaguoti/<?= $this->uri->segment(3) ?>" method="POST">
                <fieldset>
                    <?php
                    if($this->main_model->info['error']['nerasta']){
                        echo'<div class="alert alert-danger">';
                        echo $this->main_model->info['error']['nerasta'];
                        echo '</div>';
                    }
                    if($this->main_model->info['error']['ok']) {
                        echo '<div class="alert alert-danger">';
                        echo $this->main_model->info['error']['ok'];
                        echo '</div>';
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Ūkininkas:</label>
                        <div class="col-md-6">
                            <div class="row row-space-10">
                                <div class="col-md-6 m-b-15">
                                    <?php echo form_error('vardas'); ?>
                                    <input type="text" name="vardas" class="form-control" placeholder="Vardas" value="<?= $this->main_model->info['ukininkas'][0]['vardas'] ?>">
                                </div>
                                <div class="col-md-6 m-b-15">
                                    <?php echo form_error('pavarde'); ?>
                                    <input type="text" name="pavarde" class="form-control" placeholder="Pavardė" value="<?= $this->main_model->info['ukininkas'][0]['pavarde'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">VIC.LT prisijungimas:</label>
                    <div class="col-md-6">
                        <div class="row row-space-10">
                            <div class="col-md-6 m-b-15">
                                <?php echo form_error('vartotojas'); ?>
                                <input type="text" name="vartotojas" class="form-control" placeholder="Vartotojo vardas" value="<?= $this->main_model->info['ukininkas'][0]['VIC_vartotojo_vardas'] ?>">
                            </div>
                            <div class="col-md-6 m-b-15">
                                <?php echo form_error('slaptazodis'); ?>
                                <input type="text" name="slaptazodis" class="form-control" placeholder="Slaptažodis" value="<?= $this->main_model->info['ukininkas'][0]['VIC_slaptazodis'] ?>">
                            </div>
                        </div>
                    </div>
        </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Asmens kodas:</label>
                        <div class="col-md-6">
                            <?php echo form_error('asmens_kodas'); ?>
                            <input name="asmens_kodas" type="text" class="form-control" placeholder="Asmens kodas" value="<?= $this->main_model->info['ukininkas'][0]['asmens_kodas'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">PVM kodas:</label>
                        <div class="col-md-6">
                            <?php echo form_error('pvm'); ?>
                            <input name="pvm" type="text" class="form-control" placeholder="PVM kodas" value="<?= $this->main_model->info['ukininkas'][0]['pvm_kodas'] ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Adresas:</label>
                        <div class="col-md-6">
                            <?php echo form_error('adresas'); ?>
                            <textarea class="form-control" name="adresas"  rows="3" placeholder="Adresas"><?= $this->main_model->info['ukininkas'][0]['adresas'] ?></textarea>
                        </div>

                    </div>
                    <div id="ajax">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Sąskaitos numeris:</label>
                        <div class="col-md-6">
                            <?php echo form_error('numeris'); ?>
                            <input name="numeris" @change="get_bankas" v-model="numeris" type="text" class="form-control" placeholder="Sąskaitos numeris:" value="<?= $this->main_model->info['ukininkas'][0]['saskaitos_nr'] ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Banko pavadinimas:</label>
                        <div class="col-md-6">
                            <?php echo form_error('bankas'); ?>
                            <input name="bankas" type="text" class="form-control" placeholder="<?= $this->main_model->info['ukininkas'][0]['bankas'] ?>" value="{{ repos }}" />
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">El. paštas:</label>
                        <div class="col-md-6">
                            <?php echo form_error('email'); ?>
                            <input name="email" type="email" class="form-control" placeholder="El. paštas" value="<?= $this->main_model->info['ukininkas'][0]['email'] ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Telefono numeris</label>
                        <div class="col-md-6">
                            <?php echo form_error('telefonas'); ?>
                            <input name="telefonas" type="text" class="form-control" value="<?= $this->main_model->info['ukininkas'][0]['telefonas'] ?>" placeholder="Telefono numeris" />
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
