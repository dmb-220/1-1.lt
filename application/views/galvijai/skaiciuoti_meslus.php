<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Galvijų mėšlas</h5>
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
                    <h4><strong>GYVULIŲ MĖŠLO LENTELĖ</strong></h4>
                </div>
                <br><br>
                <div class="pull-left">
                    <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                        ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
                </div>
                <div class="pull-right">
                    <?php
                    $sezo = $this->main_model->info['txt']['metai']-1;
                    echo $sezo." - ".$this->main_model->info['txt']['metai']." sezonas: ";
                    if ($this->main_model->info['txt']['menesis']) {
                        echo"<b>".$this->main_model->info['txt']['metai_2']." ".$this->main_model->menesiai[$this->main_model->info['txt']['menesis']-1]."</b>";
                    }
                    if ($this->main_model->info['txt']['laikotarpis']) {
                        echo $this->main_model->info['txt']['metai_2'] . " <b>" . $this->main_model->info['txt']['laikotarpis'] . "</b>";
                    }
                    ?>
                </div>
                <hr>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Pavadinimas</th>
                        <th>Kiekis</th>
                        <th>Mėslas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $viso = 0;

                    foreach($this->galvijai_model->meslas as $col){
                        echo'<tr>';
                        echo"<td>";  echo $col['pavadinimas'];  echo"</td>";
                        echo"<td>";  echo $col['kiek'];  echo"</td>";
                        echo"<td>";  echo $col['meslas'];  echo" t.</td>";
                        echo"</tr>";

                        $viso += $col['meslas'];
                    }
                    echo"<tr>";
                    echo"<td class='success' colspan='2'><b>Viso</b></td>";
                    echo"<td class='danger'><b>".$viso." t.</b></td>";
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
