<?php
$men = array("Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa",
    "Rugpjūtis", "Rugsėjis", "Spalis","Lapkritis", "Gruodis");

$dt = $this->session->userdata();

$sa = $this->zalia_knyga_model->nuskaityti_saskaitas();
//var_dump($sa);

///////////////////////////////////////perkelti laikotarpi i atskira tab, kuris atsidarytu/////////////////////
/// ///////////////////////////////////virsuje padaryti meniu, informacijai itraukti, is iconu////////////////
?>

<div class="wrapper wrapper-content animated fadeInRight">

    <!-- Klaidu pranesimai is, naujo PVM tarifo sukurimo  -->
    <?php
    //i masyva surasom klaidu pavadinimus(masyvo raktai)
    $array_error = array("pvm_ok", "pvm_yra", "pvm_kodas", "pvm_tarifas", "irasas_yra", "irasas_ok");
    foreach ($array_error as $err){
    if($this->session->flashdata($err)){ ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Informacija
            </div>
            <div class="panel-body">
                <?php echo $this->session->flashdata($err); ?>
            </div>
        </div>
    <?php }
    }
    ?>


    <div class="alert alert-success" role="alert">
        <!-- Laikotarpis -->
        <a data-toggle="modal" href="#laikotarpis" class="btn btn-default" type="button">
            <i class="fa fa-plus-square-o fa-lg"> LAIKOTARPIS</i>
        </a>

        <!-- Nauajas irasas-->
        <a data-toggle="modal" href="#naujas_irasas" class="btn btn-default" type="button">
            <i class="fa fa-plus-square-o fa-lg"> NAUJAS ĮRAŠAS</i>
        </a>

        <!-- PVM -->
        <a data-toggle="modal" href="#pvm" class="btn btn-default" type="button">
            <i class="fa fa-plus-square-o fa-lg"> OPERACIJOS</i>
        </a>
        <!-- Organizacijos -->
        <a data-toggle="modal" href="#organizaciju_sarasas" class="btn btn-default" type="button">
            <i class="fa fa-plus-square-o fa-lg"> ORGANIZACIJŲ SĄRAŠAS</i>
        </a>
    </div>


     <?php
     $this->load->view("knyga/naujas_irasas_view",array('dt'=> $dt, 'men' => $men));
     ?>

    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1">PIRKIMO IR PARDAVIMO OPERACIJOS</a></li>
            <li class=""><a data-toggle="tab" href="#tab-2">PINIGŲ OPERACIJOS</a></li>
            <li class=""><a data-toggle="tab" href="#tab-2">This is second tab 3</a></li>
            <li class=""><a data-toggle="tab" href="#tab-2">This is second tab 4</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                    <div class="table-responsive">
                        <h4><strong>
                                <p class="text-center">PIRKIMO IR PARDAVIMO OPERACIJOS</p>
                            </strong></h4><br><br>
                        <div class="pull-left">
                            <?php echo $this->linksniai->getName($inf['vardas'], 'kil')." ".$this->linksniai->getName($inf['pavarde'],'kil')." ūkis"; ?>
                        </div>
                        <div class="pull-right">
                            <?php
                            $num_day = cal_days_in_month(CAL_GREGORIAN, $inf['menesis'], $inf['metai']);
                            echo $inf['metai']." ".$men[$inf['menesis']-1]." 1 - ".$num_day;
                            ?>
                        </div>
                        <hr>
                        <?php
                        //var_dump($irasai);
                        $irasu_kiekis = count($irasai);
                        if($irasu_kiekis >0){
                        ?>
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <td rowspan=2><b>Data</b></td>
                                <td rowspan=2><b>Operacija</b></td>
                                <td rowspan=2><b>Kiekis</b></td>
                                <td rowspan=2><b>Mato vnt.</b></td>
                                <td colspan=3><b>Pirkimas</b></td>
                                <td colspan=3><b>Pardavimas</b></td>
                                <td rowspan=2><b>Veiksmai</b></td>
                            </tr>
                            <tr>
                                <td>Vertė</td>
                                <td>PVM</td>
                                <td>Kodas</td>
                                <td>Vertė</td>
                                <td>PVM</td>
                                <td>Kodas</td>
                            </tr>
                            </thead>
                            <tbody
                            <?php
                            foreach ($irasai as $irasas){
                                echo"<tr>";
                                echo"<td>".$irasas['metai']."-".$irasas['menesis']."-".$irasas['diena']."</td>";
                                echo"<td>".$irasas['pavadinimas']."</td>";
                                echo"<td>".$irasas['kiekis']."</td>";
                                echo"<td>".$irasas['mato_vnt']."</td>";
                                echo"<td></td>";
                                echo"<td></td>";
                                echo"<td></td>";
                                echo"<td>".$irasas['verte']."</td>";
                                echo"<td>".$irasas['tarifas']."</td>";
                                echo"<td>".$irasas['kodas']."</td>";
                                echo"<td>";
                                echo"<a data-toggle='modal' href='#redaguoti-form' id='.$data[$i].'>Red</a> |
                            <a data-toggle='modal' href='#istrinti-form' id='.$data[$i].'>Išt</a>
                            </td>";
                                echo"</tr>";
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- Spauzdinti myktukas -->
                    <div class="form-group">
                        <button class="btn btn-block btn-outline btn-primary" type="button" onclick="PrintElem('.table-responsive')">
                            <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
                        </button>
                    </div>
                    <?php
                    }else{
                        echo"<div class=\"alert alert-info\">";
                        echo $inf['metai']." ".$this->linksniai->getName($men[$inf['menesis']-1], "kil")." mėnesį, įrasų nerasta";
                        echo"</div>";
                    }
                    ?>
                </div>
            </div>
            <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>

                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>

            <div id="tab-3" class="tab-pane">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>

                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>
        </div>


    </div>


    <!-- Pagrindinis langas -->

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Pagrindinis</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">

        </div>
    </div>
</div>


