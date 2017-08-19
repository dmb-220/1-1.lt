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
            <h4 class="panel-title">Gyvuliai</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal form-bordered" id="dateRangeForm" action="<?= base_url(); ?>gyvuliai/nuskaityti_vic" method="POST">
                <?php
                $dt = $this->session->userdata();
                ?>
                <fieldset>
                    <legend>Jungiamės prie VIC.LT</legend>
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

                    <div class="form-group">
                        <label class="control-label col-md-4">Data: nuo</label>
                        <div class="col-md-6">
                            <div class="input-group date">
                                <?php echo form_error('data1'); ?>
                                <input type="text" name="data1" class="form-control"  id="datepicker1"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Data: iki</label>
                        <div class="col-md-6">
                            <div class="input-group date">
                                <?php echo form_error('data2'); ?>
                                <input type="text" name="data2" class="form-control"  id="datepicker2"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-sm btn-primary m-r-5">Įtraukti naujus duomenis</button>
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
    <!-- end panel -->
</div>
<!-- end #content -->