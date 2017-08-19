<?php if(!$error['action']){ ?>
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
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>paseliai/redaguoti_kodas/read" method="POST">
                <fieldset>
                    <legend>Ieškoti pasėlių, pagal kodą</legend>
                    <?php
                    if($error["jau_yra"]){
                        echo'<div class="alert alert-info">';
                        echo $error['jau_yra'];
                        echo '</div>';
                    }

                       if($error["ok"]){
                        echo'<div class="alert alert-success">';
                        echo $error['ok'];
                        echo '</div>';
                    }
                    if($error["klaida"]){
                        echo'<div class="alert alert-success">';
                        echo $error['klaida'];
                        echo '</div>';
                    }

                    ?>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Pasėlio kodas</label>
                        <div class="col-md-6">
                            <?php echo form_error('kodas'); ?>
                            <input name="kodas" type="text" class="form-control" placeholder="" style="text-transform:uppercase">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-sm btn-primary m-r-5">Ieškoti</button>
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
<?php }
?>

<?php if($error['action']){ ?>
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
            <h4 class="panel-title">
                Pasėliai
            </h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>paseliai/redaguoti_kodas/save" method="POST">
                <fieldset>
                    <legend>Redaguoti pasėlius</legend>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Pasėlio duomenys:</label>
                        <div class="col-md-6">
                            <div class="row row-space-12">
                                <div class="col-md-6 m-b-15">
                                    <?php echo form_error('sutrumpinimas'); ?>
                                    <input type="text" name="kodas" class="form-control" value="<?= $dek['sutrumpinimas']; ?>" style="text-transform:uppercase" disabled>
                                    <input type="hidden" name="sutrumpinimas" class="form-control" value="<?= $dek['sutrumpinimas']; ?>" style="text-transform:uppercase">
                                </div>
                                <div class="col-md-6 m-b-15">
                                    <?php echo form_error('pavadinimas'); ?>
                                    <input type="text" name="pavadinimas" class="form-control" value="<?= $dek['pavadinimas']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Sėklų kiekis (kg), 1 ha. (nuo - iki)</label>
                        <div class="col-md-6">
                            <?php echo form_error('sekla'); ?>
                            <input name="sekla" type="text" class="form-control" value="<?= $dek['sekla']; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Derlius (kg), iš 1 ha.</label>
                        <div class="col-md-6">
                            <?php echo form_error('derlius'); ?>
                            <input name="derlius" type="text" class="form-control" value="<?= $dek['derlius']; ?>"/>
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
    <!-- end panel -->

</div>
<!-- end #content -->
<?php }
?>