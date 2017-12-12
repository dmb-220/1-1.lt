<div id="ilg_turtas" class="tab-pane in active">
    <?php
    $turto_rusys = array(
        "Nauji pastatai (pastatyti po 2002-01-01)", "Gyvenamieji namai (butai)", "Kiti pastatai", "Mašinos ir įrengimai", "Įrenginiai (statiniai ir kt.)",
        "Baldai ir inventorius", "Kompiuterinė technika ir ryšių priemonės (išskyrus mobiliojo ryšio)", "Mobiliojo ryšio priemonės",
        "Lengvieji automobiliai, naudojami trumpalaikės automobilių nuomos veiklai, vairavimo mokymo ar transporto paslaugoms teikti - ne senesni kaip 5 metų",
        "Kiti lengvieji automobiliai -  ne senesni kaip 5 metų", "Kiti lengvieji automobiliai", "Krovininiai automobiliai, priekabos ir puspriekabės, autobusai  -  ne senesni kaip 5 metų",
        "Kiti krovininiai automobiliai, priekabos, puspriekabės, autobusai ir žemės ūkio technika", "Kitas aukščiau neišvardytas materialusis turtas",
        "Programinė įranga (kompiuterinės programos)  ir įsigytos teisės", "Kitas nematerialus turtas"
    );
    $turto_grupes = array(
           "Išnuomota žemė", "Išnuomoti pastatai", "Išnuomoti įrenginiai", "Panaudos budu valdoma žemė"
    );

    ?>
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <button class="btn btn-default" type="button" id="pradiniai_likuciai">
                <span class="fa fa-book fa-2x text-danger"></span> <br/>Pradiniai likučiai
            </button>
            <button class="btn btn-default" type="button" id="apyvarta">
                <span class="fa fa-bar-chart-o fa-2x text-danger"></span> <br/>Apyvarta
            </button>
            <button class="btn btn-default" type="button" id="fr0457">
                <span class="fa fa-building-o fa-2x text-danger"></span> <br/>FR0457
            </button>
            <button class="btn btn-default" type="button" id="nusidevejimas">
                <span class="fa fa-exchange fa-2x text-danger"></span> <br/>Nusidėvėjimas
            </button>
            <button class="btn btn-default" type="button" id="momentiniai_likuciai">
                <span class="fa fa-shopping-cart fa-2x text-danger"></span> <br/>Momentiniai likučiai
            </button>
            <button class="btn btn-default" type="button" id="paramos_perskaiciavimas">
                <span class="fa fa-newspaper-o fa-2x text-danger"></span> <br/>Paramos perskaičiavimas
            </button>
        </div>

        <!-- pradiniai likuciai -->
        <div id="pradiniai_likuciai_show"  style="display:none">
            <form class="form-bordered" action="<?= base_url(); ?>buhalterija/pradiniai_likuciai" method="POST">
                <fieldset class="buh">
                    <legend class="buh">PRADINIAI LIKUČIAI</legend>
                    <div class="form-group row">
                        <div class="col-xs-5">
                        <label for="numeris">Numeris:</label>
                            <input name="numeris" id="numeris" type="text" class="form-control" value="">
                        </div>
                        <div class="col-xs-7" id="data_eksplotacija">
                            <label for="eksplotacijos_data">Įvedimas į ekspotaciją:</label>
                            <?php echo form_error('eksplotacijos_data'); ?>
                            <div class="input-group date">
                                <input type="text" id="eksplotacijos_data" name="eksplotacijos_data" class="form-control" placeholder="Pasirinkite datą">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-5">
                            <label for="pradine_verte">Pradinė vertė:</label>
                            <input name="pradine_verte" id="pradine_verte" type="text" class="form-control">
                        </div>
                        <div class="col-xs-4">
                            <label for="sukauptas_nusidevejimas">Sukauptas nusidėvėjimas:</label>
                            <input class="form-control" id="sukauptas_nusidevejimas" name="sukauptas_nusidevejimas" type="text">
                        </div>
                        <div class="col-xs-3">
                            <label for="deklaruojamoji_verte">Deklaruojamoji vertė:</label>
                            <input class="form-control" id="deklaruojamoji_verte" name="deklaruojamoji_verte" type="text">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-9">
                            <label for="islaidu_objektas">Išlaidų objektas:</label>
                            <input class="form-control" id="islaidu_objektas" name="islaidu_objektas" type="text">
                        </div>
                        <div class="col-xs-3">
                            <label for="europos_parama">Europos parama:</label>
                            <select class="form-control" id="europos_parama" name="europos_parama">
                                <option value="">Pasirinkite</option>
                                <option value="1">TAIP</option>
                                <option value="0">NE</option>>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pavadinimas">Pavadinimas:</label>
                        <input class="form-control" id="pavadinimas" name="pavadinimas" type="text">
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="marke">Markė:</label>
                            <input class="form-control" id="marke" name="marke" type="text">
                        </div>
                        <div class="col-xs-3">
                            <label for="kiekis">Kiekis:</label>
                            <input class="form-control" id="kiekis" name="kiekis" type="text">
                        </div>
                        <div class="col-xs-3">
                            <label for="mato_vnt">Mato vienetas:</label>
                            <input class="form-control" id="mato_vnt" name="mato_vnt" type="text">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="norma_metais">Norma metais:</label>
                            <input class="form-control" id="norma_metais" name="norma_metais" type="text">
                        </div>
                        <div class="col-xs-6">
                            <label for="norma_procentais">Norma procentais:</label>
                            <input class="form-control" id="norma_procentais" name="norma_procentais" type="text">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-3">
                            <label for="parama_procentais">Parama procentais:</label>
                            <input class="form-control" id="parama_procentais" name="parama_procentais" type="text">
                        </div>
                        <div class="col-xs-6">
                            <label for="paramos_objektas">Paramos objektas:</label>
                            <input class="form-control" id="paramos_objektas" name="paramos_objektas" type="text">
                        </div>
                        <div class="col-xs-3" id="data_paramos_gavimo">
                            <label for="paramos_gavimo_data">Paramos gavimo data:</label>
                            <?php echo form_error('paramos_gavimo_data'); ?>
                            <div class="input-group date">
                                <input type="text" id="paramos_gavimo_data" name="paramos_gavimo_data" class="form-control" placeholder="Pasirinkite datą">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-4">
                            <label for="akto_nr">Akto nr.:</label>
                            <input class="form-control" id="akto_nr" name="akto_nr" type="text">
                        </div>
                        <div class="col-xs-4">
                            <label for="inventoriaus_nr">Inventoriaus nr.:</label>
                            <input class="form-control" id="inventoriaus_nr" name="inventoriaus_nr" type="text">
                        </div>
                        <div class="col-xs-4">
                            <label for="korteles_nr">Kortelės nr.:</label>
                            <input class="form-control" id="korteles_nr" name="korteles_nr" type="text">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-6">
                            <label for="likutine_verte">Likutinė vertė:</label>
                            <input class="form-control" id="likutine_verte" name="likutine_verte" type="text">
                        </div>
                        <div class="col-xs-6">
                            <label for="likvidacine_verte">Likvidacinė vertė:</label>
                            <input class="form-control" id="likvidacine_verte" name="likvidacine_verte" type="text">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-4">
                            <label for="grupe">Grupė:</label>
                            <select class="form-control" id="grupe" name="grupe">
                                <option value="0" selected>Pasirinkite</option>
                                <?php
                                $ig = 1;
                                foreach ($turto_grupes as $grupe){
                                    echo'<option value="'.$ig.'">'.$grupe.'</option>';
                                    $ig++;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-5">
                            <label for="unikalus_nr">Unikalus nr.:</label>
                            <input class="form-control" id="unikalus_nr" name="unikalus_nr" type="text">
                        </div>
                        <div class="col-xs-3">
                            <label for="sutuoktinio leidimas">Sutuoktinio leidimas:</label>
                            <select class="form-control" id="sutuoktinio leidimas" name="sutuoktinio leidimas">
                                <option value="1" selected>TAIP</option>
                                <option value="0">NE</option>>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-8">
                            <label for="turto_dalies_priskyrimas">Turto dalies priskyrimas:</label>
                            <input class="form-control" id="turto_dalies_priskyrimas" name="turto_dalies_priskyrimas" type="text">
                        </div>
                        <div class="col-xs-4">
                            <label for="pvm">PVM:</label>
                            <input class="form-control" id="pvm" name="pvm" type="text">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-3" id="data_isigyjimo">
                            <label for="isigyjimo_data">Įsigyjimo data:</label>
                            <?php echo form_error('paramos_gavimo_data'); ?>
                            <div class="input-group date">
                                <input type="text" id="isigyjimo_data" name="isigyjimo_data" class="form-control" placeholder="Pasirinkite datą">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label for="turto_rusies_kodas">Turto rūšies kodai:</label>
                            <select class="form-control" id="turto_rusies_kodas" name="turto_rusies_kodas">
                                <option value="0" selected>Pasirinkite</option>
                                <?php
                                $id = 1;
                                foreach ($turto_rusys as $rusis){
                                    echo'<option value="'.$id.'">'.$rusis.'</option>';
                                    $id++;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <label for="nesilaikoma_normu">Bus nesilaikoma normatyvų?</label>
                            <div class="checkbox checkbox-info">
                                <input id="nesilaikoma_normu" name="nesilaikoma_normu" type="checkbox">
                                <label> TAIP</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="turinys">Turinys:</label>
                        <textarea class="form-control" rows="5" id="turinys" name="turinys"></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">
                            <i class="fa fa-check-circle-o fa-lg"> ĮRAŠYTI</i>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>

        <!-- apyvarta -->
        <div id="apyvarta_show" style="display:none">
            <form class="form-bordered" action="<?= base_url(); ?>buhalterija/pradiniai_likuciai" method="POST">
                <fieldset>
                    <legend>APYVARTA</legend>
                   apyvarta
                </fieldset>
            </form>
        </div>

        <!-- fr0457 -->
        <div id="fr0457_show" style="display:none">
            <form class="form-bordered" action="<?= base_url(); ?>buhalterija/pradiniai_likuciai" method="POST">
                <fieldset>
                    <legend>FR0457 FORMA</legend>

                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">
                            <i class="fa fa-check-circle-o fa-lg"> ĮRAŠYTI</i>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>

        <!-- nusidevejimas -->
        <div id="nusidevejimas_show" style="display:none">
            <form class="form-bordered" action="<?= base_url(); ?>buhalterija/pradiniai_likuciai" method="POST">
                <fieldset>
                    <legend>NUSIDĖVĖJIMAS</legend>

                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">
                            <i class="fa fa-check-circle-o fa-lg"> ĮRAŠYTI</i>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>

        <!-- momentiniai likuciai -->
        <div id="momentiniai_likuciai_show" style="display:none">
            <form class="form-bordered" action="<?= base_url(); ?>buhalterija/pradiniai_likuciai" method="POST">
                <fieldset>
                    <legend>MOMENTINIAI LIKUČIAI</legend>

                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">
                            <i class="fa fa-check-circle-o fa-lg"> ĮRAŠYTI</i>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>

        <!-- paramos perskaiciavimas -->
        <div id="paramos_perskaiciavimas_show" style="display:none">
            <form class="form-bordered" action="<?= base_url(); ?>buhalterija/pradiniai_likuciai" method="POST">
                <fieldset>
                    <legend>PARAMOS PERSKAIČIAVIMAS</legend>

                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">
                            <i class="fa fa-check-circle-o fa-lg"> ĮRAŠYTI</i>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
        </div>
</div>