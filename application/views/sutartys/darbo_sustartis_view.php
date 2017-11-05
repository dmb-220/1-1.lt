<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Darbo sutartis</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>sutartys/darbo_sutartis" method="POST">
                <?php
                var_dump($data);
                ?>
                <fieldset>
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
</div>
