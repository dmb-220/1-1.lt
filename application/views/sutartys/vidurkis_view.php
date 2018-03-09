<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Pasirinkite laikotarpį</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#galviju_skirstymas">Galvijų skirtymas</button>
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#zemes_skirstymas">Žemės skirtymas</button>
            <hr>
            <form class="form-bordered" action="<?= base_url(); ?>sutartys/vidurkis"  method="POST">
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-6">
                            <select name="rinktis" id="rinktis" class="form-control">
                                <option value="1" selected>Galvijų vidurkis</option>
                                <option value="2">Žemės vidurkis</option>
                            </select>
                        </div>
                            <div class="col-md-6">
                                <button class="btn btn-block btn-info" type="submit">
                                    <span class="fa fa-download text-white"></span> PASIRINKTI RUŠIAVIMĄ
                                </button>
                            </div>
                        </div>
                </fieldset
            </form>
            <br>
            <?php
            //echo $this->main_model->info['txt']['rinktis'];
            ?>
        <div class="table-responsive" id="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Ūkininkas</th>
                    <th>Ūkis</th>
                    <th>Banda</th>
                    <th>Dydis</th>
                    <th>Galvijai</th>
                    <th>Žemė</th>
                    <th>Menesis</th>
                    <th>Metai</th>
                    <th>Ūkio dydis</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //var_dump($data); die;
                $aa = array("", "galviju_vidurkis", "zemes_vidurkis", "suma_uz_menesi", "suma_uz_metus");

                function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
                    $sort_col = array();
                    foreach ($arr as $key=> $row) {
                        $sort_col[$key] = $row[$col];
                    }

                    array_multisort($sort_col, $dir, $arr);
                }

                array_sort_by_column($data, $aa[$this->main_model->info['txt']['rinktis']]);


                foreach($data as $row) {?>
                    <tr>
                        <td><?php echo $row['vardas']." ".$row['pavarde']; ?></td>
                        <td><?php echo $row['ukio_tipas']; ?></td>
                        <td><?php echo $row['banda']; ?></td>
                        <td><?php echo $row['galviju_kodas']." - ".$row['zemes_kodas']; ?></td>
                        <td><?php echo "Galvijų vidurkis: " . $row['galviju_vidurkis']; ?></td>
                        <td><?php echo "Žemės vidurkis: " . $row['zemes_vidurkis']; ?></td>
                        <td><?php echo $row['suma_uz_menesi']; ?></td>
                        <td><?php echo $row['suma_uz_metus']; ?></td>
                        <td><form action='<?= base_url(); ?>sutartys/ukio_dydis' method='POST'>
                                <input type="hidden" value="<?= $row['valdos_nr']; ?>" name="ukio_id[]">
                                <select name='dydis[]' class='form-control' onchange='if(this.value != 0) { this.form.submit(); }'>
                            <?php
                            echo"<option value='0'>Pasirinkite...</option>";
                               for($i = 1; $i < 6; $i++ ){
                                   if($row['dydis'] == $i){echo"<option value='$i' selected>$i</option>";}else{
                                       echo"<option value='$i'>$i</option>";
                                   }
                               }
                               echo"</select></form>";
                            ?>
                        </td>
                    </tr>

                <?php } ?>
                </tbody>
            </table>
    </div>
        <div class="form-group">
            <button class="btn btn-block btn-outline btn-primary" type="button" onclick="printDiv('table-responsive')">
                <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
            </button>
        </div>
        </div>

        <!-- Modal -->
        <div id="galviju_skirstymas" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Galvijų skirstymas</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Kodas</th>
                                <th>Kiekis</th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php
                        foreach ($this->sutartys_model->galviju as $row){
                            echo"<tr>";
                            echo"<td>".$row['kodas']."</td>";
                            echo"<td>".$row["kiekis"]."</td>";
                            echo"</tr>";
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
                    </div>
                </div>

            </div>
        </div>

        <div id="zemes_skirstymas" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Žemės skirstymas</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Kodas</th>
                                <th>Kiekis</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($this->sutartys_model->ploto as $row){
                                echo"<tr>";
                                echo"<td>".$row['kodas']."</td>";
                                echo"<td>".$row["kiekis"]."</td>";
                                echo"</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>