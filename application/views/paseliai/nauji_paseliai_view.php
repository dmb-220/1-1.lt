<div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pasirinkite metus ir deklaracija</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>paseliai/nauji_paseliai" method="POST" enctype="multipart/form-data">
                <?php
                $dt = $this->session->userdata();
                //var_dump($dt);
                ?>
                <fieldset>
                    <?php
                    if($this->main_model->info['error']['deklaracija']){
                        echo'<div class="alert alert-danger">';
                        echo $this->main_model->info['error']['deklaracija'];
                        echo '</div>';
                    }

                    if($this->main_model->info['error']['jau_yra']){
                        echo'<div class="alert alert-danger">';
                        echo $this->main_model->info['error']['jau_yra'];
                        echo '</div>';
                    }

                    if($this->main_model->info['error']['OK']){
                        echo'<div class="alert alert-success">';
                        echo $this->main_model->info['error']["OK"];
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
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> PRIDĖTI</i>
                            </button>
                        </div>
                </fieldset>
            </form>

        </div>
</div>
</div>