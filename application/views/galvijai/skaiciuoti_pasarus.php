<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Galvijų pašarai</h5>
        <div class="ibox-tools">
            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            <a class="close-link"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="ibox-content">
        <?php
        //isvedamos klaidos
        if(count($this->main_model->info['error']) > 0){
            foreach ($this->main_model->info['error'] as $klaida){
                echo'<div class="alert alert-danger">';
                echo $klaida;
                echo '</div>';
            }
        }else {
            //var_dump($this->input->post());
            ?>
            <div class="table-responsive" id="table-responsive">
                <div class="text-center">
                    <h4><strong>GYVULIŲ PAŠARŲ LENTELĖ</strong></h4>
                </div>
                <br><br>
                <div class="pull-left">
                    <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil') . " 
                        " . $this->linksniai->getName($this->main_model->info['txt']['pavarde'], 'kil') . " ūkis"; ?>
                </div>
                <div class="pull-right">
                    <?php
                    if ($this->main_model->info['txt']['menesis']) {
                        $num_day = cal_days_in_month(CAL_GREGORIAN, $this->main_model->info['txt']['menesis'], $this->main_model->info['txt']['metai']);
                        echo $this->main_model->info['txt']['metai'] . " " . $this->main_model->menesiai[$this->main_model->info['txt']['menesis'] - 1] . " 1 - " . $num_day;
                    }
                    if ($this->main_model->info['txt']['laikotarpis']) {
                        echo $this->main_model->info['txt']['metai'] . " <b>" . $this->main_model->info['txt']['laikotarpis'] . "</b>";
                    }
                    ?>
                </div>
                <hr>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Gyvuliai</th>
                        <th>Kiek</th>
                        <th>Šienas</th>
                        <th>Šiaudai</th>
                        <th>Grudai</th>
                        <th>Šakniavaisiai</th>
                        <th>Šienainis</th>
                        <th>Bulves</th>
                        <th>Silosas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->galvijai_model->pasarai as $col) {
                        $ke = array_keys($col);
                        echo "<tr>";
                        for ($i = 0; $i < count($ke); $i++) {
                            echo "<td>";
                            if ($col[$ke[$i]] != 0 OR $col[$ke[$i]] != '') {
                                if ($ke[$i] == 'kiek') {
                                    echo $col[$ke[$i]];
                                    echo " vnt.";
                                } else if ($ke[$i] == 'pavadinimas') {
                                    echo $col[$ke[$i]];
                                } else {
                                    if ($col[$ke[$i]]['vid'] != 0 OR $col[$ke[$i]]['vid'] != '') {

                                        if ($this->main_model->info['txt']['rinktis'] == 4) {
                                            if ($col[$ke[$i]]['vid'] == $col[$ke[$i]]['min'] AND $col[$ke[$i]]['vid'] == $col[$ke[$i]]['max']) {
                                                echo round($col[$ke[$i]]['vid'] / 1000, 2) . " t.<br>";
                                            } else {
                                                echo "MIN: " . round($col[$ke[$i]]['min'] / 1000, 2) . " t.<br>";
                                                echo "VID: " . round($col[$ke[$i]]['vid'] / 1000, 2) . " t.<br>";
                                                echo "MAX: " . round($col[$ke[$i]]['max'] / 1000, 2) . " t.";
                                            }
                                        }
                                        if ($this->main_model->info['txt']['rinktis'] == 3) {
                                            echo round($col[$ke[$i]]['max'] / 1000, 2) . " t.";
                                        }
                                        if ($this->main_model->info['txt']['rinktis'] == 2) {
                                            echo round($col[$ke[$i]]['vid'] / 1000, 2) . " t.";
                                        }
                                        if ($this->main_model->info['txt']['rinktis'] == 1) {
                                            echo round($col[$ke[$i]]['min'] / 1000, 2) . " t.";
                                        }
                                    }
                                }
                            }
                            echo "</td>";
                        }
                        echo "</tr>";
                    }

                    ?>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-outline btn-primary" type="button" onclick="printDiv('table-responsive')">
                    <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
                </button>
            </div>
            <?php
        }
        ?>
    </div>
</div>
