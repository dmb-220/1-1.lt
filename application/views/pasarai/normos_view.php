<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Lentelė su pašarų normomis</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>

        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#pasarai"> Pagrindiniai pašarai</a></li>
                <li class=""><a data-toggle="tab" href="#meslas">Mėšlas</a></li>
                <li class=""><a data-toggle="tab" href="#priesvoris">Priesvoris</a></li>
                <li class=""><a data-toggle="tab" href="#ganykliniai">Ganykliniai pašarai</a></li>
            </ul>
            <div class="tab-content">
                <div id="pasarai" class="tab-pane active">
                    <div class="panel-body">
                        <p class="text-right">
                            <a data-toggle="modal" href="#nauja_forma-form" class="btn btn-outline btn-info  dim"><i class="fa fa-plus"></i> PRIDĖTI NAUJĄ</a>
                        </p>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th border="1" class="hidden-xs">Gyvuliai</th>
                                <th>Šienas</th>
                                <th>Šiaudai</th>
                                <th>Grudai</th>
                                <th>Šakniavaisiai</th>
                                <th>Šienainis</th>
                                <th>Bulvės</th>
                                <th>Silosas</th>
                                <th>Runkeliai</th>
                                <th>VEIKSMAI</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for($i = 0; $i < count($data); $i++) {
                                echo"<tr >
                <td><strong>".$data[$i]['gyvuliai']."</strong></td >
                <td>".$data[$i]['sienas']." kg.</td >
                <td>".$data[$i]['siaudai']." kg.</td >
                <td>".$data[$i]['grudai']." kg.</td >
                <td>".$data[$i]['sakniavaisiai']."kg.</td >
                <td>".$data[$i]['sienainis']." kg.</td >
                <td>".$data[$i]['bulves']." kg.</td >
                <td>".$data[$i]['silosas']." kg.</td >
                <td>".$data[$i]['runkeliai']." kg.</td >
                <td><p class='text-center'>
                <a data-toggle='modal' href='#redaguoti-form' id=".$data[$i]['gid']." class='btn btn-outline btn-primary'><i class='fa fa-edit'></i></a>
                <!-- <a data-toggle='modal' href='#istrinti-form' id=".$data[$i]['gid']." class='btn btn-outline btn-danger'><i class='fa fa-trash'></i></a> -->
                </p></td>
            </tr >";
                            }?>
                            </tbody>

                        </table>
                    </div>
                </div>

                <div id="meslas" class="tab-pane">
                    <div class="panel-body">
                    lentele su meslu normomis
                </div>
                </div>

                <div id="priesvoris" class="tab-pane">
                    <div class="panel-body">
                        lentele su priesvorio normomis
                    </div>
                </div>

                <div id="ganykliniai" class="tab-pane">
                    <div class="panel-body">
                        lentele su ganykliniu pasaru normomis normomis
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>