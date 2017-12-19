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
                        <label for="pirminiai" class="col-md-2 control-label">Pirminiai dokumentai:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <select id="pirminiai" name="pirminiai" class="form-control">
                                        <option value="0">Pasirinkite...</option>
                                    </select>
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
                                    reikalingi teisingos bugalterijos tvarkymui.
                                </small>
                            </h5>
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
                            <h5>
                                <small>
                                    Į šią kainą įeina darbuotojų darbo užmokesčio skaičiavimas, tabelio pildymas, kitos ataskaitos, išskyrus deklaracijos teikimus.
                                </small>
                            </h5>
                        </div>
                    </div>

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

                    <div class="alert alert-info text-center">GYVULININKYSTĖS KAINA</div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Galvijai (vnt):</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <?php echo form_error('galvijai_kiekis'); ?>
                                    <input type="text" name="galvijai_kiekis" id="galvijai_kiekis" class="form-control" placeholder="Galvijų kiekis"
                                           value="<?=  $this->main_model->info['txt']['vidurkis'] ?>" disabled>
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
                    <div class="form-group">
                        <label class="col-md-2 control-label">Deklaruotas plotas (ha):</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <?php echo form_error('dek_plotas'); ?>
                                    <input type="text" name="dek_plotas" id="dek_plotas" class="form-control" placeholder="Kiekis"
                                           value="<?= $this->main_model->info['txt']['deklaruota'] ?>" disabled>
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

                    <div class="alert alert-info text-center">KITŲ PASLAUGŲ KAINA</div>

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

                    <div class="form-group">
                        <label for="deklaracija" class="col-md-2 control-label">Deklaracijos:</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <select name="deklaracija" id="deklaracija" class="form-control" multiple="multiple">
                                        <option value="pvm_12">PVM deklaracija x12</option>
                                        <option value="pvm_2">PVM deklaracija x2</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="deklaracija_menesis" id="deklaracija_menesis" class="form-control" placeholder="Suma per menesį">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="deklaracija_metai" id="deklaracija_metai" class="form-control" placeholder="Suma per metus">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gamtos_apsauga" id="gamtos_apsauga">
                                        <label> APLINKOS TARŠOS MOKESTIS</label>
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
                                    o verslo reikmėms nuo pirmo tokio vieneto gamintojas arba importuotojas turi registruotis Gamintojų ir importuotojųsąvade,
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
                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="europa" id="europa">
                                        <label> EUROPOS PARAMA</label>
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
                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="saskaita" id="saskaita">
                                        <label> SĄSKAITŲ PLANAS</label>
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
                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-2">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="kuras" id="kuras">
                                        <label> KURO APSKAITA</label>
                                    </div>
                                </div>
                                <div id="inp_kuras" style="display:none">
                                    <div class="col-md-4">
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
                                    Kuro apskaita vykdome, jei įtraukiami į apskaitą visų rušių degalai. Pildomi kelionės lapai kiekvienai transporto priemonei.
                                </small>
                            </h5>
                        </div>
                    </div>
                    <div class="alert alert-info text-center">PAPILDOMI NUSTATYMAI</div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Nuolaida (%):</label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <select id="nuolaida" name="nuolaida" class="form-control">
                                        <option value="0">Pasirinkite...</option>
                                        <option value="2">2%</option>
                                        <option value="5">5%</option>
                                        <option value="10">10%</option>
                                        <option value="15">15%</option>
                                        <option value="20">20$</option>
                                        <option value="25">25%</option>
                                        <option value="30">30%</option>
                                    </select>
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
                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10">
                            <div class="row row-space-12">
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gamtos_apsauga" id="gamtos_apsauga">
                                        <label> LAIKU ATSISKAITO</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gamtos_apsauga" id="gamtos_apsauga">
                                        <label> ŠEIMOS NARIAI VEDA APSKAITA</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkbox checkbox-info">
                                        <input type="checkbox" name="gamtos_apsauga" id="gamtos_apsauga">
                                        <label> GALVIJŲ JUDĖJIMAS</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-danger">
                        <div class="row row-space-12">
                            <div class="col-md-3">
                                ŪKIS: <b><?php echo $this->main_model->info['txt']['ukis']; ?></b>
                            </div>
                            <div class="col-md-3">
                                Gyvulių vidurkis: <b><?php echo $this->main_model->info['txt']['galvijai']; ?></b>
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
                                        <i class="fa fa-check-circle-o fa-lg"> SKAITČIUOTI</i>
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
