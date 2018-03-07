<?php
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
        <div class="ibox-title">
            <h5> </h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <button class="btn btn-default" type="button" id="saskaitas_ikelti">
                <span class="fa fa-retweet fa-2x text-info"></span> <br/>Sąskaitu įkėlimas
            </button>
            <button class="btn btn-default" type="button" id="galviju_sarasas">
                <span class="fa fa-bar-chart-o fa-2x text-info"></span> <br/>Sąskaitų  sąrašas
            </button>
            <button class="btn btn-default" type="button" id="galviju_judejimas">
                <span class="fa fa-line-chart fa-2x text-info"></span> <br/>Dar kazkas su saskaitomis
            </button>
            <hr>
            <form class="form-bordered" action="" id="galvijai" method="POST">
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <label for="menesis" class="control-label">Menesis:</label>
                            <select name="menesis" id="menesis" class="form-control">
                                <option value="">Pasirinkite...</option>
                                <?php
                                for($i=0; $i<count($this->main_model->menesiai); $i++) {
                                    $mm = $i+1;
                                    if($men == $mm){
                                        echo"<option value=".$mm." selected>".$this->main_model->menesiai[$i]."</option>";}else{
                                        echo"<option value=".$mm.">".$this->main_model->menesiai[$i]."</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                </fieldset
            </form>
            <hr>
            <br><br>

            <!-- SASKAITU IKELIMAS -->
            <div class="form-group" id="in_saskaitas_ikelti" style="display:none">
                        <form action="saskaitos/ikelti" enctype="multipart/form-data" class="dropzone" id="image-upload" method="POST">
                            <div>
                                <h3>Norėdami įkelti failus, paspauskite ČIA, arba užtempkite ant sito laukelio norimus failus. Įkelti galima .PDF failus</h3>
                            </div>
                        </form>
            </div>

            <form action="saskaitos/ikelti" enctype="multipart/form-data" class="dropzone" id="image-upload" method="POST">
                <div>
                    <h3>Norėdami įkelti failus, paspauskite ČIA, arba užtempkite ant sito laukelio norimus failus. Įkelti galima .PDF failus</h3>
                </div>
            </form>
        </div>
    </div>
    <!-- Rodom informacija, kuria gauna, apdorojus AJAX uzklausa  -->
    <div id="data"></div>
</div>
<!-- KRAUNASI -->
<div id="loading" style="display:none"></div>

<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize: 5,
        acceptedFiles: ".pdf"
    };
</script>
