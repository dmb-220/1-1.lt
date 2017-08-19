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
            <h4 class="panel-title">Nauji pasėliai</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>paseliai/nauji_paseliai" method="POST" enctype="multipart/form-data">
                <?php
                $dt = $this->session->userdata();
                //var_dump($dt);
                ?>
                <fieldset>
                    <legend>Nauji duomenys</legend>
                    <?php
                    if($error['deklaracija']){
                        echo'<div class="alert alert-danger">';
                        echo $error['deklaracija'];
                        echo '</div>';
                    }


                    if($error['jau_yra']){
                        echo'<div class="alert alert-danger">';
                        echo $error['jau_yra'];
                        echo '</div>';
                    }

                    if($error['OK']){
                        echo'<div class="alert alert-success">';
                        echo $error["OK"];
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
                        <label class="col-md-4 control-label">Metai</label>
                        <div class="col-md-6">
                            <?php echo form_error('metai'); ?>
                            <select name="metai" class="form-control">
                                <option value="2016">2016</option>
                                <option value="2017" selected="selected">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Pasėlių deklaracija</label>
                        <div class="col-md-6">
                            <?php echo form_error('deklaracija'); ?>
                            <input name="deklaracija" type="file" class="form-control" placeholder= "" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-sm btn-primary m-r-5">Pridėti</button>
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
    <!-- end panel -->
</div>
<!-- end #content -->