<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Redaguoti</h5>
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
                    <th>...</th>
                    <th>Operacijos suma</th>
                    <th>Mokėtojas</th>
                    <th>Gavėjas</th>
                    <th>Mokejimo paskirtis</th>
                    <th>Bankas</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($this->main_model->info['israsas'] as $row){
                    echo "<tr>";
                    echo "<td>" . $row['debetas_kreditas'] . "</td>";
                    echo "<td class='text-right'>" . $row['operacijos_suma'] . "</td>";
                    echo "<td>" .$row['moketojas']. "</td>";
                    echo "<td>" . $row['gavejas'] . "</td>";
                    echo "<td>".$row['mokejimo_paskirtis']."</td>";
                    echo "<td>".$row['bankas_kurio_israsas']."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo'<td colspan="6" class="alert-info">'; ?>
                    <form class="form-inline" action="">
                        <input type="hidden" id="iraso_id" name="iraso_id" value="<?= $row['id'] ?>">
                        <div class="form-group">
                            <label for="debetas">Debetas:</label>
                            <input type="text" class="form-control" id="debetas" value="<?= $row['debetas'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="kreditas">Kreditas:</label>
                            <input type="text" class="form-control" id="kreditas" value="<?= $row['kreditas'] ?>">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-info" type="button" id="issaugoti">
                                <span class="fa fa-download text-white"></span>
                            </button>
                        </div>
                    </form>
                    <?php echo'</td>';
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>