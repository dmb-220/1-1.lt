<div class="wrapper wrapper-content">
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
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>sutartys/formuoti" id="skaitciuokle" method="POST">
                <fieldset>
                    <div class="form-group">
                        <label for="ukininkas" class="col-md-2 control-label">Ūkininkas:</label>
                        <div class="col-md-8">
                            <?php echo form_error('ukininkas'); ?>
                                <select name="ukininkas" id="ukininkas" class="form-control">
                                    <option value="">Pasirinkite...</option>
                                    <?php
                                    foreach ($this->main_model->info['ukininkai'] as $row) {
                                        if($dt['nr'] == $row['valdos_nr']) {
                                            echo "<option value='$row[valdos_nr]' selected>".$row['vardas']." ".$row['pavarde']."</option>";}else {
                                            echo "<option value='$row[valdos_nr]'>" . $row['vardas'] . " " . $row['pavarde'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-block btn-outline btn-primary" id="pasirinkti_ukininka">
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
                        <label for="pirminiai" class="col-md-2 control-label">Pirminiai dokumentai:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="text" name="pirminiai" id="pirminiai" class="form-control" placeholder="Dokumentų kiekis">
                                </div>
                                <div class="col-md-4">
                                    <?php echo form_error('suma_menesis'); ?>
                                    <input type="text" name="pirminiai_menuo" id="pirminiai_menuo" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <?php echo form_error('suma_metai'); ?>
                                    <input type="text" name="pirminiai_metai" id="pirminiai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                            <h5>
                                <small>
                                    Pagal įrašų skaičių nustatoma kaina. Vienas įrašas neapsiriboja sąskaitos įvedimu. Į įrašų skaičių patenka nurašymai, pajamavimas, kiti tarpiniai įrašai,
                                    reikalingi teisingos buhalterijos tvarkymui.
                                </small>
                            </h5>
                        </div>
                    </div>
                    <!-- Inventorizacija metine -->
                    <div class="form-group">
                        <label for="inventorizacija" class="col-md-2 control-label">Metinė inventorizacija:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="text" name="inventorizacija_kiekis" id="inventorizacija_kiekis" class="form-control" placeholder="Įrašų skaičius (vnt)">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="inventorizacija_menesis" id="inventorizacija_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="inventorizacija_metai" id="inventorizacija_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                                </div>
                        </div>
                    </div>
                    <!-- BANKO SASKAITOS -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Banko sąskaitos:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="number" name="bankai" id="bankai" value="0" min="0" max="100"  class="form-control" placeholder="Sąskaitų kiekis">
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
                    <!-- KREDITAI -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Kreditai:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="number" name="kreditai" id="kreditai" value="0" min="0" max="100"  class="form-control" placeholder="Kreditų kiekis">
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
                    <!-- SASKAITU PLANAS -->
                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="saskaita" id="saskaita">
                                        <label for="saskaita"> SĄSKAITŲ PLANAS</label>
                                    </div>
                                </div>
                                <div id="inp_saskaita" style="display:none">
                                    <div class="col-md-4">
                                        <input type="text" name="saskaita_menesis" id="saskaita_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="saskaita_metai" id="saskaita_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                            <h5>
                                <small>
                                    2018-01-01 pasikeitus ūkininkų sąskaitų planui, neišvengiamai turi būti buhalterijos pervedimas prie naujo sąskaitų planų. Šis sąskaitų planas programuotojų apmokestinamas.
                                </small>
                            </h5>
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
                                <input id="is_darbininkai_2" type="checkbox" name="is_darbininkai_2">
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
                    <div class="form-group" id="inp_darbininkai_2" style="display:none">
                        <label class="col-md-2 control-label"> </label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3">
                                    <input type="text" name="darbuotojai_2_kiekis" value="0" min="0" max="100" id="darbuotojai_2_kiekis" class="form-control" placeholder="Kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="darbuotojai_2_menesis" id="darbuotojai_2_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="darbuotojai_2_metai" id="darbuotojai_2_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                                <div class="col-md-1">
                                    <div class="checkbox checkbox-info">
                                        <input id="is_darbininkai" type="checkbox" name="is_darbininkai">
                                        <label> <b>*</b></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Darbuotojai "rastai" ivestio kieki -->
                    <div class="form-group" id="inp_darbininkai" style="display:none">
                        <label class="col-md-2 control-label">Su "raštais":</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3">
                                    <input type="text" name="darbuotojai_kiekis" id="darbuotojai_kiekis"  value="0" min="0" max="100" class="form-control" placeholder="Kiekis">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="darbuotojai_menesis" id="darbuotojai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="darbuotojai_metai" id="darbuotojai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FR572 keiciam i GPM313 FR573 keiciam i GPM312 -->
                    <div id="darbuotoju_deklaracijos" style="display:none">
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
                    </div>
                    <!-- pastaba -->
                    <h6>
                        * Įkainiai taikomi ūkiuose iki 10 darbuotojų
                    </h6>
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

                    <!-- /////////////////////////////////////////////////////////////
                    GYVULININKYSTE / AUGALININKYSTE KAINA
                   ////////////////////////////////////////////////////////////////-->
                    <?php
                    echo'<div class="alert alert-info text-center">';
                    if($this->main_model->info['txt']['ukis'] == 0){echo'GYVULININKYSTĖS APSKAITOS KAINA';}
                    if($this->main_model->info['txt']['ukis'] == 1){echo'AUGALININKYSTĖS APSKAITOS KAINA';}
                    echo'</div>';
                    ?>
                    <!-- GALVIJAI -->
                    <?php if($this->main_model->info['txt']['banda'] != 0){ ?>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Galvijai (vnt):</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <?php echo form_error('galvijai_kiekis'); ?>
                                    <input type="text" name="galvijai_kiekis" id="galvijai_kiekis" class="form-control" placeholder="Galvijų kiekis"
                                           value="<?=  $this->main_model->info['txt']['vidurkis'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <?php echo form_error('suma_menesis'); ?>
                                    <input type="text" name="galvijai_menesis" id="galvijai_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <?php echo form_error('suma_metai'); ?>
                                    <input type="text" name="galvijai_metai" id="galvijai_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                            <br>
                            <div class="row row-space-12">
                                <?php echo form_error('gyvuliai'); ?>
                                <div class="col-md-2">
                                    <div class="radio radio-info radio-inline">
                                        <?php if($this->main_model->info['txt']['banda'] == 2){
                                            echo"<input type='radio' value='2' name='banda' id='banda' checked>";}else{
                                            echo"<input type='radio' value='2' name='banda' id='banda' disabled>";
                                        } ?>
                                        <label> MĖSINIAI </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="radio radio-info radio-inline">
                                        <?php if($this->main_model->info['txt']['banda'] == 1){
                                            echo"<input type='radio' value='1' name='banda' id='banda' checked>";}else{
                                            echo"<input type='radio' value='1' name='banda' id='banda' disabled>";
                                        } ?>
                                        <label> PIENINIAI </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="radio radio-info radio-inline">
                                        <?php if($this->main_model->info['txt']['banda'] == 3){
                                            echo"<input type='radio' value='3' name='banda' id='banda' checked>";}else{
                                            echo"<input type='radio' value='3' name='banda' id='banda' disabled>";
                                        } ?>
                                        <label> MIŠRŪS </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- GALVIJU JUDEJIMAS -->
                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="judejimas" id="judejimas">
                                        <label for="judejimas"> GALVIJŲ JUDĖJIMAS</label>
                                    </div>
                                </div>
                                <div id="inp_judejimas" style="display:none">
                                    <div class="col-md-4">
                                        <input type="text" name="judejimas_menesis" id="judejimas_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="judejimas_metai" id="judejimas_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php } ?>
                    <!-- Deklaruojamas plotas -->
                    <div class="form-group">
                        <label class="col-md-2 control-label"> Žemės deklaracija (ha):</label>
                        <div class="col-md-10">
                            <div class="checkbox checkbox-info">
                                <input id="deklaruojas_plotas" type="checkbox" name="deklaruojas_plotas">
                                <label> DEKLARUOJAMAS PLOTAS</label>
                            </div>
                        </div>
                    </div>
                    <!-- skaiciuoja deklaruota plota jei pazymeta varnele -->
                    <div class="form-group" id="inp_deklaruojamas_plotas" style="display:none">
                        <label class="col-md-2 control-label">Deklaruotas plotas (ha):</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <?php echo form_error('dek_plotas'); ?>
                                    <input type="text" name="dek_plotas" id="dek_plotas" class="form-control" placeholder="Kiekis"
                                           value="<?= $this->main_model->info['txt']['deklaruota'] ?>">
                                </div>
                                <div class="col-md-4">
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
                    <!-- technika augaliniame ukyje -->
                    <?php if($this->main_model->info['txt']['banda'] == 0){?>
                    <div class="form-group">
                        <label for="technika" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-2">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="technika" id="technika">
                                        <label> TECHNIKA</label>
                                    </div>
                                </div>
                                <div id="inp_technika" style="display:none">
                                    <div class="col-md-4">
                                        <input type="text" name="technika_kiekis" value="0" min="0" max="100" id="technika_kiekis" class="form-control" placeholder="Technika kiekis (vnt)">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="technika_menesis" id="technika_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="technika_metai" id="technika_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <hr>
                    <!-- VISO ukio apskaitos KAINA -->
                    <div class="form-group">
                        <label for="ukis_menesis" class="col-md-2 control-label"> Ūkio apskaitos kaina:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="ukis_menesis" id="ukis_menesis" class="form-control" placeholder="Viso per menesį" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="ukis_metai" id="ukis_metai" class="form-control" placeholder="Viso per metus" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <! -- /////////////////////////////////////////////////////////
                    DEKLARACIJOS
                    /////////////////////////////////////////////////////////// -->
                    <div class="alert alert-info text-center">DEKLARACIJŲ TEIKIMAS</div>
                    <!-- PVM x12 -->
                    <div class="form-group">
                        <label for="pvm_x12" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="pvm_x12" id="pvm_x12">
                                        <label> PVM x12</label>
                                    </div>
                                </div>
                                <div id="inp_pvm_x12" style="display:none">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x12_menesis" id="pvm_x12_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x12_metai" id="pvm_x12_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                            <h5>
                                <small>
                                    PVM deklaracija 12 kartų per metus, t.y. kiekviena menesį.
                                </small>
                            </h5>
                        </div>
                    </div>
                    <!-- PVM x2 -->
                    <div class="form-group">
                        <label for="pvm_x2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="pvm_x2" id="pvm_x2">
                                        <label> PVM x2</label>
                                    </div>
                                </div>
                                <div id="inp_pvm_x2" style="display:none">
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_menesis" id="pvm_x2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="pvm_x2_metai" id="pvm_x2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                            <h5>
                                <small>
                                    PVM deklaracija 2 kartų per metus, t.y. kartą per pusmetį.
                                </small>
                            </h5>
                        </div>
                    </div>
                    <!-- FR457 -->
                    <div class="form-group">
                        <label for="fr457" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="fr457" id="fr457">
                                        <label> FR457</label>
                                    </div>
                                </div>
                                <div id="inp_fr457" style="display:none">
                                    <div class="col-md-2">
                                        <input type="text" name="fr457_kiekis" value="0" min="0" max="100" id="fr457_kiekis" class="form-control" placeholder="FR457 kiekis (vnt)">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="fr457_menesis" id="fr457_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="fr457_metai" id="fr457_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                            <h5>
                                <small>
                                    Individualioje veikloje naudojamo ilgalaikio materialiojo turto deklaracija
                                </small>
                            </h5>
                        </div>
                    </div>
                    <!-- GPM308 -->
                    <div class="form-group">
                        <label for="gpm308" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gpm308" id="gpm308">
                                        <label> GPM308</label>
                                    </div>
                                </div>
                                <div id="inp_gpm308" style="display:none">
                                    <div class="col-md-4">
                                        <input type="text" name="gpm308_menesis" id="gpm308_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="gpm308_metai" id="gpm308_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                            <h5>
                                <small>
                                    Metinė pajamų deklaracija
                                </small>
                            </h5>
                        </div>
                    </div>
                    <!-- SAV1 -->
                    <div class="form-group">
                        <label for="sav1" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="sav1" id="sav1">
                                        <label> SAV1</label>
                                    </div>
                                </div>
                                <div id="inp_sav1" style="display:none">
                                    <div class="col-md-2">
                                        <input type="text" name="sav1_kiekis" value="0" min="0" max="100" id="sav1_kiekis" class="form-control" placeholder="SAV1 kiekis (vnt)">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="sav1_menesis" id="sav1_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="sav1_metai" id="sav1_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- IVAZ -->
                    <div class="form-group">
                        <label for="ivaz" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="ivaz" id="ivaz">
                                        <label> I-VAZ</label>
                                    </div>
                                </div>
                                <div id="inp_ivaz" style="display:none">
                                    <div class="col-md-2">
                                        <input type="text" name="ivaz_kiekis" value="0" min="0" max="100" id="ivaz_kiekis" class="form-control" placeholder="I-vaz kiekis (vnt)">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="ivaz_menesis" id="ivaz_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="ivaz_metai" id="ivaz_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ISAF x12 -->
                    <div class="form-group">
                        <label for="isaf_12" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="isaf_12" id="isaf_12">
                                        <label> I-SAF x12</label>
                                    </div>
                                </div>
                                <div id="inp_isaf_12" style="display:none">
                                    <div class="col-md-4">
                                        <input type="text" name="isaf_12_menesis" id="isaf_12_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="isaf_12_metai" id="isaf_12_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ISAF x2 -->
                    <div class="form-group">
                        <label for="isaf_2" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="isaf_2" id="isaf_2">
                                        <label> I-SAF x2</label>
                                    </div>
                                </div>
                                <div id="inp_isaf_2" style="display:none">
                                    <div class="col-md-4">
                                        <input type="text" name="isaf_2_menesis" id="isaf_2_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="isaf_2_metai" id="isaf_2_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- VISO deklaraciju teikimas KAINA -->
                    <div class="form-group">
                        <label for=teikimas_menesis" class="col-md-2 control-label"> Deklaracijų teikimo kaina:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="teikimas_menesis" id="teikimas_menesis" class="form-control" placeholder="Viso per menesį" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="teikimas_metai" id="teikimas_metai" class="form-control" placeholder="Viso per metus" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- //////////////////////////////////////////////////////////////////
                    KITŲ PASLAUGŲ KAINOS
                    /////////////////////////////////////////////////////////////////// -->

                    <div class="alert alert-info text-center">KITŲ PASLAUGŲ KAINA</div>
                    <!-- Aplinkos tarsos mokestis -->
                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gamtos_apsauga" id="gamtos_apsauga">
                                        <label for="gamtos_apsauga"> APLINKOS TARŠOS MOKESTIS</label>
                                    </div>
                                </div>
                                <div id="inp_apsauga" style="display:none">
                                    <div class="col-md-4">
                                        <input type="text" name="apsauga_menesis" id="apsauga_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="apsauga_metai" id="apsauga_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                            <h5>
                                <small>
                                    Pagal LR atliekų tvarkymo įstatymą į Lietuvą įvežus daugiau kaip 5 vnt. baterijų savo reikmėms,
                                    o verslo reikmėms nuo pirmo tokio vieneto gamintojas arba importuotojas turi registruotis Gamintojų ir importuotojų sąvade,
                                    organizuoti surinkimą, vežimą, pasiruošimą naudoti, šviesti visuomenę gaminių tvarkymo klausimais, tvarkyti gaminių apskaitą, teikti ataskaitas.<br>
                                    Nuo mokesčio už aplinkos teršimą iš mobilių taršos šaltinių atleidžiami:
                                    <ul>
                                        <li>fiziniai ir juridiniai asmenys, turintys išmetamųjų dujų neutralizavimo sistemas</li>
                                        <li>fiziniai ir juridiniai asmenys, teršiantys iš transporto priemonių naudojamų žemės ūkio veiklai, jei jų pajamos iš šios veiklos sudaro daugiau kaip 50 procentų visų gaunamų pajamų.</li>
                                        <li>fiziniai asmenys, kurie verčiasi individualia veikla ir naudoją asmenines transporto priemones.</li>
                                        <li>fiziniai ir juridiniai asmenys naudojantys biodegalus.</li>
                                    </ul>
                                    Nuo mokesčio už aplinkos teršimą iš stacionarių taršos šaltinių atleidžiami:
                                    <ul>
                                        <li>fiziniai ir juridiniai asmenys, įgyvendinantys aplinkosaugos priemones.
                                        <li>fiziniai ir juridiniai asmenys, pateikę ... sunaudojimą patvirtinančius dokumentus</li>
                                    </ul>
                                </small>
                            </h5>
                        </div>
                    </div>
                    <!-- Zemes mokestis -->
                    <div class="form-group">
                        <label for="zemes_mokestis" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="zemes_mokestis" id="zemes_mokestis">
                                        <label> ŽEMĖS MOKESTIS</label>
                                    </div>
                                </div>
                                <div id="inp_zemes" style="display:none">
                                    <div class="col-md-3">
                                        <input type="text" name="zemes_kiekis" value="0" min="0" max="100" id="zemes_kiekis" class="form-control" placeholder="Žemės kiekis (vnt)">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="zemes_menesis" id="zemes_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="zemes_metai" id="zemes_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                            <h5>
                                <small>
                                    Nuo 2018-01-01 mokant žemės mokestį, ūkininkas privalo išskaičiuoti gyventojų pajamų mokestį, sumokėti ir deklaruoti VMI.<br>
                                    Nuo 2018-01-01 mokant žemės nuomos mokestį fiziniams asmenims, ūkininkas privalo išskaičiuoti ir deklaruoti gyventojų pajamų mokestį GPM313 deklaracijoje.
                                </small>
                            </h5>
                        </div>
                    </div>
                    <!-- Europos parama -->
                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="europa" id="europa">
                                        <label for="europa"> EUROPOS PARAMA</label>
                                    </div>
                                </div>
                                <div id="inp_europa" style="display:none">
                                    <div class="col-md-4">
                                        <input type="text" name="europa_menesis" id="europa_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="europa_metai" id="europa_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                            <h5>
                                <small>
                                    Pasinaudojus ES struktūrinių fondų, kita ES parama skaičiuojamas paramos procentas, skirstomas paramos nusidėvėjimas ir nusidėvėjimas standartinėmis sąnaudomis.
                                </small>
                            </h5>
                        </div>
                    </div>
                    <!-- Kuro apskaita -->
                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-3">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="kuras" id="kuras">
                                        <label for="kuras"> KURO APSKAITA</label>
                                    </div>
                                </div>
                                <div id="inp_kuras" style="display:none">
                                    <div class="col-md-3">
                                        <input type="text" name="kuras_kiekis" value="0" min="0" max="100" id="kuras_kiekis" class="form-control" placeholder="Transp. priemonių kiekis (vnt)">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="kuras_menesis" id="kuras_menesis" class="form-control" placeholder="Suma per menesį">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="kuras_metai" id="kuras_metai" class="form-control" placeholder="Suma per metus">
                                    </div>
                                </div>
                            </div>
                            <h5>
                                <small>
                                    Kuro apskaitą vykdome, jei įtraukiami į apskaitą visų rūšių degalai. Pildomi kelionės lapai kiekvienai transporto priemonei.
                                </small>
                            </h5>
                        </div>
                    </div>
                    <hr>
                    <!-- VISO deklaraciju teikimas KAINA -->
                    <div class="form-group">
                        <label for=kiti_menesis" class="col-md-2 control-label"> Kitų paslaugų kaina:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="kiti_menesis" id="kiti_menesis" class="form-control" placeholder="Viso per menesį" disabled>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kiti_metai" id="kiti_metai" class="form-control" placeholder="Viso per metus" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                   <!-- //////////////////////////////////////////////////////////////////
                   NUOLAIDOS
                   /////////////////////////////////////////////////////////////////// -->
                    <div class="alert alert-info text-center">NUOLAIDOS</div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Nuolaida (%):</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="laiku_atsiskaito" id="laiku_atsiskaito">
                                        <label for="laiku_atsiskaito"> LAIKU ATSISKAITO</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="seimos_nariai" id="seimos_nariai">
                                        <label for="seimos_nariai"> ŠEIMOS NARIAI VEDA APSKAITA</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="laiku_dokumentai" id="laiku_dokumentai">
                                        <label for="laiku_dokumentai"> LAIKU PATEIKIA PIRMINIUS DOKUMENTUS</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nuolaida" class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <input type="text" name="nuolaida" id="nuolaida" value="0" min="0" max="100" class="form-control" placeholder="Nuolaida">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="nuolaida_menesis" id="nuolaida_menesis" class="form-control" placeholder="Nuolaida per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="nuolaida_metai" id="nuolaida_metai" class="form-control" placeholder="Nuolaida per metus">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-danger">
                        <div class="row row-space-12">
                            <div class="col-md-3">
                                ŪKIS: <b><?php
                                    $arr = array("GYVULININKYSTĖ", "AUGALININKYSTĖ");
                                    echo $arr[$this->main_model->info['txt']['ukis']];
                                    ?></b>
                            </div>
                            <div class="col-md-3">
                                <?php
                                if($this->main_model->info['txt']['ukis'] == 0){
                                    echo"Gyvulių vidurkis: <b>";
                                    echo $this->main_model->info['txt']['galvijai'];
                                    echo"</b>";
                                } ?>
                            </div>
                            <div class="col-md-3">
                                Deklaruojamas plotas: <b><?php echo $this->main_model->info['txt']['plotas']; ?></b>
                            </div>
                            <div class="col-md-3">
                                Praėjusių metų suma: <b><?php echo $this->main_model->info['txt']['suma']['uz_metus']." €, ( ".$this->main_model->info['txt']['suma']['uz_menesi']." € )"; ?></b>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-2 control-label"> Viso:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <input type="text" name="viso_menesis" id="viso_menesis" class="form-control" placeholder="Viso per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="viso_metai" id="viso_metai" class="form-control" placeholder="Viso per metus">
                                </div>
                            </div>
                        </div>
                    </div>

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
