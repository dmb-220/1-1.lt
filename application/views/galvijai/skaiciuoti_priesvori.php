<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Galvijų priesvoris</h5>
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
            ?>

            <div class="table-responsive" id="table-responsive">
                <div class="text-center">
                    <h4><strong>GYVULIŲ PRIESVORIO LENTELĖ</strong></h4>
                </div>
                <br><br>
                <div class="pull-left">
                    <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                        ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
                </div>
                <div class="pull-right">
                    <?php
                    if($this->main_model->info['txt']['menesis']){
                        $num_day = cal_days_in_month(CAL_GREGORIAN, $this->main_model->info['txt']['menesis'], $this->main_model->info['txt']['metai']);
                        echo $this->main_model->info['txt']['metai']." ".$this->main_model->menesiai[$this->main_model->info['txt']['menesis']-1]." 1 - ".$num_day;
                    }
                    ?>
                </div>
                <hr>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Pavadinimas</th>
                        <th>Kiekis</th>
                        <th>Priesvoris</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $viso = 0;

                    foreach($this->galvijai_model->priesvoris as $col){
                        echo'<tr>';
                        echo"<td>";  echo $col['pavadinimas'];  echo"</td>";
                        echo"<td>";  echo $col['kiek'];  echo"</td>";
                        echo"<td>";  echo $col['svoris'];  echo" kg.</td>";
                        echo"</tr>";

                        $viso += $col['svoris'];
                    }
                    echo"<tr>";
                    echo"<td class='success' colspan='2'><b>Viso:</b></td>";
                    echo"<td class='danger'><b>";
                    echo $viso;
                    echo" kg.</b></td>";
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
