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

                    <!-- PVM MOKETOJAS -->
                    <div class="form-group ">
                        <label for="pvm_moketojas" class="col-md-2 control-label">PVM mokėtojas:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-6">
                                    <div class="radio radio-info radio-inline">
                                        <input id="pvm_moketojas" type="radio" name="pvm_moketojas" value="2" v-on:click="rodyti_pvm_moketoja = true">
                                        <label> TAIP</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="radio radio-info radio-inline">
                                        <input id="pvm_moketojas" type="radio" name="pvm_moketojas" value="1" v-on:click="rodyti_pvm_moketoja = false" checked>
                                        <label> NE</label>
                                    </div>
                                </div>
                            </div>
                            <div v-if="rodyti_pvm_moketoja">
                                <br>
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
                                    <div class="col-md-4 col-md-offset-4">
                                        <?php echo form_error('suma_menesis'); ?>
                                        <input type="text" name="suma_menesis" id="dek_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <?php echo form_error('suma_metai'); ?>
                                        <input type="text" name="suma_metai" id="dek_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- VEIKLOS RUSYS -->
                    <div class="form-group">
                        <label for="sekcija" class="col-md-2 control-label">Veiklos rūšys:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-12">
                                <select name="sekcija" id="sekcija" v-model="sekcija" v-on:change="gauti_skyriu" class="form-control">
                                    <option value="0">Pasirinkite...</option>
                                    <?php
                                    foreach ($this->main_model->info['evrk_sekcijos'] as $row) {
                                        echo "<option value='$row[sekcija]'>".$row['pavadinimas']."</option>";
                                    }
                                    ?>
                                </select>
                                </div>
                            </div>
                            <div class="row row-space-12" v-if="rodyti_skyrius">
                                <br>
                                <div class="col-md-12">
                                <select id="skyrius" name="skyrius" v-model="skyrius" class="form-control"  v-on:change="gauti_grupe">
                                    <option value="0">Pasirinkite...</option>
                                    <option v-for="org in skyriu_sarasas" :value="org.skyrius">{{ org.pavadinimas }}</option>
                                </select>
                                </div>
                            </div>
                            <div class="row row-space-12" v-if="rodyti_grupe">
                                <br>
                                <div class="col-md-12">
                                <select id="grupe" name="grupe" v-model="grupe" class="form-control" v-on:change="gauti_klase">
                                    <option value="0">Pasirinkite...</option>
                                    <option v-for="org in grupiu_sarasas" :value="org.grupe">{{ org.pavadinimas }}</option>
                                </select>
                                </div>
                            </div>
                            <div class="row row-space-12" v-if="rodyti_klase">
                                <br>
                                <div class="col-md-12">
                                <select id="klase" name="klase" v-model="klase" class="form-control" v-on:change="gauti_poklase">
                                    <option value="0">Pasirinkite...</option>
                                    <option v-for="org in klasiu_sarasas" :value="org.klase">{{ org.pavadinimas }}</option>
                                </select>
                                </div>
                            </div>
                            <div class=" row row-space-12" v-if="rodyti_poklase">
                                <br>
                                <div class="col-md-12">
                                <select id="poklase" name="poklase" v-model="poklase" class="form-control">
                                    <option value="0">Pasirinkite...</option>
                                    <option v-for="org in poklasiu_sarasas" :value="org.poklasis">{{ org.pavadinimas }}</option>
                                </select>
                                </div>
                            </div>
                            <div class="row row-space-12">
                                <hr>
                                <div class="col-md-4 col-md-offset-4">
                                    <?php echo form_error('suma_menesis'); ?>
                                    <input type="text" name="suma_menesis" id="dek_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <?php echo form_error('suma_metai'); ?>
                                    <input type="text" name="suma_metai" id="dek_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- GAUNAMOS SASKAITOS -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Gaunamos sąskaitos:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="number" name="kreditai" id="kreditai" value="" min="0" max="100"  class="form-control" placeholder="Sąskaitų kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_menesis" id="kreditai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_metai" id="kreditai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- ISRASOMOS SAKAITOS -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Išrašomos sąskaitos:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="number" name="kreditai" id="kreditai" value="" min="0" max="100"  class="form-control" placeholder="Sąskaitų kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_menesis" id="kreditai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_metai" id="kreditai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- BANKO SASKAITOS -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Bankai:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="number" name="bankai" id="bankai" value="" min="0" max="100"  class="form-control" placeholder="Sąskaitų kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="bankai_menesis" id="bankai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="bankai_metai" id="bankai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- KREDITAI -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Kreditai:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="number" name="kreditai" id="kreditai" value="" min="0" max="100"  class="form-control" placeholder="Kreditų kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_menesis" id="kreditai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_metai" id="kreditai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- PASKOLOS -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Paskolos:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="number" name="kreditai" id="kreditai" value="" min="0" max="100"  class="form-control" placeholder="Paskolų kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_menesis" id="kreditai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_metai" id="kreditai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- LIZINGAS -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Lizingai:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="number" name="kreditai" id="kreditai" value="" min="0" max="100"  class="form-control" placeholder="Lizingų kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_menesis" id="kreditai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_metai" id="kreditai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- Overdrafo apskaita -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Overdrafto apskaita:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="number" name="kreditai" id="kreditai" value="" min="0" max="100"  class="form-control" placeholder="Kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_menesis" id="kreditai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_metai" id="kreditai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- Faktoringo apskaita -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Faktoringo apskaita:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="number" name="kreditai" id="kreditai" value="" min="0" max="100"  class="form-control" placeholder="Kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_menesis" id="kreditai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_metai" id="kreditai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <!-- Kitu finansavimo budu apskaita -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Kitų finansavimo būdų apskaita:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="number" name="kreditai" id="kreditai" value="" min="0" max="100"  class="form-control" placeholder="Kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_menesis" id="kreditai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kreditai_metai" id="kreditai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- VISO BAZINE KAINA -->
                    <div class="form-group">
                        <label for="bazine_menesis" class="col-md-2 control-label"> Bazinė kaina:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="bazine_menesis" id="bazine_menesis" class="form-control" placeholder="Viso per menesį" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="bazine_metai" id="bazine_metai" class="form-control" placeholder="Viso per metus" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /////////////////////////////////////////////////////////////
                    DARBO UZMOKESCIO APSKAITOS KAINA
                    ////////////////////////////////////////////////////////////// -->
                    <div class="alert alert-info text-center">DARBO UŽMOKESČIO APSKAITOS KAINA</div>
                    <!-- Darbuotojai -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Samdomi darbuotojai:</label>
                        <div class="col-md-10">
                            <div class="checkbox checkbox-info">
                                <input id="darbuotojai" type="checkbox" name="darbuotojai" v-model="darbuotojai" v-on:click="rodyti_darbuotojus = !rodyti_darbuotojus">
                                <label> DARBUOTOJAI</label>
                            </div>
                            <h5>
                                <small>
                                    Į šią kainą įeina darbuotojų darbo užmokesčio skaičiavimas, tabelio pildymas, kitos ataskaitos, išskyrus deklaracijos teikimus.
                                </small>
                            </h5>
                        </div>
                    </div>
                    <!-- Darbuotojai ivesti kieki -->
                    <div class="form-group" v-if="rodyti_darbuotojus">
                        <label class="col-md-2 control-label"> </label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3">
                                    <input type="number" name="darbuotojai_kiekis" v-model="darbuotojai_kiekis" v-on:change="rodyti_deklaracijas" value="" min="0" max="100" id="darbuotojai_kiekis" class="form-control" placeholder="Kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="darbuotojai_menesis" id="darbuotojai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="darbuotojai_metai" id="darbuotojai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                                <div class="col-md-1">
                                    <div class="checkbox checkbox-info">
                                        <input id="darbuotojai2" type="checkbox" name="darbuotojai2" v-model="darbuotojai2" v-on:click="rodyti_darbuotojus2 = !rodyti_darbuotojus2">
                                        <label> <b>*</b></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Darbuotojai "rastai" ivestio kieki -->
                    <div class="form-group"  v-if="rodyti_darbuotojus2">
                        <label class="col-md-2 control-label">Su "raštais":</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3">
                                    <input type="number" name="darbuotojai2_kiekis" v-model="darbuotojai2_kiekis" v-on:change="rodyti_deklaracijas" id="darbuotojai2_kiekis"  value="" min="0" max="100" class="form-control" placeholder="Kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="darbuotojai2_menesis" id="darbuotojai2_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="darbuotojai2_metai" id="darbuotojai2_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FR572 keiciam i GPM313 FR573 keiciam i GPM312 -->
                    <div v-if="darbuotoju_deklaracijos">
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label for="fr572" class="col-md-2 control-label">Formos: </label>
                            <div class="col-md-10">
                                <div class="row row-space-12">
                                    <div class="col-md-2">
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="fr572" id="fr572" checked disabled>
                                            <label> GPM313</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="fr572_menesis" id="fr572_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="fr572_metai" id="fr572_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fr573" class="col-md-2 control-label"></label>
                            <div class="col-md-10">
                                <div class="row row-space-12">
                                    <div class="col-md-2">
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="fr573" id="fr573" checked disabled>
                                            <label> GPM312</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="fr573_menesis" id="fr573_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="fr573_metai" id="fr573_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sam" class="col-md-2 control-label">Pranešimai:</label>
                            <div class="col-md-10">
                                <div class="row row-space-12">
                                    <div class="col-md-2">
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="sam" id="sam" checked disabled>
                                            <label> SAM</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="sam_kiekis" id="sam_kiekis" class="form-control" placeholder="SAM kiekis (vnt)">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="sam_menesis" id="sam_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="sam_metai" id="sam_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sd" class="col-md-2 control-label"> </label>
                            <div class="col-md-10">
                                <div class="row row-space-12">
                                    <div class="col-md-2">
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="sd" id="sd" checked disabled>
                                            <label> SD</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="sd_kiekis" id="sd_kiekis" class="form-control" placeholder="SD kiekis (vnt)">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="sd_menesis" id="sd_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="sd_metai" id="sd_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sd" class="col-md-2 control-label"> </label>
                            <div class="col-md-10">
                                <div class="row row-space-12">
                                    <div class="col-md-2">
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="sd" id="sd" checked disabled>
                                            <label> Ne SD</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="sd_kiekis" id="sd_kiekis" class="form-control" placeholder="Ne SD kiekis (vnt)">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="sd_menesis" id="sd_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="sd_metai" id="sd_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sd" class="col-md-2 control-label"> </label>
                            <div class="col-md-10">
                                <div class="row row-space-12">
                                    <div class="col-md-2">
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="sd" id="sd" checked disabled>
                                            <label> Kiti SD atvejai</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="sd_kiekis" id="sd_kiekis" class="form-control" placeholder="Kiti SD atvejų kiekis (vnt)">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="sd_menesis" id="sd_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="sd_metai" id="sd_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- VISO darbo uzmokescio apskaitos KAINA -->
                    <div class="form-group">
                        <label for="uzmokestis_menesis" class="col-md-2 control-label"> D. užmokesčio apskaitos kaina:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="uzmokestis_menesis" id="uzmokestis_menesis" class="form-control" placeholder="Viso per menesį" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="uzmokestis_metai" id="uzmokestis_metai" class="form-control" placeholder="Viso per metus" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <! -- /////////////////////////////////////////////////////////
                    DEKLARACIJOS
                    /////////////////////////////////////////////////////////// -->
                    <div class="alert alert-info text-center">DEKLARACIJOS</div>
                    <!-- PVM -->
                    <div class="form-group">
                        <label for="pvm_x12" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="pvm" id="pvm" v-model="pvm" v-on:click="rodyti_pvm = !rodyti_pvm">
                                        <label> PRIDĖTINĖS VERTĖS MOKESČIO ( PVM )</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_pvm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x12_menesis" id="pvm_x12_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x12_metai" id="pvm_x12_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- GPM -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> GYVENTOJŲ PAJAMŲ MOKESČIO ( GPM )</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GPM -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> ATSISKAITYMAI NUO PAJAMŲ PAGAL LR KELIŲ PRIEŽIŪROS IR PLĖTROS FINANSAVIMO ĮSTATYMĄ</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GPM -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> ATSISKAITYMAI NUO PAJAMŲ PAGAL LR MIŠKŲ ĮSTATYMĄ</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GPM -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> MOKESTIS UŽ APLINKOS TERŠIMĄ</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GPM -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> PELNO MOKESTIS</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GPM -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> NEKILNOJAMO TURTO MOKESTIS</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GPM -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> SOCIALINIS MOKESTIS</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GPM -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> ŽEMĖS MOKESTIS</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="kitos_paslaugos" id="kitos_paslaugos">
                                        <label for="kitos_paslaugos"> KITI MOKESČIAI</label>
                                    </div>
                                </div>
                                <div id="inp_kitos_paslaugos" style="display:none">
                                    <div class="col-md-3">
                                        <input type="text" name="kitos_paslaugos_kiekis" value="0" min="0" max="100" id="kitos_paslaugos_kiekis" class="form-control" placeholder="Kitos paslaugos (vnt)">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="kitos_paslaugos_menesis" id="kitos_paslaugos_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="kitos_paslaugos_metai" id="kitos_paslaugos_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <textarea class="form-control" rows="3" name="kitos_paslaugos_komentaras" id="kitos_paslaugos_komentaras"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- VISO  KAINA -->
                    <div class="form-group">
                        <label for="uzmokestis_menesis" class="col-md-2 control-label"> Deklaracijų kaina:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="uzmokestis_menesis" id="uzmokestis_menesis" class="form-control" placeholder="Viso per menesį" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="uzmokestis_metai" id="uzmokestis_metai" class="form-control" placeholder="Viso per metus" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <! -- /////////////////////////////////////////////////////////
                    KASOS OPERACIJU REGISTRAVIMAS
                    /////////////////////////////////////////////////////////// -->
                    <div class="alert alert-info text-center">KASOS OPERACIJŲ REGISTRAVIMAS</div>

                    <!-- Grynuju pinigu apskaita -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> GRYNŲJŲ PINIGŲ APSKAITA</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- kasos knygos pildymas -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> KASOS KNYGOS PILDYMAS</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Avanso apyskaita -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> AVANSO APYSKAITA</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Kitos operacijos -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-6">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm" id="gpm"  v-model="gpm" v-on:click="rodyti_gpm = !rodyti_gpm">
                                        <label> KITŲ OPERACIJŲ SUSIJUSIŲ SU KASOS DARBU ATLIKIMAS</label>
                                    </div>
                                </div>
                                <div v-if="rodyti_gpm">
                                    <div class="col-md-2">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- VISO  KAINA -->
                    <div class="form-group">
                        <label for="uzmokestis_menesis" class="col-md-2 control-label"> Kasos operacijų kaina:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="uzmokestis_menesis" id="uzmokestis_menesis" class="form-control" placeholder="Viso per menesį" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="uzmokestis_metai" id="uzmokestis_metai" class="form-control" placeholder="Viso per metus" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <! -- /////////////////////////////////////////////////////////
                    PROGRAMINES IRANGOS NUOMOS MOKESTIS
                    /////////////////////////////////////////////////////////// -->
                    <div class="alert alert-info text-center">PROGRAMINĖS ĮRANGOS NUOMOS MOKESTIS</div>

                    ...

                    <!-- VISO  KAINA -->
                    <div class="form-group">
                        <label for="uzmokestis_menesis" class="col-md-2 control-label"> Programinės įrangos nuomos kaina:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="uzmokestis_menesis" id="uzmokestis_menesis" class="form-control" placeholder="Viso per menesį" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="uzmokestis_metai" id="uzmokestis_metai" class="form-control" placeholder="Viso per metus" disabled>
                                </div>
                            </div>
                        </div>
                    </div>


                    <! -- /////////////////////////////////////////////////////////
                    ILGALAIKIO TURTO REGISTRAVIMAS
                    /////////////////////////////////////////////////////////// -->
                    <div class="alert alert-info text-center">ILGALAIKIO TURTO REGISTRAVIMAS</div>

                    <!-- Ilgalaikis turtas -->
                    <div class="form-group">
                        <label for="zemes_mokestis" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                        <label> ILGALAIKIO TURTO VIENETAI</label>
                                    </div>
                                </div>
                                <div id="inp_zemes">
                                    <div class="col-md-3">
                                        <input type="number" name="zemes_kiekis" value="" min="0" max="100" id="zemes_kiekis" class="form-control" placeholder="Kiekis (vnt)">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="zemes_menesis" id="zemes_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="zemes_metai" id="zemes_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nusidevejimo skaiciavimas -->
                    <div class="form-group">
                        <label for="zemes_mokestis" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                        <label> NUSIDĖVĖJIMO SKAIČIAVIMAS</label>
                                    </div>
                                </div>
                                <div id="inp_zemes">
                                    <div class="col-md-3">
                                        <input type="number" name="zemes_kiekis" value="" min="0" max="100" id="zemes_kiekis" class="form-control" placeholder="Kiekis (vnt)">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="zemes_menesis" id="zemes_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="zemes_metai" id="zemes_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nebaigtos statybos apskaita -->
                    <div class="form-group">
                        <label for="zemes_mokestis" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                        <label> NEBAIGTOS STATYBOS APSKAITA</label>
                                    </div>
                                </div>
                                <div id="inp_zemes">
                                    <div class="col-md-3">
                                        <input type="number" name="zemes_kiekis" value="" min="0" max="100" id="zemes_kiekis" class="form-control" placeholder="Kiekis (vnt)">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="zemes_menesis" id="zemes_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="zemes_metai" id="zemes_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Insvesticinio turto apskaita -->
                    <div class="form-group">
                        <label for="zemes_mokestis" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                        <label> INVESTICINIO TURTO APSKAITA</label>
                                    </div>
                                </div>
                                <div id="inp_zemes">
                                    <div class="col-md-3">
                                        <input type="number" name="zemes_kiekis" value="" min="0" max="100" id="zemes_kiekis" class="form-control" placeholder="Kiekis (vnt)">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="zemes_menesis" id="zemes_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="zemes_metai" id="zemes_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ilgalaiko turt pardavimas pirkimas nurasymas .... -->
                    <div class="form-group">
                        <label for="zemes_mokestis" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-6">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                        <label> ILGALAIKIO TURTO PARDAVIMO / PIRKIMO / NURAŠYMO / NETEKIMO ATVEJAI</label>
                                    </div>
                                </div>
                                <div id="inp_zemes">
                                    <div class="col-md-2">
                                        <input type="number" name="zemes_kiekis" value="" min="0" max="100" id="zemes_kiekis" class="form-control" placeholder="Kiekis (vnt)">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="zemes_menesis" id="zemes_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="zemes_metai" id="zemes_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ilgalaikio turto perkainavimas, vertes didinimas, nusidevejimo laiko ilginimas -->
                    <div class="form-group">
                        <label for="zemes_mokestis" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-6">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                        <label> ILGALAIKIO TURTO PERKAINAVIMAS, VERTĖS DIDINIMAS, NUSIDĖVĖJIMO LAIKO ILGINIMAS</label>
                                    </div>
                                </div>
                                <div id="inp_zemes">
                                    <div class="col-md-2">
                                        <input type="number" name="zemes_kiekis" value="" min="0" max="100" id="zemes_kiekis" class="form-control" placeholder="Kiekis (vnt)">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="zemes_menesis" id="zemes_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="zemes_metai" id="zemes_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kitos su ilgalaikiu turtu susijusios  nestandartines operacijos -->
                    <div class="form-group">
                        <label for="zemes_mokestis" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-6">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                        <label> KITOS SU ILGALIKIU TURTU SUSIJUSIOS NESTANDARTINĖS OPERACIJOS</label>
                                    </div>
                                </div>
                                <div id="inp_zemes">
                                    <div class="col-md-2">
                                        <input type="number" name="zemes_kiekis" value="" min="0" max="100" id="zemes_kiekis" class="form-control" placeholder="Kiekis (vnt)">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="zemes_menesis" id="zemes_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="zemes_metai" id="zemes_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- VISO  KAINA -->
                    <div class="form-group">
                        <label for="uzmokestis_menesis" class="col-md-2 control-label"> Ilgalaikio turto kaina:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="uzmokestis_menesis" id="uzmokestis_menesis" class="form-control" placeholder="Viso per menesį" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="uzmokestis_metai" id="uzmokestis_metai" class="form-control" placeholder="Viso per metus" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <! -- /////////////////////////////////////////////////////////
                    ATASKAITU PARUOSIMAS
                    /////////////////////////////////////////////////////////// -->
                    <div class="alert alert-info text-center">ATASKAITŲ PARUOŠIMAS</div>

                    <div class="form-group">
                        <label for="zemes_mokestis" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-6">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                        <label> BALANSAS</label>
                                    </div>
                                    <div class="col-md- col-md-offset-1">
                                        <hr>
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                            <label> KETVIRTINIS</label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                            <label> PUSMETINIS</label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                            <label> METINIS</label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                            <label> TARPINIS</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                        <label> PELNO / NUOSTOLIO ATASKAITA</label>
                                    </div>
                                    <div class="col-md- col-md-offset-1">
                                        <hr>
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                            <label> KETVIRTINĖ</label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                            <label> PUSMETINĖ</label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                            <label> METINĖ</label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                            <label> TARPINĖ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- VISO  KAINA -->
                    <div class="form-group">
                        <label for="uzmokestis_menesis" class="col-md-2 control-label"> Ataskaitų paruošimo kaina:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="uzmokestis_menesis" id="uzmokestis_menesis" class="form-control" placeholder="Viso per menesį" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="uzmokestis_metai" id="uzmokestis_metai" class="form-control" placeholder="Viso per metus" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <! -- /////////////////////////////////////////////////////////
                    DEBITORIU IR KREDITORIU ISISKOLINIMO KONTROLE
                    /////////////////////////////////////////////////////////// -->
                    <div class="alert alert-info text-center">DEBITORIŲ IR KREDITORIŲ ĮSISKOLINIMO KONTROLĖ</div>

                    ...

                    <!-- VISO  KAINA -->
                    <div class="form-group">
                        <label for="uzmokestis_menesis" class="col-md-2 control-label"> Debitorių ir kreditorių įsiskolininmo kaina:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="uzmokestis_menesis" id="uzmokestis_menesis" class="form-control" placeholder="Viso per menesį" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="uzmokestis_metai" id="uzmokestis_metai" class="form-control" placeholder="Viso per metus" disabled>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php //var_dump($this->sutartys_model->EVRK_poklase("01.13"));
                    ?>

                    <hr>
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
