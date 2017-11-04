<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Sutarties skaičiuoklės</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <?php
            //var_dump($data);
            ?>
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#darbo_sutartis"> DARBO SUTARTIS</a></li>
                    <li class=""><a data-toggle="tab" href="#paslaugu_teikimas"> PASLAUGŲ TEIKIMO SUTARTIS</a></li>
                </ul>
                <div class="tab-content">
                    <div id="darbo_sutartis" class="tab-pane active">
                        <div class="panel-body">
                            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>sutartys/gyvunai" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų turtas:</label>
                                        <div class="col-md-10">
                                            <input name="turtas" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų nuosavybė:</label>
                                        <div class="col-md-10">
                                            <input name="nuosavybe" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų pajamos:</label>
                                        <div class="col-md-10">
                                            <input name="pajamos" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Praeitų metų sąnaudos:</label>
                                        <div class="col-md-10">
                                            <input name="sanaudos" type="text" class="form-control" placeholder= "" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2"></label>
                                        <div class="col-md-10 col-sm-10">
                                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                                <i class="fa fa-check-circle-o fa-lg"> SUKURTI</i>
                                            </button>
                                        </div>
                                    </div>

                                </fieldset>
                            </form>
                        </div>
                    </div>

                    <div id="paslaugu_teikimas" class="tab-pane">
                        <div class="panel-body">
                            paslaugu teikimas
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
