<?php
$men = array("Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsejis", "Spalis","Lapkritis", "Gruodis");
?>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Informacija</h5>
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
        }else{
        ?>
        <div class="table-responsive" id="table-responsive">
            <div class="text-center">
                <h4><strong>GYVULIŲ APSKAITOS LENTELĖ</strong></h4>
            </div>
            <br><br>
            <div class="pull-left">
                <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                        ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
            </div>
            <div class="pull-right">
                <?php
                $num_day = cal_days_in_month(CAL_GREGORIAN, $this->main_model->info['txt']['menesis'], $this->main_model->info['txt']['metai']);
                echo $this->main_model->info['txt']['metai']." ".$men[$this->main_model->info['txt']['menesis']-1]." 1 - ".$num_day;
                ?>
            </div>
            <hr>
            <?php
            if($this->main_model->info['txt']['banda'] == 1){$karves = 'Melžiamos karvės';}else
                if($this->main_model->info['txt']['banda'] == 2){$karves = 'Mėsinės karvės';}else{
                    $karves = 'Karvės';}

            if($this->main_model->info['txt']['banda'] == 1 || $this->main_model->info['txt']['banda'] == 2) {
                ?>
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


                    $pavad = array($karves, 'Veršeliai iki 1m.', 'Telyčios 1-2 m.', 'Buliai 1-2 m.', 'Tel. virš 2 m.', 'Buliai 2 m. ir daugiau', 'Iš viso:');
                    foreach ($this->galvijai_model->galvijai as $key => $col) {
                        $ss = $col['pradzia'] + $col['pirkimai'] + $col['gimimai'] - $col['j_is'] + $col['j_i'] - $col['kritimai'] - $col['suvartota'] - $col['parduota'];
                        if ($col['pabaiga'] != $ss) {
                            echo '<tr class="danger">';
                        } else {
                            echo '<tr>';
                        }
                        echo "<td>";
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
                <?php
            }else if($this->main_model->info['txt']['banda'] == 3){ ?>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th rowspan="2">Gyvuliai</th>
                        <th colspan="2">Mėnesio pradžioje</th>
                        <th colspan="2">Gimimai</th>
                        <th colspan="2">
                            <a data-toggle="modal" data-target="#pirkimai">Pirkimai</a>
                        </th>
                        <th colspan="2">Judėjimas IŠ</th>
                        <th colspan="2">Judėjimas Į</th>
                        <th colspan="2">Kritimai</th>
                        <th colspan="2">Suvartota ūkyje</th>
                        <th colspan="2">
                            <a data-toggle="modal" data-target="#pardavimai">Parduota</a>
                        </th>
                        <th colspan="2">Mėnesio pabaigoje</th>
                    </tr>
                    <tr>
                        <th>Pien.</th>
                        <th>Mės.</th>
                        <th>Pien.</th>
                        <th>Mės.</th>
                        <th>Pien.</th>
                        <th>Mės.</th>
                        <th>Pien.</th>
                        <th>Mės.</th>
                        <th>Pien.</th>
                        <th>Mės.</th>
                        <th>Pien.</th>
                        <th>Mės.</th>
                        <th>Pien.</th>
                        <th>Mės.</th>
                        <th>Pien.</th>
                        <th>Mės.</th>
                        <th>Pien.</th>
                        <th>Mės.</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $x = 0; $ss = 0;
                    $pavad = array($karves, 'Veršeliai iki 1m.', 'Telyčios 1-2 m.', 'Buliai 1-2 m.', 'Tel. virš 2 m.', 'Buliai 2 m. ir daugiau', 'Iš viso:');
                    foreach ($this->galvijai_model->galvijai as $key => $col) {
                        $ss = $col['pradzia'] + $col['pirkimai'] + $col['gimimai'] - $col['j_is'] + $col['j_i'] - $col['kritimai'] - $col['suvartota'] - $col['parduota'];
                        if ($col['pabaiga'] != $ss) {
                            echo '<tr class="danger">';
                        } else {
                            echo '<tr>';
                        }
                        echo "<td>";
                        echo $pavad[$x];
                        echo "</td>";
                        foreach ($col as $ke => $row) {
                            //pieniniai
                            echo "<td><b>";
                            if ($row != 0) { echo $row; }
                            echo "</b></td>";
                            //mesiniai
                            echo "<td><b>";
                            if ($this->galvijai_model->mesiniai[$key][$ke] != 0) { echo $this->galvijai_model->mesiniai[$key][$ke]; }
                            echo "</b></td>";
                        }
                        echo "</tr>";
                        $x++;
                    }

                    ?>
                    <tr class="info">
                        <th></th>
                        <th colspan="2"><?php if($this->galvijai_model->mesiniai['viso']['pradzia'] + $this->galvijai_model->galvijai['viso']['pradzia'] > 0){
                            echo $this->galvijai_model->mesiniai['viso']['pradzia'] + $this->galvijai_model->galvijai['viso']['pradzia'];} ?></th>
                        <th colspan="2"><?php if($this->galvijai_model->mesiniai['viso']['gimimai'] + $this->galvijai_model->galvijai['viso']['gimimai'] > 0){
                            echo $this->galvijai_model->mesiniai['viso']['gimimai'] + $this->galvijai_model->galvijai['viso']['gimimai'];} ?></th>
                        <th colspan="2"><?php if($this->galvijai_model->mesiniai['viso']['pirkimai'] + $this->galvijai_model->galvijai['viso']['pirkimai'] > 0){
                            echo $this->galvijai_model->mesiniai['viso']['pirkimai'] + $this->galvijai_model->galvijai['viso']['pirkimai'];} ?></th>
                        <th colspan="2"><?php if($this->galvijai_model->mesiniai['viso']['j_is'] + $this->galvijai_model->galvijai['viso']['j_is'] > 0){
                            echo $this->galvijai_model->mesiniai['viso']['j_is'] + $this->galvijai_model->galvijai['viso']['j_is'];} ?></th>
                        <th colspan="2"><?php if($this->galvijai_model->mesiniai['viso']['j_i'] + $this->galvijai_model->galvijai['viso']['j_i'] > 0){
                            echo $this->galvijai_model->mesiniai['viso']['j_i'] + $this->galvijai_model->galvijai['viso']['j_i'];} ?></th>
                        <th colspan="2"><?php if($this->galvijai_model->mesiniai['viso']['kritimai'] + $this->galvijai_model->galvijai['viso']['kritimai'] > 0){
                            echo $this->galvijai_model->mesiniai['viso']['kritimai'] + $this->galvijai_model->galvijai['viso']['kritimai'];} ?></th>
                        <th colspan="2"><?php if($this->galvijai_model->mesiniai['viso']['suvartota'] + $this->galvijai_model->galvijai['viso']['suvartota'] > 0){
                            echo $this->galvijai_model->mesiniai['viso']['suvartota'] + $this->galvijai_model->galvijai['viso']['suvartota'];} ?></th>
                        <th colspan="2"><?php if($this->galvijai_model->mesiniai['viso']['parduota'] + $this->galvijai_model->galvijai['viso']['parduota'] > 0){
                            echo $this->galvijai_model->mesiniai['viso']['parduota'] + $this->galvijai_model->galvijai['viso']['parduota'];} ?></th>
                        <th colspan="2"><?php if($this->galvijai_model->mesiniai['viso']['pabaiga'] + $this->galvijai_model->galvijai['viso']['pabaiga'] > 0){
                            echo $this->galvijai_model->mesiniai['viso']['pabaiga'] + $this->galvijai_model->galvijai['viso']['pabaiga'];} ?></th>
                    </tr>
                    </tbody>
                </table>
                <?php } ?>
        </div>
        <div class="form-group">
            <button class="btn btn-block btn-outline btn-primary" type="button" onclick="printDiv('table-responsive')">
                <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
            </button>
        </div>
        <?php } ?>
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
                $par = array('karves' => "Karvės", 'verseliai' => "Veršeliai", 'telycios_12' => "Telyčios 1-2 m.",
                'buliai_12' => "Buliai 1-2 m.", 'telycios_24' => "Telyčios virš 2 m.", 'buliai_24' => "Buliai virš 2 m.",
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
                $par = array('karves' => "Karvės", 'verseliai' => "Veršeliai", 'telycios_12' => "Telyčios 1-2 m.",
                'buliai_12' => "Buliai 1-2 m.", 'telycios_24' => "Telyčios virš 2 m.", 'buliai_24' => "Buliai virš 2 m.",
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