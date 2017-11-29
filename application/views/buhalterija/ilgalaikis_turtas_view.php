<div id="ilg_turtas" class="tab-pane">
    <div class="panel-body">
        <div class="alert alert-success" role="alert">
            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#pradiniai_likuciai">
                <span class="fa fa-book fa-2x"></span> <br/>Pradiniai likučiai
            </button>
            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#apyvarta">
                <span class="fa fa-bar-chart-o fa-2x"></span> <br/>Apyvarta
            </button>
            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#fr0457">
                <span class="fa fa-building-o fa-2x"></span> <br/>FR0457
            </button>
            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#nusidevejimas">
                <span class="fa fa-exchange fa-2x"></span> <br/>Nusidėvėjimas
            </button>
            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#momentiniai_likuciai">
                <span class="fa fa-shopping-cart fa-2x"></span> <br/>Momentiniai likučiai
            </button>
            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#paramos_perskaiciavimas">
                <span class="fa fa-newspaper-o fa-2x"></span> <br/>Paramos perskaičiavimas
            </button>
        </div>
    </div>
</div>

<!-- pradiniai likuciai -->
<div id="pradiniai_likuciai" class="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pradiniai likučiai</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>buhalterija/pradiniai_likuciai" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Operacija</label>
                            <div class="col-md-8">
                                <input name="pavadinimas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2"></label>
                            <div class="col-md-8 col-sm-8">
                                <button class="btn btn-block btn-outline btn-primary" type="submit">
                                    <i class="fa fa-check-circle-o fa-lg"> ĮRAŠYTI</i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>

<!-- apyvarta -->
<div id="apyvarta" class="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Apyvarta</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" action="<?= base_url(); ?>buhalterija/apyvarta" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Operacija</label>
                            <div class="col-md-8">
                                <input name="pavadinimas" type="text" class="form-control" placeholder= "" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2"></label>
                            <div class="col-md-8 col-sm-8">
                                <button class="btn btn-block btn-outline btn-primary" type="submit">
                                    <i class="fa fa-check-circle-o fa-lg"> ĮRAŠYTI</i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>