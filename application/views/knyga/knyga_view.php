<?php
$dt = $this->session->userdata();
//$sa = $this->zalia_knyga_model->nuskaityti_saskaitas();
//var_dump($sa);
?>

<div class="wrapper wrapper-content" id="zalia_knyga">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
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
                    <tr v-for="todo in zalia_knyga">
                        <td>{{ todo.numeris }}</td>
                        <td>{{ todo.metai }}-{{todo.menesis}}-{{ todo.diena }}</td>
                        <td>{{ todo.pavadinimas }}</td>
                        <td>{{ dokumento_rusis[todo.dokumento_rusis].pavadinimas }}</td>
                        <td>{{ todo.kiekis }}</td>
                        <td>{{ vnt[todo.mato_vnt] }}</td>
                        <td>{{ eur[todo.atsiskaitymas] }}</td>
                        <td>{{ todo.atsiskaitymo_data }}</td>
                        <td>{{ todo.be_PVM}}</td>
                        <td>{{ todo.PVM }}</td>
                        <td>{{ parseFloat(todo.be_PVM) + parseFloat(todo.PVM) }}</td>
                        <td>{{ todo.kodas }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" @click="showingeditModal = true; knyga_redaguoti(todo)">E</button>
                                <button type="button" class="btn btn-danger" @click="showingeditModal = true; knyga_istrinti(todo)">D</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div id="editmodal" class="modal fade" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Redaguoti įrašą</h4>
                        </div>
                        <div class="modal-body">
                            {{ redaguoti_irasa }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="deletemodal" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ištrinti įrašą</h4>
                        </div>
                        <div class="modal-body">
                            {{ istrinti_irasa }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
             $this->load->view("knyga/naujas_irasas_view",array('dt'=> $dt, 'men' => $men));
             $this->load->view("knyga/nauja_pvm");
             $this->load->view("knyga/nauja_organizacija");
             $this->load->view("knyga/laikotarpio_pasirinkimas");
             ?>
        </div>
    </div>
</div>


