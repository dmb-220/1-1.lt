<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Ūkininkų sąrašas</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Adresas</th>
                <th>Veiksmai</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($this->main_model->info['ukininkai'] as $row) {
                echo"<tr >
                <td>".$row['vardas']."</td >
                <td>".$row['pavarde']."</td >
                <td>".$row['adresas']."</td >
                <td>";
                /*<button type='button' data-toggle='modal' data-target='#view' id='btn_view' data-value='".$row['valdos_nr']."' class='btn btn-outline btn-default'>".$row['valdos_nr']."
                    <span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>
                    <span><strong>Peržiūrėti</strong></span>
                </button>
                <button type='button' data-toggle='modal' data-target='#edit' class='btn btn-outline btn-info'>
                    <span class='glyphicon glyphicon-edit' aria-hidden='true'></span>
                    <span><strong>Redaguoti</strong></span>
                </button>
                <button type='button' data-toggle='modal' data-target='#delete' class='btn btn-outline btn-danger'>
                    <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                    <span><strong>Ištrinti</strong></span>
                </button>*/
                echo"<a href='perziureti/".$row['valdos_nr']."'>Peržiūrėti</a> |<a href='redaguoti/".$row['valdos_nr']."'>Readaguoti</a> | <a href='istrinti/".$row['valdos_nr']."'>Ištrinti</a>";
                echo"</td>
            </tr >";
}?>
            </tbody>

        </table>
        </div>
    </div>
</div>

<div id="view" class="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Redaguoti ūkininka</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-4 control-label">Kiekis</label>
                    <div class="col-md-8">
                        <input name="kiekis" id="kiekis" type="text" class="form-control" placeholder= "" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>
