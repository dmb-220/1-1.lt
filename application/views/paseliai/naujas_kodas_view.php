<!-- begin #content -->
<div id="content" class="content">
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Pasėliai</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>paseliai/naujas_kodas" method="POST">
                <fieldset>
                    <legend>Nauji pasėlių kodai</legend>
                    <?php
                        if($error["ok"]){
                            echo'<div class="alert alert-success">';
                            echo $error['ok'];
                            echo '</div>';
                        }
                        if($error["jau_yra"]){
                            echo'<div class="alert alert-info">';
                            echo $error['jau_yra'];
                            echo '</div>';
                        }
                    ?>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Naujo paselio įvedimas:</label>
                        <div class="col-md-6">
                            <div class="row row-space-12">
                                <div class="col-md-6 m-b-15">
                                    <?php echo form_error('kodas'); ?>
                                    <input type="text" name="kodas" class="form-control" placeholder="Kodas" style="text-transform:uppercase">
                                </div>
                                <div class="col-md-6 m-b-15">
                                    <?php echo form_error('pavadinimas'); ?>
                                    <input type="text" name="pavadinimas" class="form-control" placeholder="Pavadinimas">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Sėklų kiekis (kg), 1 ha. (nuo - iki)</label>
                        <div class="col-md-6">
                            <?php echo form_error('sekla'); ?>
                            <input name="sekla" type="text" class="form-control" placeholder=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Derlius (kg), iš 1 ha.</label>
                        <div class="col-md-6">
                            <?php echo form_error('derlius'); ?>
                            <input name="derlius" type="text" class="form-control" placeholder=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-sm btn-primary m-r-5">Įrašyti</button>
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
<!-- end panel -->
</div>
<!-- end #content -->