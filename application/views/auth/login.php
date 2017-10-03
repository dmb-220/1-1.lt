<div class="wrapper wrapper-content">
    <?php
    if($this->session->flashdata('message')){ ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> KLAIDA
            </div>
            <div class="panel-body">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        </div>
    <?php }
    ?>
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Prisijungimas</h5>
        <div class="ibox-tools">
            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            <a class="close-link"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="ibox-content">
        <?php //var_dump($data);
        ?>
  <form action="<?= base_url(); ?>auth/login" method="POST" class="form-horizontal form-bordered">
    <div class="form-group">
      <label class="col-md-4 control-label">Prisijungimo vardas</label>
      <div class="col-md-6">
      <input type="text" name="identity" class="form-control" placeholder="" required/>
        </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label">Slaptažodis</label>
      <div class="col-md-6">
      <input type="password" name="password" class="form-control" placeholder="" required/>
        </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label">Prisiminti mane: </label>
        <div class="col-md-6">
            <div class="i-checks"><input type="checkbox"/></div>
     </div>
    </div>
      <div class="form-group">
          <label class="control-label col-md-4 col-sm-4"></label>
          <div class="col-md-6 col-sm-6">
        <button class="btn btn-block btn-outline btn-primary" type="submit">
            <i class="fa fa-check-circle-o fa-lg"> PRISIJUNGTI</i>
        </button>
          </div>
      </div>
    </div>
  </form>
    </div>
  </div>
  <!-- end panel -->
</div>
<!-- end #content -->