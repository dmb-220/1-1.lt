<!-- Pasaru normu langas  -->
<div id="pasaru_normos_langas" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-body">
                <p class="text-right">
                    <a data-toggle="modal" href="#nauja_forma-form" class="btn btn-outline btn-info  dim"><i class="fa fa-plus"></i> PRIDĖTI NAUJĄ</a>
                </p>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th border="1" class="hidden-xs">Gyvuliai</th>
                        <th>Šienas</th>
                        <th>Šiaudai</th>
                        <th>Grudai</th>
                        <th>Šakniavaisiai</th>
                        <th>Šienainis</th>
                        <th>Bulvės</th>
                        <th>Silosas</th>
                        <th>Runkeliai</th>
                        <th>VEIKSMAI</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for($i = 0; $i < count($this->main_model->info['pasarai']); $i++) {
                        echo"<tr >
                <td><strong>".$this->main_model->info['pasarai'][$i]['gyvuliai']."</strong></td >
                <td>".$this->main_model->info['pasarai'][$i]['sienas']." kg.</td >
                <td>".$this->main_model->info['pasarai'][$i]['siaudai']." kg.</td >
                <td>".$this->main_model->info['pasarai'][$i]['grudai']." kg.</td >
                <td>".$this->main_model->info['pasarai'][$i]['sakniavaisiai']."kg.</td >
                <td>".$this->main_model->info['pasarai'][$i]['sienainis']." kg.</td >
                <td>".$this->main_model->info['pasarai'][$i]['bulves']." kg.</td >
                <td>".$this->main_model->info['pasarai'][$i]['silosas']." kg.</td >
                <td>".$this->main_model->info['pasarai'][$i]['runkeliai']." kg.</td >
                <td><p class='text-center'>
                <a data-toggle='modal' href='#redaguoti-form' id=".$this->main_model->info['pasarai'][$i]['gid']." class='btn btn-outline btn-primary'><i class='fa fa-edit'></i></a>
                <!-- <a data-toggle='modal' href='#istrinti-form' id=".$this->main_model->info['pasarai'][$i]['gid']." class='btn btn-outline btn-danger'><i class='fa fa-trash'></i></a> -->
                </p></td>
            </tr >";
                    }?>
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="save">IŠSAUGOTI</button>
                <button type="button" data-dismiss="modal" class="btn">ATŠAUKTI</button>
            </div>
        </div>
    </div>
</div>

<!-- Patvirtinti jei nori istrinti galviju duomenis  -->
<div id="confirm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                Ar tikrai norite ištrinti galvijų duomenis?
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">IŠTRINTI</button>
                <button type="button" data-dismiss="modal" class="btn">ATŠAUKTI</button>
            </div>
        </div>
    </div>
</div>