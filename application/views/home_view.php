<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-6">
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
                    if($error['action']){
                        echo '<div class="alert alert-success">Pasirinkta!</div>';
                    }
                    echo form_error('ukininkas');
                    ?>
                    <form class="form-horizontal form-bordered" action="<?= base_url(); ?>main" method="POST">
                        <div class="form-group">
                            <label class="col-lg-2 control-label"">Rinktis :</label>
                            <div class="col-md-6 col-sm-6">
                                <?php
                        foreach($data as $row){
                            if($dt['nr'] == $row["valdos_nr"]){
                                echo"<div class='i-checks'> <input type='radio' name='ukininkas' value=".$row["valdos_nr"]." disabled> ";
                                echo $row['vardas']." ".$row['pavarde']."</div>";
                            }else{
                                echo"<div class='i-checks'><input type='radio' name='ukininkas' value=".$row["valdos_nr"]."> <b>";
                                echo $row['vardas']." ".$row['pavarde'];
                                echo"</b></div>";
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
                    </form>
                </div>
            </div>
        </div>
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Informacija</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    <a class="close-link"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="ibox-content">
                jei kartais lieptu prisijungti, uzrasau prisijungimo duomenis.
                <h1>
                    Vartotojo vardas: admin@admin.com
                    </br>
                    Slaptazodis: password
                </h1>

            </div>
        </div>
    </div>
    </div>
</div>

