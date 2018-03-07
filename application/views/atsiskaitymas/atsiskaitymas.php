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
            <button class="btn btn-default" type="button" id="israsai_ikelti">
                <span class="fa fa-retweet fa-2x text-info"></span> <br/>Išrašų įkėlimas
            </button>
            <button class="btn btn-default" type="button" id="israsai_sarasas">
                <span class="fa fa-bar-chart-o fa-2x text-info"></span> <br/>Išrašų  sąrašas
            </button>
            <button class="btn btn-default" type="button" id="">
                <span class="fa fa-line-chart fa-2x text-info"></span> <br/>Dar kazkas su atsiskaitymais
            </button>
            <hr>

            <!-- Atsiskaitymu IKELIMAS -->
            <div class="form-group" id="in_israsai_ikelti" style="display:none">
                <form action="" id="banko_israsas" enctype="multipart/form-data" method="POST">
                    <div class="row">
                        <div id="message"></div>
                        <div class="col-md-12">
                            <label for="israsas" class="control-label">Banko išrašas:</label>
                            <div class="input-group">
                              <span class="input-group-btn">
                                <span class="btn btn-info" onclick="$(this).parent().find('input[type=file]').click();">Pasirinkite failą ...</span>
                                <input name="israsas" id="israsas" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
                              </span>
                                <span class="form-control"></span>
                            </div>
                        </div>
                    </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-block btn-info" type="submit">
                                    <span class="fa fa-download text-white"></span> ĮKELTI BANKO IŠRAŠĄ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- Rodom informacija, kuria gauna, apdorojus AJAX uzklausa  -->
    <div id="data"></div>
</div>
<!-- KRAUNASI -->
<div id="loading" style="display:none"></div>
