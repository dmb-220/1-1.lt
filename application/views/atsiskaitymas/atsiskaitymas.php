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
<div class="wrapper wrapper-content" id="israsu_redagavimas">
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
            <button class="btn btn-default" type="button" v-on:click="pasirinkti_israsus">
                <span class="fa fa-line-chart fa-2x text-info"></span> <br/>Išrašų redagavimas
            </button>
            <button class="btn btn-default" type="button" id="israsai_sarasas">
                <span class="fa fa-bar-chart-o fa-2x text-info"></span> <br/>Didžioji knyga
            </button>
            <button class="btn btn-default" type="button" id="ukininkai">
                <span class="fa fa-line-chart fa-2x text-info"></span> <br/>Ūkininkai
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
        <!-- Israsu redagavimas -->
        <div class="form-group" v-if="rodyti_redagavima">
            <div class="row">
                <div class="col-md-6">
                    <label for="metai" class="control-label">Metai:</label>
                    <select name="metai" id="metai" v-model="metai" class="form-control">
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
                    <select name="menesis" id="menesis" v-model="menesis" class="form-control">
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
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-block btn-info" type="button" v-on:click="rinktis_israsus">
                        <span class="fa fa-download text-white"></span> PASIRINKTI
                    </button>
                </div>
            </div>
        </div>
            <!-- Israsu redagavimas -->
            <div class="form-group" v-if="israso_sarasas">
            <div class="table-responsive" id="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>...</th>
                        <th>Operacijos suma</th>
                        <th>Mokėtojas</th>
                        <th>Gavėjas</th>
                        <th>Mokejimo paskirtis</th>
                        <th>Bankas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr is="tr-item"
                        v-for="item in israsas"
                        v-bind:todo="item"
                        v-bind:key="item.id">
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>

    </div>
        </div>
    <!-- Rodom informacija, kuria gauna, apdorojus AJAX uzklausa  -->
    <div id="data"></div>
</div>
<!-- KRAUNASI -->
<div id="loading" style="display:none"></div>
