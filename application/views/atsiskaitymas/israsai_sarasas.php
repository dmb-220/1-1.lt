<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Banko išrašo sarasas</h5>
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
                    <th colspan="2">Sąskaitos planas</th>
                    <th colspan="2">Likutis laikotarpio pradžioje</th>
                    <th colspan="2">Apyvarta per menesį</th>
                    <th colspan="2">Likutis laikotarpio pabaigai</th>
                </tr>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Kodas</th>
                    <th>Debetas</th>
                    <th>Kreditas</th>
                    <th>Debetas</th>
                    <th>Kreditas</th>
                    <th>Debetas</th>
                    <th>Kreditas</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //var_dump($this->atsiskaitymas_model->klases_suma(2, 0));
                $data = array();
                foreach ($this->main_model->info['saskaitu_planas'] as $row){
                    $debetas = $this->atsiskaitymas_model->gauti_debeta($row['kodas']);
                    $kreditas = $this->atsiskaitymas_model->gauti_kredita($row['kodas']);
                    //cia parodom visas klases
                    if($row['grupe'] == ""){
                        $grupes = $this->atsiskaitymas_model->klases_suma($row['klase'], 0);
                        $suma_deb = 0; $suma_kre = 0;
                        foreach ($grupes as $col){
                            $suma_deb += $this->atsiskaitymas_model->gauti_debeta($col['kodas']);
                            $suma_kre += $this->atsiskaitymas_model->gauti_kredita($col['kodas']);
                        }
                        echo "<tr>";
                        echo "<td class='text-left'><b>" . $row['pavadinimas'] . "</b></td>";
                        echo "<td class='text-right'><b>" . $row['kodas'] . "</b></td>";
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                        echo "<td><b>" . $suma_deb . "</b></td>";
                        echo "<td><b>" . $suma_kre . "</b></td>";
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                        echo "</tr>";
                    }

                    //cia rodom tik tuos irasus kurie turi piniginiu irasu
                    if($debetas || $kreditas) {
                        echo "<tr>";
                        echo "<td>" . $row['pavadinimas'] . "</td>";
                        echo "<td class='text-right'>" . $row['kodas'] . "</td>";
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                        echo "<td>" . $debetas . "</td>";
                        echo "<td>" . $kreditas . "</td>";
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                        echo "</tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>