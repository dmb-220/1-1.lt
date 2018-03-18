<?php
$dt = $this->session->userdata();
//$sa = $this->zalia_knyga_model->nuskaityti_saskaitas();
//var_dump($sa);
?>

<div class="wrapper wrapper-content" id="zalia_knyga">
    <div class="ibox float-e-margins">

        <div class="ibox-content">
        <!-- Klaidu pranesimai is, naujo PVM tarifo sukurimo  -->
        <?php /*
        //i masyva surasom klaidu pavadinimus(masyvo raktai)
        $array_error = array("pvm_ok", "pvm_yra", "pvm_error", "irasas_yra", "irasas_ok");
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
        }*/
        ?>
            <hr>
        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#naujas_irasas" v-on:click="gauti_sarasa">
            <span class="fa fa-pencil-square-o fa-2x text-info"></span> <br/>Naujas įrašas
        </button>
        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#organizaciju_sarasas">
            <span class="fa fa-pencil-square-o fa-2x text-info"></span> <br/>Organizacijos
        </button>
            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#pvm">
                <span class="fa fa-pencil-square-o fa-2x text-info"></span> <br/>PVM klasifikatorius
            </button>
        <hr>
        <div id="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Dokumento numeris</th>
                    <th>Data</th>
                    <th>Organizacija</th>
                    <th>Dokumento rūšis</th>
                    <th>Kiekis</th>
                    <th>Mato vienetas</th>
                    <th>Atsiskaitymas</th>
                    <th>Atsiskaitymo terminas</th>
                    <th>Suma be PVM</th>
                    <th>PVM suma</th>
                    <th>Bendra suma</th>
                    <th>PVM kodas</th>
                    <th>VEIKSMAI</th>
                </tr>
                </thead>
                <tbody>
                <tr is="tr-item"
                    v-for="item in zalia_knyga"
                    v-bind:todo="item"
                    v-bind:vnt="vnt"
                    v-bind:eur="eur"
                    v-bind:rusis="dokumento_rusis">
                </tr>
                </tbody>
            </table>
        </div>

         <?php
         $this->load->view("knyga/naujas_irasas_view",array('dt'=> $dt, 'men' => $men));
         $this->load->view("knyga/nauja_pvm");
         $this->load->view("knyga/nauja_organizacija");
         $this->load->view("knyga/laikotarpio_pasirinkimas");
         ?>
        </div>
</div>


