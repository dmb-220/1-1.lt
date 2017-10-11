<?php if(!$this->main_model->info['error']['action']){ ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Įveskite, ieškomo pasėlio kodą</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    <a class="close-link"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>paseliai/redaguoti_kodas/read" method="POST">
                <fieldset>
                    <?php
                    if($this->main_model->info['error']["jau_yra"]){
                        echo'<div class="alert alert-info">';
                        echo $this->main_model->info['error']['jau_yra'];
                        echo '</div>';
                    }

                       if($this->main_model->info['error']["ok"]){
                        echo'<div class="alert alert-success">';
                        echo $this->main_model->info['error']['ok'];
                        echo '</div>';
                    }
                    if($this->main_model->info['error']["klaida"]){
                        echo'<div class="alert alert-success">';
                        echo $this->main_model->info['error']['klaida'];
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
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> IEŠKOTI</i>
                            </button>
                        </div>
                </fieldset>
            </form>
        </div>
    </div>
<?php }
?>

<?php if($this->main_model->info['error']['action']){ ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Redaguogite norimas reikšmes</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    <a class="close-link"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>paseliai/redaguoti_kodas/save" method="POST">
                <fieldset>
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
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> IRAŠYTI</i>
                            </button>
                        </div>
                </fieldset>
            </form>
        </div>
    </div>
<?php }
?>
    </div>
