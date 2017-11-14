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
            $dt = $this->session->userdata();

            if($this->main_model->info['error']['login']){
                echo'<div class="alert alert-danger">';
                echo $this->main_model->info['error']['login'];
                echo '</div>';
            }
            ?>

            <form class="form-horizontal form-bordered" action="" id="skaitciuokle" method="POST">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ūkininkas</label>
                        <div class="col-md-10">
                            <?php echo form_error('ukininko_vardas');
                            if($dt['vardas'] == "" AND $dt['pavarde'] == "") { ?>
                                <select name="ukininko_vardas" class="form-control">
                                    <option value="">Pasirinkite...</option>
                                    <?php
                                    foreach ($this->main_model->info['ukininkai'] as $row) {
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
                    <div class="alert alert-info text-center">BAZINĖ KAINA</div>
                    <!-- Pirminiai dokumentai -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Pirminiai dokumentai:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 m-b-15">
                                    <select id="pirminiai" name="pirminiai" class="form-control">
                                        <option value="0">Pasirinkite...</option>
                                        <option value="100">iki 100 įrašų per metus</option>
                                        <option value="250">iki 250 įrašų per metus</option>
                                        <option value="500">iki 500 įrašų per metus</option>
                                        <option value="750">iki 750 įrašų per metus</option>
                                        <option value="1000">virš 1000 įrašų per metus</option>
                                    </select>
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <?php echo form_error('suma_menesis'); ?>
                                    <input type="text" name="pirminiai_menuo" id="pirminiai_menuo" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <?php echo form_error('suma_metai'); ?>
                                    <input type="text" name="pirminiai_metai" id="pirminiai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Darbuotojai -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Samdomi darbuotojai:</label>
                        <div class="col-md-10">
                            <div class="checkbox checkbox-info">
                                <input id="is_darbininkai_2" type="checkbox" name="saskaitu_planas">
                                <label> DARBUOTOJAI</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="inp_darbininkai_2" style="display:none">
                        <label class="col-md-2 control-label"> </label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3 m-b-15">
                                    <input type="text" name="darbuotojai_2_kiekis" id="darbuotojai_2_kiekis" class="form-control" placeholder="Kiekis">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="darbuotojai_2_menesis" id="darbuotojai_2_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="darbuotojai_2_metai" id="darbuotojai_2_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                                <div class="col-md-1 m-b-15">
                                    <div class="checkbox checkbox-info">
                                        <input id="is_darbininkai" type="checkbox" name="darbininkai">
                                        <label> <b>*</b></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="inp_darbininkai" style="display:none">
                        <label class="col-md-2 control-label"> Su vykdomais raštais:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3 m-b-15">
                                    <input type="text" name="darbuotojai_kiekis" id="darbuotojai_kiekis" class="form-control" placeholder="Kiekis">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="darbuotojai_menesis" id="darbuotojai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="darbuotojai_metai" id="darbuotojai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info text-center">GYVULININKYSTĖS KAINA</div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Galvijai (vnt):</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <?php echo form_error('gyvuliai'); ?>
                                <div class="col-md-2 m-b-15">
                                    <div class="radio radio-info radio-inline">
                                        <?php if($this->main_model->info['txt']['banda'] == 2){
                                            echo"<input type='radio' value='2' name='banda' id='banda' checked>";}else{
                                            echo"<input type='radio' value='2' name='banda' id='banda' disabled>";
                                        } ?>
                                        <label> MĖSINIAI </label>
                                    </div>
                                </div>
                                <div class="col-md-2 m-b-15">
                                    <div class="radio radio-info radio-inline">
                                        <?php if($this->main_model->info['txt']['banda'] == 1){
                                            echo"<input type='radio' value='1' name='banda' id='banda' checked>";}else{
                                            echo"<input type='radio' value='1' name='banda' id='banda' disabled>";
                                        } ?>
                                        <label> PIENINIAI </label>
                                    </div>
                                </div>
                                <div class="col-md-2 m-b-15">
                                    <div class="radio radio-info radio-inline">
                                        <?php if($this->main_model->info['txt']['banda'] == 3){
                                            echo"<input type='radio' value='3' name='banda' id='banda' checked>";}else{
                                            echo"<input type='radio' value='3' name='banda' id='banda' disabled>";
                                        } ?>
                                        <label> MIŠRŪS </label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row row-space-12">
                                <div class="col-md-4 m-b-15">
                                    <?php echo form_error('galvijai_kiekis'); ?>
                                    <input type="text" name="galvijai_kiekis" id="galvijai_kiekis" class="form-control" placeholder="Galvijų kiekis"
                                           value="<?=  $this->main_model->info['txt']['vidurkis'] ?>" disabled>
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <?php echo form_error('suma_menesis'); ?>
                                    <input type="text" name="galvijai_menesis" id="galvijai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <?php echo form_error('suma_metai'); ?>
                                    <input type="text" name="galvijai_metai" id="galvijai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Deklaruotas plotas (ha):</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 m-b-15">
                                    <?php echo form_error('dek_plotas'); ?>
                                    <input type="text" name="dek_plotas" id="dek_plotas" class="form-control" placeholder="Kiekis"
                                           value="<?= $this->main_model->info['txt']['deklaruota'] ?>" disabled>
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <?php echo form_error('suma_menesis'); ?>
                                    <input type="text" name="suma_menesis" id="dek_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <?php echo form_error('suma_metai'); ?>
                                    <input type="text" name="suma_metai" id="dek_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info text-center">KITŲ PASLAUGŲ KAINA</div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Banko sąskaitos:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="bankai" id="bankai" class="form-control" placeholder="Sąskaitų kiekis">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="bankai_menesis" id="bankai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="bankai_metai" id="bankai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Kreditai:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="kreditai" id="kreditai" class="form-control" placeholder="Kreditų kiekis">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="kreditai_menesis" id="kreditai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="kreditai_metai" id="kreditai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Deklaracijos:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4 m-b-15">
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
                                    <input type="text" name="kiekis" class="form-control" placeholder="Kiekis">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="suma_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="suma_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"> </label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-2 m-b-15">
                                    <?php echo form_error('europa'); ?>
                                    <div class="checkbox checkbox-info">
                                    <input type="checkbox" value="1" name="europa">
                                    <label> ES PARAMA</label>
                                </div>
                                </div>
                                <div class="col-md-3 m-b-15">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="saskaitu_planas">
                                        <label> SĄSKAITŲ PLANAS</label>
                                    </div>
                                </div>
                                <div class="col-md-3 m-b-15">
                                    <div class="checkbox checkbox-info">
                                        <input id="is_kuras" type="checkbox" name="kuras_tikrinti">
                                        <label>KURO APSKAITA</label>
                                    </div>
                                </div>
                                <div class="col-md-4 m-b-15" id="inp_kuras" style="display:none">
                                    <?php echo form_error('kuras'); ?>
                                    <input type="text" name="kuras" class="form-control" placeholder="Įveskite transporto priemonių skaičių">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

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
                    <hr>
                    <div class="form-group">
                        <label class="col-md-2 control-label"> Viso:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 m-b-15 col-md-offset-4">
                                    <input type="text" name="viso_menesis" id="viso_menesis" class="form-control" placeholder="Viso per menesį">
                                </div>
                                <div class="col-md-4 m-b-15">
                                    <input type="text" name="viso_metai" id="viso_metai" class="form-control" placeholder="Viso per metus">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2"></label>
                        <div class="col-md-10 col-sm-10">
                            <div class="row row-space-12">
                                <div class="col-md-6 m-b-15">
                                    <button class="btn btn-block btn-outline btn-primary" id="skaitciuoti">
                                        <i class="fa fa-check-circle-o fa-lg"> SKAITČIUOTI</i>
                                    </button>
                                </div>
                                <div class="col-md-6 m-b-15">
                                    <button class="btn btn-block btn-outline btn-primary" id="formuoti">
                                        <i class="fa fa-check-circle-o fa-lg"> FORMUOTI</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>
