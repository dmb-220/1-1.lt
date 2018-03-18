<!-- Itraukiamos naujos organizacijos -->
<div id="organizaciju_sarasas" class="modal fade modal-child" role="dialog" data-modal-parent="#naujas_irasas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Organizacijos</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>zalia_knyga/organizacija_irasas" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Organizacijos pavadinimas</label>
                            <div class="col-md-10">
                                <input name="pavadinimas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Įmonė kodas</label>
                            <div class="col-md-10">
                                <input name="kodas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">PVM kodas</label>
                            <div class="col-md-10">
                                <input name="pvm" type="text" class="form-control" placeholder= "" />
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
                        <td><b>Įmonės Kodas</b></td>
                        <td><b>PVM kodas</b></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->main_model->info['organizacijos'] as $org){
                        echo"<tr>";
                        echo"<td>".$org['pavadinimas']."</td>";
                        echo"<td>".$org['imones_kodas']."</td>";
                        if($org['pvm_kodas'] != ""){
                            echo"<td>".$org['pvm_kodas']."</td>";
                        }else{echo"<td> </td>";}
                        echo"</tr>";
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