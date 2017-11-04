<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Paslaugų teikimo sutartis</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>sutartys/paslaugu_teikimas" method="POST">
                <?php $dt = $this->session->userdata(); ?>
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ūkininkas</label>
                        <div class="col-md-10">
                            <?php echo form_error('ukininko_vardas');
                            if($dt['vardas'] == "" AND $dt['pavarde'] == "") { ?>
                                <select name="ukininko_vardas" class="form-control">
                                    <option value="">Pasirinkite...</option>
                                    <?php
                                    foreach ($this->main_model->info['ukininkai'] as $row) {
                                        echo "<option value='$row[valdos_nr]'>";
                                        echo $row['vardas'];
                                        echo " ";
                                        echo $row['pavarde'];
                                        echo "</option>";
                                    }
                                    ?>
                                </select>
                                <?php
                            }else{
                                echo '<select name="ukininko_vardas" class="form-control" disabled>';
                                echo'<option value='.$dt['nr'].' selected="selected">'.$dt['vardas'].' '.$dt['pavarde'].'</option>';
                                echo'</select>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Sutarties nr:</label>
                        <div class="col-md-10">
                            <?php echo form_error('numeris'); ?>
                            <input name="numeris" type="text" class="form-control" placeholder= "" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Data:</label>
                        <div class="col-md-10">
                            <?php echo form_error('data'); ?>
                            <div id="app">
                                <datepicker :value.sync="paslaugu_sutartis"></datepicker>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Kaina:</label>
                        <div class="col-md-10">
                            <?php echo form_error('kaina'); ?>
                            <input name="kaina" type="text" class="form-control" placeholder= "" />
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
</div>
