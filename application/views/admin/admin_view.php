<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Dashboard</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center alert alert-info">
                        <h2>Grupių sąrašas</h2>
                    </div>
                    <div class="pull-right">
                        <button type='button' data-toggle='modal' data-target='#sukurti' class='btn btn-outline btn-success'>
                            <span class='fa fa-check-square-o fa-lg' aria-hidden='true'></span>
                            <span><strong>Sukurti naują grupę</strong></span>
                        </button>
                    </div>
                    <?php
                    $groups = $this->ion_auth->groups()->result();
                    ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Grupė</th>
                            <th>Aprasymas</th>
                            <th>Nariai</th>
                            <th>Veiksmai</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                foreach($groups as $col){
                    echo "<td>".$col->id."</td>";
                    echo "<td>".$col->name."</td>";
                    echo "<td>".$col->description."</td>";
                    echo "<td>".$this->admin_model->count_group_users($col->id)."</td>";
                    echo"<td>
                        <button type='button' data-toggle='modal' data-target='#prideti' data-id='".$col->id."' data-name='".$col->description."' class='btn btn-outline btn-default'>
                        <span class='glyphicon glyphicon-plus' aria-hidden='true'></span>
                        </button>
                        <button type='button' data-toggle='modal' data-target='#delete' class='btn btn-outline btn-default'>
                        <span class='glyphicon glyphicon-minus' aria-hidden='true'></span>
                        </button>
                        <b>-</b>
                        <button type='button' data-toggle='modal' data-target='#edit' class='btn btn-outline btn-info'>
                            <span class='glyphicon glyphicon-edit' aria-hidden='true'></span>
                        </button>
                        <button type='button' data-toggle='modal' data-target='#delete' class='btn btn-outline btn-danger'>
                            <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                        </button>
                        </td>";
                    echo"</tr>";
                }
                        ?>
                    </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <div class="text-center alert alert-info">
                        <h2>...</h2>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center alert alert-info">
                        <h2>Vartotojai</h2>
                    </div>
                    <?php
                    $users = $this->ion_auth->users()->result();
                    //var_dump($users);
                    ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vartotojo vardas</th>
                            <th>El. paštas</th>
                            <th>Vardas</th>
                            <th>Pavardė</th>
                            <th>Įmonė</th>
                            <th>Telefonas</th>
                            <th>Veiksmai</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach($users as $col){
                            echo "<td>".$col->id."</td>";
                            echo "<td>".$col->username."</td>";
                            echo "<td>".$col->email."</td>";
                            echo "<td>".$col->first_name."</td>";
                            echo "<td>".$col->last_name."</td>";
                            echo "<td>".$col->company."</td>";
                            echo "<td>".$col->phone."</td>";
                            echo"<td>
                        <button type='button' data-toggle='modal' data-target='#edit' class='btn btn-outline btn-info'>
                            <span class='glyphicon glyphicon-edit' aria-hidden='true'></span>
                        </button>
                        <button type='button' data-toggle='modal' data-target='#delete' class='btn btn-outline btn-danger'>
                            <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                        </button>
                        </td>";
                            echo"</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-4">
                    .col-md-4
                </div>
                <div class="col-md-4">
                    .col-md-4
                </div>
                <div class="col-md-4">
                    .col-md-4
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="prideti" role="dialog" aria-labelledby="pridetiLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Uždaryti">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="pridetiLabel">New message</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Grupės pavadinimas:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name-2" class="control-label">Grupės ID:</label>
                        <input type="text" class="form-control" id="recipient-name-2">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Aprasymas:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">UŽDARYTI</button>
                <button type="button" class="btn btn-primary">PRIDĖTI</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="sukurti">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Uždaryti">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Sukurti naują grupę</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>admin/sukurti_grupe" method="POST">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Pavadinimas:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="pavadinimas" id="pavadinimas">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Aprašymas:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="aprasymas" id="aprasymas">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2"></label>
                        <div class="col-md-10 col-sm-10">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> SUKURTI GRUPĘ</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>