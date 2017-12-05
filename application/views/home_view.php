<div class="wrapper wrapper-content animated fadeInRight">
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
                    <?php
                    $dt = $this->session->userdata();
                    if($this->main_model->info['error']['action']){
                        echo '<div class="alert alert-success">Pasirinkta!</div>';
                    }
                    echo form_error('ukininkas');
                    ?>
                    <form class="form-horizontal form-bordered" action="<?= base_url(); ?>main" method="POST">
                        <?php if(count($this->main_model->info['ukininkai'])>0){ ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Rinktis :</label>
                            <div class="col-md-6 col-sm-6">
                                <?php
                                    foreach($this->main_model->info['ukininkai'] as $row){
                                        if($dt['nr'] == $row["valdos_nr"]){
                                            echo"<div class='radio radio-info'><input type='radio' name='ukininkas' value=".$row["valdos_nr"]." disabled> ";
                                            echo "<label>". $row['vardas']." ".$row['pavarde']."</label></div>";
                                        }else{
                                            echo"<div class='radio radio-info'><input type='radio' name='ukininkas' value=".$row["valdos_nr"].">";
                                            echo " <label><b>". $row['vardas']." ".$row['pavarde']."</b></label></div>";
                                        }
                                    }
                                ?>
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
                 /*
                //var_dump($this->main_model->info);
                $array = array();
                $this->db->where(array('ukininkas' => '1004556454', 'menesis' => 7));
                $query = $this->db->get("galvijai");
                $data = $query->result_array();

                //var_dump($data);

                foreach ($data as $da){
                    //var_dump($da);
                    $this->db->select('id');
                    $this->db->from('galvijai');
                    $arra = array('ukininkas' => $da['ukininkas'], 'menesis' => 8, 'numeris' => $da['numeris']);
                    $this->db->where($arra);
                    $re = $this->db->count_all_results();
                    if($re < 1){$array[] = $da;}
                }

                var_dump($array);
                */?>
            </div>
        </div>
    </div>
    </div>
</div>

