<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Ganykliniai pašarai</h5>
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
                    <h4><strong>GYVULIŲ GANYKLINIŲ PAŠARŲ LENTELĖ</strong></h4>
                </div>
                <br><br>
                <div class="pull-left">
                    <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                        ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
                </div>
                <div class="pull-right">
                    <?php
                    $men = array("Visas sezonas", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis");
                    echo $this->main_model->info['txt']['metai']." sezonas: ";

                    if ($this->main_model->info['txt']['menesis']) {
                        echo"<b>".$this->main_model->menesiai[$this->main_model->info['txt']['menesis']-1]."</b>";
                    }
                    if ($this->main_model->info['txt']['laikotarpis']) {
                        echo"<b>".$this->main_model->info['txt']['laikotarpis'] . "</b>";
                    }
                    ?>
                </div>
                <hr>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Pavadinimas</th>
                        <th>Kiekis</th>
                        <th>Ganykliniai pašarai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $viso = 0;

                    foreach($this->galvijai_model->ganykliniai as $col){
                        echo'<tr>';
                        echo"<td>";  echo $col['pavadinimas'];  echo"</td>";
                        echo"<td>";  echo $col['kiek'];  echo"</td>";
                        echo"<td>";  echo $col['pasarai']/1000;  echo" t.</td>";
                        echo"</tr>";

                        $viso += $col['pasarai'];
                    }
                    echo"<tr>";
                    echo"<td class='success' colspan='2'><b>Viso</b></td>";
                    echo"<td class='danger'><b>";
                    echo $viso/1000;
                    echo" t.</b></td>";
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- Spauzdinti myktukas -->
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
