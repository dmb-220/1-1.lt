<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pasirinkite ūkininką  su kuriuo dirbsite</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal form-bordered" action="<?= base_url(); ?>main" method="POST">
                        <?php
                        $uk_sk = count($this->main_model->info['ukininkai']);
                        $uk_puse = floor($uk_sk/2);
                        if($uk_sk>0){ ?>
                            <div class="alert alert-success text-center">PASIRINKITĘ ŪKININKĄ</div>
                            <?php
                            $dt = $this->session->userdata();
                            echo form_error('ukininkas');
                            ?>
                        <div class="form-group">
                            <div class="row row-space-12">
                                <label class="col-md-2 control-label"> </label>
                                <div class="col-md-4">
                                    <?php
                                    for($i=0; $i<$uk_puse; $i++){
                                        if($dt['nr'] == $this->main_model->info['ukininkai'][$i]["valdos_nr"]){
                                            echo"<div class='radio radio-info'><input type='radio' name='ukininkas' value=".$this->main_model->info['ukininkai'][$i]["valdos_nr"]." disabled> ";
                                            echo "<label>". $this->main_model->info['ukininkai'][$i]['vardas']." ".$this->main_model->info['ukininkai'][$i]['pavarde']."</label></div>";
                                        }else{
                                            echo"<div class='radio radio-info'><input type='radio' name='ukininkas' value=".$this->main_model->info['ukininkai'][$i]["valdos_nr"].">";
                                            echo " <label><b>". $this->main_model->info['ukininkai'][$i]['vardas']." ".$this->main_model->info['ukininkai'][$i]['pavarde']."</b></label></div>";
                                        }
                                    }
                                    ?>
                                </div>
                                <label class="col-md-2 control-label"> </label>
                                <div class="col-md-4">
                                    <?php
                                    for($i=$uk_puse; $i<$uk_sk; $i++){
                                        if($dt['nr'] == $this->main_model->info['ukininkai'][$i]["valdos_nr"]){
                                            echo"<div class='radio radio-info'><input type='radio' name='ukininkas' value=".$this->main_model->info['ukininkai'][$i]["valdos_nr"]." disabled> ";
                                            echo "<label>". $this->main_model->info['ukininkai'][$i]['vardas']." ".$this->main_model->info['ukininkai'][$i]['pavarde']."</label></div>";
                                        }else{
                                            echo"<div class='radio radio-info'><input type='radio' name='ukininkas' value=".$this->main_model->info['ukininkai'][$i]["valdos_nr"].">";
                                            echo " <label><b>". $this->main_model->info['ukininkai'][$i]['vardas']." ".$this->main_model->info['ukininkai'][$i]['pavarde']."</b></label></div>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4"></label>
                            <div class="col-md-6 col-sm-6">
                                <button class="btn btn-block btn-outline btn-primary" type="submit">
                                    <i class="fa fa-check-circle-o fa-lg"> PASIRINKTI</i>
                                </button>
                            </div>
                        </div>
                        <?php }else{
                            echo"Dar neturite ūkininkų su kuriais dirbate, galite įtraukti naujus per: ŪKININKAI -> NAUJAS ŪKININKAS";
                        } ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Informacija</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <?php
                    if($this->ion_auth->is_admin()){
                    echo"Testinis langas"; ?>
                    <?php }
                    echo"<br>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

