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
      <h4 class="panel-title">Registracija</h4>
    </div>
    <div class="panel-body">
        <form action="" method="POST" class="form-horizontal form-bordered">
          <div class="form-group">
            <label class="col-md-4 control-label">Asmeniniai duomenys: <span class="text-danger">*</span></label>
            <div class="col-md-6">
              <div class="row row-space-12">
                <div class="col-md-6 m-b-15">
                  <?php echo form_error('vardas'); ?>
                  <input type="text" name="vardas" class="form-control" placeholder="Vardas">
                </div>
                <div class="col-md-6 m-b-15">
                  <?php echo form_error('pavade'); ?>
                  <input type="text" name="pavarde" class="form-control" placeholder="Pavardė">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">El. paštas <span class="text-danger">*</span></label>
            <div class="col-md-6">
              <?php echo form_error('emeil'); ?>
              <input name="email" type="text" class="form-control" placeholder=""/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pakartoti el. paštą <span class="text-danger">*</span></label>
            <div class="col-md-6">
              <?php echo form_error('emeil2'); ?>
              <input name="email2" type="text" class="form-control" placeholder=""/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Slaptažodis <span class="text-danger">*</span></label>
            <div class="col-md-6">
              <?php echo form_error('password'); ?>
              <input name="password" type="password" class="form-control" placeholder=""/>
            </div>
          </div>

          <div class="register-buttons">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Užsiregistruoti</button>
          </div>
          <div class="m-t-20 m-b-40 p-b-40 text-inverse">
            Atsimenate prisijungimą? Spauskite <a href="<?= base_url(); ?>auth/login">čia</a> to prisijungti.
          </div>
        </form>
    </div>
  </div>
  <!-- end panel -->
</div>
<!-- end #content -->