<?php
$dt = $this->session->userdata();
$menesiai = array("Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsejis", "Spalis","Lapkritis", "Gruodis");
$metai = array("2016", "2017", "2018", "2019", "2020");
//perziureti dokumentus galima, uz praeita menesi

//reiketu menesi ir metus itraukti i sesijas//
if(date('m') == 1){
    $men = 12; $met = date('Y')-1;
}else{
    $men=date('m')-1; $met = date('Y');
}
//uzkraunam MODAL langus
$this->load->view("galvijai/langai_modal");
?>
<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <hr>
            <button class="btn btn-default" type="button" id="viclt">
                <span class="fa fa-retweet fa-2x text-info"></span> <br/>VIC.LT
            </button>
            <button class="btn btn-default" type="button" id="galviju_sarasas">
                <span class="fa fa-bar-chart-o fa-2x text-info"></span> <br/>Galvijų  sąrašas
            </button>
            <button class="btn btn-default" type="button" id="galviju_judejimas">
                <span class="fa fa-line-chart fa-2x text-info"></span> <br/>Galvijų judėjimas 2017
            </button>
            <button class="btn btn-default" type="button" id="galviju_judejimas2">
                <span class="fa fa-line-chart fa-2x text-danger"></span> <br/>Galvijų judėjimas 2018
            </button>
            ---
            <button class="btn btn-default" type="button" id="skaiciuoti_pasarus">
                <span class="fa fa-cutlery fa-2x text-info"></span> <br/>Skaičiuoti pašarus
            </button>
            <button class="btn btn-default" type="button" id="priesvoris">
                <span class="fa fa-shopping-cart fa-2x text-info"></span> <br/>Priesvoris
            </button>
            <button class="btn btn-default" type="button" id="skaiciuoti_meslus">
                <span class="fa fa-stumbleupon fa-2x text-info"></span> <br/>Mėšlas
            </button>
            <button class="btn btn-default" type="button" id="ganykliniai_pasarai">
                <span class="fa fa-tree fa-2x text-info"></span> <br/>Ganykliniai pašarai
            </button>
            <button class="btn btn-default" type="button" id="nustatymai">
                <span class="fa fa-cogs fa-2x text-info"></span> <br/>Nustatymai
            </button>
            <hr>
            <form class="form-bordered" action="" id="galvijai" method="POST">
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label for="ukininkas" class="control-label">Ūkininkas:</label>
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
                        <div class="col-md-4">
                            <label for="metai" class="control-label">Metai:</label>
                            <select name="metai" id="metai" class="form-control">
                                <?php
                                for($i=0; $i<count($metai); $i++) {
                                    $mm = $i+2016;
                                    if($met == $mm){
                                        echo"<option value=".$mm." selected>".$metai[$i]."</option>";}else{
                                        echo"<option value=".$mm.">".$metai[$i]."</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="menesis" class="control-label">Menesis:</label>
                            <select name="menesis" id="menesis" class="form-control">
                                <option value="">Pasirinkite...</option>
                                <?php
                                for($i=0; $i<count($menesiai); $i++) {
                                    $mm = $i+1;
                                    if($men == $mm){
                                        echo"<option value=".$mm." selected>".$menesiai[$i]."</option>";}else{
                                        echo"<option value=".$mm.">".$menesiai[$i]."</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                </fieldset
            </form>
            <br><br>

            <!-- VIC.LT -->
            <div class="form-group" id="in_viclt" style="display:none">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <div class="col-md-2">
                            <div class="radio radio-info radio-inline">
                                <input type='radio' value='2' name='rinktis' id='rinktis'>
                                <label> ( 01.01 - 01.31) </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="radio radio-info radio-inline">
                                <input type='radio' value='1' name='rinktis' id='rinktis' checked>
                                <label> (01.01 - 02.01) </label>
                            </div>
                        </div> -->
                        <button class="btn btn-info" type="button" id="ikelti_viclt">
                            <span class="fa fa-download text-white"></span> Įkelti naujus duomenis
                        </button>
                        <button class="btn btn-danger" type="button" id="istrinti_viclt">
                            <span class="fa fa-trash text-white"></span> Ištrinti duomenis
                        </button>
                    </div>
                </div>
            </div>

            <!-- PASARU SKAICIAVIMAS -->
            <div class="form-group" id="in_skaiciuoti_pasarus" style="display:none">
                <div class="row">
                    <div class="col-md-6">
                        <?php $lai = array("I pusmetis", "II pusmetis", "I ketvirtis", "II ketvirtis", "III ketvirtis", "IV ketvirtis"); ?>
                        <label for="laikotarpis_pasarai" class="control-label">Laikotarpis:</label>
                        <select name="laikotarpis_pasarai" id="laikotarpis_pasarai" class="form-control">
                            <option value="">Pasirinkite...</option>
                            <?php
                            for($i=0; $i<count($lai); $i++) {
                                $mm = $i+1;
                                echo"<option value=".$mm.">".$lai[$i]."</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="rinktis" class="control-label">Skaičiavimas:</label>
                        <select name="rinktis" id="rinktis" class="form-control">
                            <option value="1">MAŽIAUSIAI</option>
                            <option value="2" selected>VIDURKIS</option>
                            <option value="3">DAUGIAUSIAI</option>
                            <option value="4">BENDRAS </option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-block btn-info" type="button" id="pasarai">
                            <span class="fa fa-download text-white"></span> SKAIČIUOTI PAŠARUS
                        </button>
                    </div>
                </div>
            </div>

            <!-- PASARU SKAICIAVIMAS -->
            <div class="form-group" id="in_skaiciuoti_meslus" style="display:none">
                <div class="row">
                    <div class="col-md-12">
                        <?php $lai = array("Visas sezonas", "IV ketvirtis", "I ketvirtis", "II ketvirtis (tik Balandis)"); ?>
                        <label for="laikotarpis_meslas" class="control-label">Laikotarpis:</label>
                        <select name="laikotarpis_meslas" id="laikotarpis_meslas" class="form-control">
                            <option value="">Pasirinkite...</option>
                            <?php
                            for($i=0; $i<count($lai); $i++) {
                                $mm = $i+1;
                                echo"<option value=".$mm.">".$lai[$i]."</option>";
                            } ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-block btn-info" type="button" id="meslas">
                            <span class="fa fa-download text-white"></span> SKAIČIUOTI MĖŠLUS
                        </button>
                    </div>
                </div>
            </div>

            <!-- GANYKLINIU PASARU SKAICIAVIMAS -->
            <div class="form-group" id="in_ganykliniai_pasarai" style="display:none">
                <div class="row">
                    <div class="col-md-12">
                        <?php $lai = array("Visas sezonas", "II ketvirtis", "III ketvirtis"); ?>
                        <label for="laikotarpis_ganyklos" class="control-label">Laikotarpis:</label>
                        <select name="laikotarpis_ganyklos" id="laikotarpis_ganyklos" class="form-control">
                            <option value="">Pasirinkite...</option>
                            <?php
                            for($i=0; $i<count($lai); $i++) {
                                $mm = $i+1;
                                echo"<option value=".$mm.">".$lai[$i]."</option>";
                            } ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-block btn-info" type="button" id="ganyklos">
                            <span class="fa fa-download text-white"></span> SKAIČIUOTI GANYKLINIUS PAŠARUS
                        </button>
                    </div>
                </div>
            </div>

            <!-- NUSTATYMAI -->
            <div class="form-group" id="in_nustatymai" style="display:none">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-warning" type="button" id="pasaru_normos">
                            <span class="fa fa-cutlery text-white"></span> Pašarai
                        </button>
                        <button class="btn btn-warning" type="button" id="meslu_normos">
                            <span class="fa fa-stumbleupon text-white"></span> Mėšlas
                        </button>
                        <button class="btn btn-warning" type="button" id="prisvorio_normos">
                            <span class="fa fa-shopping-cart text-white"></span> Priesvoris
                        </button>
                        <button class="btn btn-warning" type="button" id="ganykliniu_normos">
                            <span class="fa fa-tree text-white"></span> Ganykliniai pašarai
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Rodom informacija, kuria gauna, apdorojus AJAX uzklausa  -->
    <div id="data"></div>

</div>

<!-- KRAUNASI -->
<div id="loading" style="display:none"></div>

