<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Informacija </h5>
        <div class="ibox-tools">
            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            <a class="close-link"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="ibox-content">
        <?php
        //var_dump($this->galvijai_model->NEW_mesiniai);
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
                    <h4><strong>MĖSINIŲ GALVIJŲ APSKAITOS LENTELĖ</strong></h4>
                </div>
                <br><br>
                <div class="pull-left">
                    <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil') . " 
                        " . $this->linksniai->getName($this->main_model->info['txt']['pavarde'], 'kil') . " ūkis"; ?>
                </div>
                <div class="pull-right">
                    <?php
                    $num_day = cal_days_in_month(CAL_GREGORIAN, $this->main_model->info['txt']['menesis'], $this->main_model->info['txt']['metai']);
                    echo $this->main_model->info['txt']['metai'] . " " . $this->galvijai_model->menesiai[$this->main_model->info['txt']['menesis'] - 1] . " 1 - " . $num_day;
                    ?>
                </div>
                <hr>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Gyvuliai</th>
                        <th>Mėnesio pradžioje</th>
                        <th>Gimimai</th>
                        <th>
                            <a data-toggle="modal" data-target="#pirkimai">Pirkimai</a>
                        </th>
                        <th>Judėjimas IŠ</th>
                        <th>Judėjimas Į</th>
                        <th>Kritimai</th>
                        <th>Suvartota ūkyje</th>
                        <th>
                            <a data-toggle="modal" data-target="#pardavimai">Parduota</a>
                        </th>
                        <th>Mėnesio pabaigoje</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $x = 0;
                    $ss = 0;


                    $pavad = array(
                        'Žindomos telyčaitės iki  8 mėn.',
                        'Žindomi buliukai iki 8 mėn.',
                        'Mėsinės  telyčios nuo 8 mėn. iki 2 m.',
                        'Mėsiniai buliai nuo 8 mėn. iki 2 m.',
                        'Mėsinės telyčios nuo 2 m.',
                        'Mėsiniai buliai nuo 2 m. ir vyresni',
                        'Karvės žindenės',
                        'Iš viso:'
                    );

                    //CIKLAS, SUFORMUOJA LENTELE
                    foreach ($this->galvijai_model->NEW_mesiniai as $key => $col) {
                        $ss = $col['pradzia'] + $col['pirkimai'] + $col['gimimai'] - $col['j_is'] + $col['j_i'] - $col['kritimai'] - $col['suvartota'] - $col['parduota'];
                        if ($col['pabaiga'] != $ss) {
                            echo '<tr class="danger">';
                        } else {
                            echo '<tr>';
                        }
                        echo "<td class='text-left'>";
                        echo $pavad[$x];
                        echo "</td>";
                        foreach ($col as $row) {
                            echo "<td><b>";
                            if ($row != 0) {
                                echo $row;
                            }
                            echo "</b></td>";
                        }
                        echo "</tr>";
                        $x++;
                    }

                    ?>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-outline btn-primary" type="button"
                        onclick="printDiv('table-responsive')">
                    <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
                </button>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<!-- pardavimai galviju, kam parduota -->
<div id="pardavimai" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pardavimai</h4>
            </div>
            <div class="modal-body">

                <?php
                $par = array('karves' => "Karvės žindenės", 'telycios_8' => "Žindomos telyčaitės iki  8 mėn.", "buliai_8" => "Žindomi buliukai iki 8 mėn.",
                    'telycios' => "Mėsinės telyčios nuo 2 m.", 'buliai' => "Mėsiniai buliai nuo 2 m. ir vyresni",
                    'telycios_24' => "Mėsinės  telyčios nuo 8 mėn. iki 2 m.", "buliai_24" => "Mėsiniai buliai nuo 8 mėn. iki 2 m."
                );

                //var_dump($this->galvijai_model->pardavimai);
                foreach ($this->galvijai_model->pardavimai as $key => $pardavimai){
                    if(!empty($pardavimai)){
                        echo"<div class='text-center'><h2>".$par[$key]."</h2></div><hr>";
                        echo"<table class='table table-bordered table-hover'>
                                    <thead>
                                        <tr>
                                            <th>Numeris</th>
                                            <th>Kam parduota?</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                        foreach ($pardavimai as $row) {
                            $kam = str_replace("Įvykiai", " ", $row['kam']);
                            echo"<tr>
                                    <td><b>".$row['numeris']."</b></td>
                                    <td>".$kam."</td>
                                    </tr>";
                        }
                        echo"</tbody>
                                 </table>";
                        //var_dump($pardavimai);
                    }
                }
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>

<!-- pardavimai galviju, kam parduota -->
<div id="pirkimai" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pirkimai</h4>
            </div>
            <div class="modal-body">

                <?php
                $par = array('karves' => "Karvės žindenės", 'telycios_8' => "Žindomos telyčaitės iki  8 mėn.", "buliai_8" => "Žindomi buliukai iki 8 mėn.",
                    'telycios' => "Mėsinės telyčios nuo 2 m.", 'buliai' => "Mėsiniai buliai nuo 2 m. ir vyresni",
                    'telycios_24' => "Mėsinės  telyčios nuo 8 mėn. iki 2 m.", "buliai_24" => "Mėsiniai buliai nuo 8 mėn. iki 2 m."
                );

                //var_dump($this->galvijai_model->pardavimai);
                foreach ($this->galvijai_model->pirkimai as $key => $pardavimai){
                    if(!empty($pardavimai)){
                        echo"<div class='text-center'><h2>".$par[$key]."</h2></div><hr>";
                        echo"<table class='table table-bordered table-hover'>
                                    <thead>
                                        <tr>
                                            <th>Numeris</th>
                                            <th>Iš ko nupirkta?</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                        foreach ($pardavimai as $row) {
                            $kam = str_replace("Įvykiai", " ", $row['kam']);
                            echo"<tr>
                                    <td><b>".$row['numeris']."</b></td>
                                    <td>".$kam."</td>
                                    </tr>";
                        }
                        echo"</tbody>
                                 </table>";
                        //var_dump($pardavimai);
                    }
                }
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>