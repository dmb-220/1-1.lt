<!-- Itraukiamos nauja PVM reiksme -->
<div id="pvm" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Naujas PVM</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>zalia_knyga/pvm_irasas" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Operacija</label>
                            <div class="col-md-10">
                                <input name="pavadinimas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Kodas</label>
                            <div class="col-md-10">
                                <input name="kodas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Tarifas (%)</label>
                            <div class="col-md-10">
                                <input name="tarifas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pvz" class="col-md-2 control-label">Pavyzdžiai</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="3" name="pvz" id="pvz"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2"></label>
                            <div class="col-md-10">
                                <button class="btn btn-block btn-outline btn-primary" type="submit">
                                    <i class="fa fa-check-circle-o fa-lg"> ĮRAŠYTI</i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <hr>
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <td>Operacija</td>
                        <td><b>Kodas</b></td>
                        <td><b>Tarifas</b></td>
                        <td><b>...</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->main_model->info['pvm'] as $pvm){
                        echo"<tr>";
                        echo"<td>".$pvm['pavadinimas']."</td>";
                        if($pvm['kodas'] != ""){
                            echo"<td>".$pvm['kodas']."</td>";
                        }else{echo"<td>-</td>";}
                        if($pvm['tarifas'] != 0){
                            echo"<td>".$pvm['tarifas']."</td>";
                        }else{echo"<td> </td>";}
                        echo"<td>Redaguoti<br>Istrinti</td>";
                        echo"</tr>";
                        if($pvm['pvz']){
                            echo"<tr><td colspan='4'>".$pvm['pvz']."</td></tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>