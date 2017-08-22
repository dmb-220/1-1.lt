<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Pasirinkite laikotarpį (VIC.LT)</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal form-bordered" id="dateRangeForm" action="<?= base_url(); ?>gyvuliai/nuskaityti_vic" method="POST">
                <?php
                $dt = $this->session->userdata();
                ?>
                <fieldset>
                    <?php
                    if($error['OK']){
                        echo'<div class="alert alert-info">';
                        echo $error['OK'];
                        echo '</div>';
                    }

                    if($error['jau_yra']){
                        echo'<div class="alert alert-info">';
                        echo $error['jau_yra'];
                        echo '</div>';
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Ūkininkas</label>
                        <div class="col-md-6">
                            <?php echo form_error('ukininko_vardas');
                            if($dt['vardas'] == "" AND $dt['pavarde'] == "") { ?>
                                <select name="ukininko_vardas" class="form-control">
                                    <option value="">Pasirinkite...</option>
                                    <?php
                                    foreach ($data as $row) {
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

                    <div class="form-group" id="data_1">
                        <label class="control-label col-md-4">Data: nuo</label>
                        <div class="col-md-6">
                            <div class="input-group date">
                                <?php echo form_error('data1'); ?>
                                <input type="text" name="data1" class="form-control"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="data_2">
                        <label class="control-label col-md-4">Data: iki</label>
                        <div class="col-md-6">
                            <div class="input-group date">
                                <?php echo form_error('data2'); ?>
                                <input type="text" name="data2" class="form-control"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> ĮTRAUKTI NAUJUS DUOMENIS</i>
                            </button>
                        </div>
                    </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
