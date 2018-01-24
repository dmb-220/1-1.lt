<div class="wrapper wrapper-content">
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
                    //isvedamos klaidos
                    foreach ($this->main_model->info['error'] as $klaida){
                        echo'<div class="alert alert-danger">';
                        echo $klaida;
                        echo '</div>';
                    }
                    ?>
                    <div class="form-group">
                        <label for="vardas" class="col-md-2 control-label">Ūkininkas:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-6">
                                    <?php echo form_error('vardas'); ?>
                                    <input type="text" name="vardas" class="form-control" placeholder="Vardas" value="<?php echo $this->main_model->info['ukininkas'][0]['vardas']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <?php echo form_error('pavarde'); ?>
                                    <input type="text" name="pavarde" class="form-control" placeholder="Pavardė"  value="<?php echo $this->main_model->info['ukininkas'][0]['pavarde']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="vic_lt" class="col-md-2 control-label">VIC.LT vartotojas:</label>
                        <div class="col-md-10">
                            <div class="checkbox checkbox-info">
                                <input id="vic_lt" type="checkbox" value="1" name="vic_lt" <?php echo set_checkbox('vic_lt', '1', !$this->main_model->info['ukininkas'][0]['viclt']); ?>/>
                                <label> AR TURITE PRIEIGĄ PRIE VIC.LT?</label>
                            </div>
                            <h5>
                                <small>
                                    Pažymėkitę varnelę, ir galėsite suvesti, VIC.LT  prisijungimo duomenis. Jie reikalingi gauti duomanis apie laikomus galvijus ir / arba  deklaruojamus plotus.
                                </small>
                            </h5>
                        </div>
                    </div>
                    <div class="form-group" id="in_vic_lt" style="display:none">
                        <label class="col-md-2 control-label"> </label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-6">
                                    <?php echo form_error('v_vardas'); ?>
                                    <input type="text" name="v_vardas" id="v_vardas" class="form-control" placeholder="Vartotojo vardas" value="<?= $this->main_model->info['ukininkas'][0]['VIC_vartotojo_vardas'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <?php echo form_error('slaptazodis'); ?>
                                    <input type="text" name="slaptazodis" id="slaptazodis" class="form-control" placeholder="Slaptažodis" value="<?= $this->main_model->info['ukininkas'][0]['VIC_slaptazodis'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ūkio tipas:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <?php echo form_error('tipas'); ?>
                                <div class="col-md-3">
                                    <?php
                                    //nustatom kuri ukio tipa pazymetu
                                    $true1 = 0; $true2 = 0; $true3 = 0; $true4 = 0;
                                    if($this->main_model->info['ukininkas'][0]['ukio_tipas'] == 0){$true1 = TRUE;}
                                    if($this->main_model->info['ukininkas'][0]['ukio_tipas'] == 1){$true2 = TRUE;}
                                    if($this->main_model->info['ukininkas'][0]['ukio_tipas'] == 2){$true2 = TRUE;}
                                    if($this->main_model->info['ukininkas'][0]['ukio_tipas'] == 3){$true2 = TRUE;}
                                    ?>
                                    <div class="radio radio-info radio-inline">
                                        <input type='radio' value='0' name='tipas' <?php echo  set_radio('tipas', '0', $true1 ); ?>/>
                                        <label> GYVULININKYSTĖ </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="radio radio-info radio-inline">
                                        <input type='radio' value='1' name='tipas' id="tipas" <?php echo  set_radio('tipas', '1', $true2) ?>/>
                                        <label> AUGALININKYSTĖ </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="radio radio-info radio-inline">
                                        <input type='radio' value='2' name='tipas' id="tipas" <?php echo  set_radio('tipas', '2', $true3); ?>/>
                                        <label> ŽUVININKYSTĖ </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="radio radio-info radio-inline">
                                        <input type='radio' value='3' name='tipas' id="tipas" <?php echo  set_radio('tipas', '3', $true4); ?>/>
                                        <label> MIŠKININKYSTĖ </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="in_galviju_banda" style="display:none">
                        <label class="col-md-2 control-label">Galvijų banda:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <?php echo form_error('banda'); ?>
                                <div class="col-md-4">
                                    <div class="radio radio-info radio-inline">
                                        <?php if($this->main_model->info['txt']['banda'] == 2){
                                            echo"<input type='radio' value='2' name='banda' checked>";}else{
                                            echo"<input type='radio' value='2' name='banda'>";
                                        } ?>
                                        <label> MĖSINIAI </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="radio radio-info radio-inline">
                                        <?php if($this->main_model->info['txt']['banda'] == 1){
                                            echo"<input type='radio' value='1' name='banda' checked>";}else{
                                            echo"<input type='radio' value='1' name='banda'>";
                                        } ?>
                                        <label> PIENINIAI </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                    <hr>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Asmens kodas:</label>
                        <div class="col-md-10">
                            <?php echo form_error('asmens_kodas'); ?>
                            <input name="asmens_kodas" type="text" class="form-control" placeholder="Asmens kodas" value="<?= $this->main_model->info['ukininkas'][0]['asmens_kodas'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">PVM kodas:</label>
                        <div class="col-md-10">
                            <?php echo form_error('pvm'); ?>
                            <input name="pvm" type="text" class="form-control" placeholder="PVM kodas" value="<?= $this->main_model->info['ukininkas'][0]['pvm_kodas'] ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Adresas:</label>
                        <div class="col-md-10">
                            <?php echo form_error('adresas'); ?>
                            <textarea class="form-control" name="adresas"  rows="3" placeholder="Adresas"><?= $this->main_model->info['ukininkas'][0]['adresas'] ?></textarea>
                        </div>
                    </div>

                    <div id="ajax">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Sąskaitos numeris:</label>
                        <div class="col-md-10">
                            <?php echo form_error('numeris'); ?>
                            <input name="numeris" type="text" class="form-control" placeholder="Sąskaitos numeris:" value="<?= $this->main_model->info['ukininkas'][0]['saskaitos_nr'] ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Banko pavadinimas:</label>
                        <div class="col-md-10">
                            <?php echo form_error('bankas'); ?>
                            <input name="bankas" type="text" class="form-control" placeholder="Banko pavadinimas" value="<?= $this->main_model->info['ukininkas'][0]['bankas'] ?>" />
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">El. paštas:</label>
                        <div class="col-md-10">
                            <?php echo form_error('email'); ?>
                            <input name="email" type="email" class="form-control" placeholder="El. paštas" value="<?= $this->main_model->info['ukininkas'][0]['email'] ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Telefono numeris</label>
                        <div class="col-md-10">
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
