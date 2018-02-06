<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Gyvulių sąrašas</h5>
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
        <div class="table-responsive">
            <div class="text-center">
                <h4><strong>GYVULIŲ SĄRAŠAS
                    </strong></h4>
            </div>
            <br><br>
            <div class="pull-left">
                <?php echo $this->linksniai->getName($this->main_model->info['txt']['vardas'], 'kil')." 
                ".$this->linksniai->getName($this->main_model->info['txt']['pavarde'],'kil')." ūkis"; ?>
            </div>
            <div class="pull-right">
                <?php
                $num_day = @cal_days_in_month(CAL_GREGORIAN, $this->main_model->info['txt']['menesis'], $this->main_model->info['txt']['metai']);
                echo $this->main_model->info['txt']['metai']." ".$this->main_model->menesiai[$this->main_model->info['txt']['menesis']-1]." 1 - ".$num_day;
                ?>
            </div>
            <hr>
            Sutartinis žymėjimas:
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Karvė (Karvė)</th>
                    <th>Telyčaitė (Telyčaitė)</th>
                    <th>Buliukas (Buliukas)</th>
                    <th>Telyčaitė (Karvė)</th>
                    <th>Iškeliavęs gyvulys</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td bgcolor="#faebd7"></td>
                    <td bgcolor="#f0e68c"></td>
                    <td bgcolor="#90ee90"></td>
                    <td bgcolor="#add8e6"></td>
                    <td bgcolor="#dc143c"></td>
                </tr>
                </tbody>
            </table>

            <hr>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Numeris</th>
                    <th>Lytis</th>
                    <th>Veislė</th>
                    <th>Gimimo data</th>
                    <th>Laikymo pradžia</th>
                    <th>Laikymo pabaiga</th>
                    <th>Amžius</th>
                    <th>Informacija</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach($gyvu as $col){
                    switch ($col['lytis']) {
                        case "Karvė (Karvė)": echo'<tr bgcolor="#faebd7">'; break;
                        case "Telyčaitė (Telyčaitė)": echo'<tr bgcolor="#f0e68c">'; break;
                        case "Buliukas (Buliukas)": echo'<tr bgcolor="#90ee90">'; break;
                        case "Telyčaitė (Karvė)": echo'<tr bgcolor="#add8e6">'; break;
                        default: echo'<tr>';
                    }

                    foreach($col as $row){
                        if($row == ""){
                            echo "<td bgcolor='#dc143c'>".$row."</td>";
                        }else{
                            echo "<td>".$row."</td>";
                        }
                    }
                    echo"</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
        }
        ?>
    </div>
</div>
