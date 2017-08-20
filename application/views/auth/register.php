<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
      <h5>Registracija</h5>
        <div class="ibox-tools">
            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            <a class="close-link"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="ibox-content">
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
            <label class="col-md-4 control-label">Slaptažodis <span class="text-danger">*</span></label>
            <div class="col-md-6">
              <?php echo form_error('password'); ?>
              <input name="password" type="password" class="form-control" placeholder=""/>
            </div>
          </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Pakartoti slaptažodį <span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <?php echo form_error('password2'); ?>
                    <input name="password2" type="password" class="form-control" placeholder=""/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4"></label>
                <div class="col-md-6 col-sm-6">
                    <button class="btn btn-block btn-outline btn-primary" type="submit">
                        <i class="fa fa-check-circle-o fa-lg"> REGISTRUOTIS</i>
                    </button>
                </div>
            </div>
          <div class="m-t-20 m-b-40 p-b-40 text-inverse">
            Atsimenate prisijungimą? Spauskite <a data-toggle="modal" href="#modal-form">čia</a> prisijungti.
          </div>
        </form>
    </div>
  </div>
</div>
