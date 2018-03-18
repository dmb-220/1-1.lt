<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Ukininkai</h5>
        <div class="ibox-tools">
            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            <a class="close-link"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="ibox-content">
        <div class="table-responsive" id="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Ūkininkas</th>
                    <th>Suma per metus</th>
                    <th>Sumokėjo 2017</th>
                    <th>Skola</th>
                    <th>Sumokėjo 2018</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //$metai = 2017; $men = 2;
                $sumokejo = 0;
                $sumokejo2 = 0;
                foreach($this->main_model->info['ukininkai'] as $row) {
                    $suma = $this->sutartys_model->sutarties_suma($row['valdos_nr'], "2017");
                    $metai = 2017; $men = 2;
                    $metai2 = 2018;
                    for($i=2; $i < 14; $i++){
                        if($i > 12){$met = $metai+1; $met2 = $metai2+1; $men = 1;}else{$met = $metai; $met2 = $metai2; $men = $i;}
                        //echo $met." - ".$men."<br>";
                        $sumokejo += $this->atsiskaitymas_model->ukis_sumokejo($row['valdos_nr'], $met, $men);
                        $sumokejo2 += $this->atsiskaitymas_model->ukis_sumokejo($row['valdos_nr'], $met2, $men);
                    }

                    ?>
                    <tr>
                        <td><?php echo $row['vardas']." ".$row['pavarde']; ?></td>
                        <td><?php echo $suma[0]['uz_metus']; ?></td>
                        <td><?php echo $sumokejo; ?></td>
                        <td><?php if($suma[0]['uz_metus'] > $sumokejo){echo $suma[0]['uz_metus'] - $sumokejo; echo" (".$suma[0]['uz_menesi'].")"; } ?></td>
                        <td><?php echo $sumokejo2; ?></td>
                    </tr>

                <?php
                    $sumokejo = 0;
                    $sumokejo2 = 0;
                } ?>
                </tbody>
            </table>
            <div class="form-group">
                <button class="btn btn-block btn-outline btn-primary" type="button" onclick="printDiv('table-responsive')">
                    <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
                </button>
            </div>
        </div>
        <?php
        //var_dump($this->main_model->info['ukininkai']);
        ?>
    </div>
</div>