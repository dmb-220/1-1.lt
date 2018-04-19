<div class="wrapper wrapper-content" id="skaitciuokle_JA">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Skaičiuoklė juridiniams asmenims</h5>
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
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>sutartys/formuoti_JA" id="skaitciuokle_JA" method="POST">
                <fieldset>
                    <div class="form-group">
                        <label for="ukininkas" class="col-md-2 control-label">Juridinis asmuo:</label>
                        <div class="col-md-8">
                            <?php echo form_error('ukininkas'); ?>
                                <select name="ukininkas" id="ukininkas" class="form-control">
                                    <option value="">Pasirinkite...</option>
                                    <?php
                                    foreach ($this->main_model->info['juridinis_asmuo'] as $row) {
                                        if($dt['nr'] == $row) {
                                            echo "<option value='$row' selected>".$row."</option>";}else {
                                            echo "<option value='$row'>" . $row . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-block btn-outline btn-primary" id="pasirinkti_ja" type="button">
                                <i class="fa fa-check-circle-o fa-lg"> PASIRINKTI</i>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="sut_nr" class="col-md-2 control-label">Sutarties numeris:</label>
                        <div class="col-md-10">
                            <input type="text" name="sut_nr" id="sut_nr" class="form-control" value="<?= $this->main_model->info['txt']['numeris'] ?>" disabled>
                        </div>
                    </div>

                    <!-- /////////////////////////////////////////////////////////////
                    BAZINE KAINA
                    /////////////////////////////////////////////////////////////// -->
                    <div class="alert alert-info text-center">BAZINĖ KAINA</div>
                    <!-- Pirminiai dokumentai -->
                    <div class="form-group">
                        <label for="pvm_moketojas" class="col-md-2 control-label">PVM mokėtojas:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-2">
                                    <div class="radio radio-info radio-inline">
                                        <input id="pvm_moketojas" type="radio" name="pvm_moketojas" value="1" v-on:click="rodyti_pvm_moketoja = false" checked>
                                        <label> NE</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="radio radio-info radio-inline">
                                        <input id="pvm_moketojas" type="radio" name="pvm_moketojas" value="2" v-on:click="rodyti_pvm_moketoja = true">
                                        <label> TAIP</label>
                                    </div>
                                </div>
                            </div>

                            <div v-if="rodyti_pvm_moketoja">
                                <hr>
                                <div class="row row-space-12">
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-info">
                                            <input id="atvirkstinis_pvm" type="checkbox" name="atvirkstinis_pvm">
                                            <label> ATVIRKŠTINIS PVM</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-info">
                                            <input id="es_pvm" type="checkbox" name="es_pvm">
                                            <label> ES PVM</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space-12">
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-info">
                                            <input id="trikampe_prekyba" type="checkbox" name="trikampe_prekyba">
                                            <label>TRIKAMPĖ PREKYBA</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-info">
                                            <input id="kiti_pvm_atvejai" type="checkbox" name="kiti_pvm_atvejai">
                                            <label> KITI IŠSKIRTINIAI PVM ATVEJAI</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space-12">
                                    <hr>
                                    <div class="col-md-6">
                                        <?php echo form_error('suma_menesis'); ?>
                                        <input type="text" name="suma_menesis" id="dek_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo form_error('suma_metai'); ?>
                                        <input type="text" name="suma_metai" id="dek_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Veiklos rūšys:</label>
                        <div class="col-md-10">
                            <select name="sekcija" id="sekcija" v-model="sekcija" v-on:change="gauti_skyriu" class="form-control">
                                <?php
                                foreach ($this->main_model->info['evrk_sekcijos'] as $row) {
                                    echo "<option value='$row[sekcija]'>".$row['pavadinimas']."</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <select id="skyrius" name="skyrius" v-model="skyrius" class="form-control" v-if="rodyti_skyrius">
                                <option v-for="org in skyriu_sarasas" :value="org.skyrius">{{ org.pavadinimas }}</option>
                            </select>
                        </div>
                    </div>

                    <?php var_dump($this->sutartys_model->EVRK_grupe("03")); ?>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2"></label>
                        <div class="col-md-10 col-sm-10">
                            <div class="row row-space-12">
                                <div class="col-md-6">
                                    <button class="btn btn-block btn-outline btn-primary" id="skaitciuoti">
                                        <i class="fa fa-check-circle-o fa-lg"> SKAIČIUOTI</i>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-block btn-outline btn-primary">
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
