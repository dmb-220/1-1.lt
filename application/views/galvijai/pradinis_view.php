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

?>
<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
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
            <hr>
            <button class="btn btn-default" type="button" id="viclt">
                <span class="fa fa-retweet fa-2x text-info"></span> <br/>Įtraukti iš VIC.LT
            </button>
            <button class="btn btn-default" type="button" id="galviju_sarasas">
                <span class="fa fa-bar-chart-o fa-2x text-info"></span> <br/>Galvijų  sąrašas
            </button>
            <button class="btn btn-default" type="button" id="galviju_judejimas">
                <span class="fa fa-line-chart fa-2x text-info"></span> <br/>Galvijų judėjimas
            </button>
            ---
            <button class="btn btn-default" type="button" id="apskaiciuoti_pasarus">
                <span class="fa fa-exchange fa-2x text-info"></span> <br/>Apskaičiuoti pašarus
            </button>
            <button class="btn btn-default" type="button" id="priesvoris">
                <span class="fa fa-shopping-cart fa-2x text-info"></span> <br/>Priesvoris
            </button>
            <button class="btn btn-default" type="button" id="meslas">
                <span class="fa fa-newspaper-o fa-2x text-info"></span> <br/>Mėšlas
            </button>
            <button class="btn btn-default" type="button" id="ganykliniai_pasarai">
                <span class="fa fa-newspaper-o fa-2x text-info"></span> <br/>Ganykliniai pašarai
            </button>
            <button class="btn btn-default" type="button" id="normu_sarasas">
                <span class="fa fa-newspaper-o fa-2x text-info"></span> <br/>Normų sąrašas
            </button>
            <hr>
            <div class="form-group" id="in_viclt" style="display:none">
                <button class="btn btn-info" type="button" id="ikelti_viclt">
                    <span class="fa fa-download text-white"></span> Įkelti naujus duomenis
                </button>
                <button class="btn btn-info" type="button" id="istrinti_viclt">
                    <span class="fa fa-trash text-white"></span> Ištrinti duomenis
                </button>
            </div>
        </div>
    </div>
    <div id="data"></div>
</div>
<!-- KRAUNASI -->
<div id="loading" style="display:none"></div>
<?php  //$this->load->view('galvijai/gyvuliu_sarasas_view'); ?>
