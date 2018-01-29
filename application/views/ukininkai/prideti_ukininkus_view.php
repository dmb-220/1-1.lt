<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Užregistruoti naują ūkininką</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>ukininkai/prideti_ukininka" method="POST">
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
                                    <input type="text" name="vardas" class="form-control" placeholder="Vardas" value="<?php echo set_value('vardas'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <?php echo form_error('pavarde'); ?>
                                    <input type="text" name="pavarde" class="form-control" placeholder="Pavardė"  value="<?php echo set_value('pavarde'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="vic_lt" class="col-md-2 control-label">VIC.LT vartotojas:</label>
                        <div class="col-md-10">
                            <div class="checkbox checkbox-info">
                                <input id="vic_lt" type="checkbox" value="1" name="vic_lt" <?php echo set_checkbox('vic_lt', '1'); ?>/>
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
                                    <input type="text" name="v_vardas" id="v_vardas" class="form-control" placeholder="Vartotojo vardas" value="<?php echo set_value('v_vardas'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <?php echo form_error('slaptazodis'); ?>
                                    <input type="text" name="slaptazodis" id="slaptazodis" class="form-control" placeholder="Slaptažodis" value="<?php echo set_value('slaptazodis'); ?>">
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
                                    <div class="radio radio-info radio-inline">
                                        <input type='radio' value='0' name='tipas' <?php echo  set_radio('tipas', '0'); ?>/>
                                        <label> GYVULININKYSTĖ </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="radio radio-info radio-inline">
                                        <input type='radio' value='1' name='tipas' id="tipas" <?php echo  set_radio('tipas', '1'); ?>/>
                                        <label> AUGALININKYSTĖ </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="radio radio-info radio-inline">
                                        <input type='radio' value='2' name='tipas' id="tipas" <?php echo  set_radio('tipas', '2'); ?>/>
                                        <label> ŽUVININKYSTĖ </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="radio radio-info radio-inline">
                                        <input type='radio' value='3' name='tipas' id="tipas" <?php echo  set_radio('tipas', '3'); ?>/>
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
                                        <input type='radio' value='2' name='banda' <?php echo  set_radio('banda', '2'); ?>/>
                                        <label> MĖSINIAI </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="radio radio-info radio-inline">
                                        <input type='radio' value='1' name='banda' <?php echo  set_radio('banda', '1'); ?>/>
                                        <label> PIENINIAI </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="radio radio-info radio-inline">
                                        <input type='radio' value='3' name='banda' <?php echo  set_radio('banda', '3'); ?>/>
                                        <label> MIŠRŪS </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="papildomi" class="col-md-2 control-label">Asmeniniai duomenys:</label>
                        <div class="col-md-10">
                            <div class="checkbox checkbox-info">
                                <input id="papildomi" type="checkbox" value="1" name="papildomi" <?php echo set_checkbox('papildomi', '1'); ?>/>
                                <label> NORITE IŠKART SUVESTI PAPILDOMUS DUOMENIS?</label>
                            </div>
                            <h5>
                                <small>
                                    Pažymėkitę varnelę, ir galėsite suvesti, asmeninius ūkininko duomenis: asmens kodas, adresas, banko saskaita, el. paštas, telefonas. Galite dabar ir nepildyti,
                                    užpildysite veliau eidami "ŪKININKŲ SĄRAŠAS" ten pasirinkę ūkininką.
                                </small>
                            </h5>
                        </div>
                    </div>

                    <div id="in_papildomi" style="display:none">
                        <hr>
                        <div class="form-group">
                            <label for="asmens_kodas" class="col-md-2 control-label">Asmens kodas:</label>
                            <div class="col-md-10">
                                <?php echo form_error('asmens_kodas'); ?>
                                <input name="asmens_kodas" type="text" class="form-control" placeholder="Asmens kodas" value="<?php echo set_value('asmens_kodas'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pvm" class="col-md-2 control-label">PVM kodas:</label>
                            <div class="col-md-10">
                                <?php echo form_error('pvm'); ?>
                                <input name="pvm" type="text" class="form-control" placeholder="PVM kodas">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="adresas" class="col-md-2 control-label">Adresas:</label>
                            <div class="col-md-10">
                                <?php echo form_error('adresas'); ?>
                                <textarea class="form-control" name="adresas"  rows="3" placeholder="Adresas"><?php echo set_value('adresas'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="numeris" class="col-md-2 control-label">Sąskaitos numeris:</label>
                            <div class="col-md-10">
                                <?php echo form_error('numeris'); ?>
                                <input name="numeris" type="text" class="form-control" placeholder="Sąskaitos numeris" value="<?php echo set_value('numeris'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bankas" class="col-md-2 control-label">Banko pavadinimas:</label>
                            <div class="col-md-10">
                                <?php echo form_error('bankas'); ?>
                                <input name="bankas" type="text" class="form-control" placeholder="Banko pavadinimas" value="<?php echo set_value('bankas'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-2 control-label">El. paštas:</label>
                            <div class="col-md-10">
                                <?php echo form_error('email'); ?>
                                <input name="email" type="email" class="form-control" placeholder="El. paštas" value="<?php echo set_value('email'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telefonas" class="col-md-2 control-label">Telefono numeris</label>
                            <div class="col-md-10">
                                <?php echo form_error('telefonas'); ?>
                                <input name="telefonas" type="text" class="form-control" placeholder="Telefono numeris" value="<?php echo set_value('telefonas'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2"></label>
                        <div class="col-md-10 col-sm-10">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> UŽREGISTRUOTI NAUJĄ ŪKININKĄ</i>
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