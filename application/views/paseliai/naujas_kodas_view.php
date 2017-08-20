<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Įveskite naujo pasėliaus duomenis</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>paseliai/naujas_kodas" method="POST">
                <fieldset>
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
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> IŠSAUGOTI</i>
                            </button>
                        </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
<!-- end panel -->
</div>
<!-- end #content -->