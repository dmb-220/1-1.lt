<div class="wrapper wrapper-content">
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pasirinkite ūkininką  su kuriuo dirbsite</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <?php
                    $dt = $this->session->userdata();
                    if($ok['action']){
                        echo '<div class="alert alert-success">Pasirinkta!</div>';
                    }
                    ?>
                    <form class="form-horizontal form-bordered" action="<?= base_url(); ?>main" method="POST">
                        <div class="form-group">
                            <label class="col-lg-2 control-label"">Rinktis :</label>
                            <div class="col-md-6 col-sm-6">
                                <?php
                                echo form_error('ukininkas');
                        foreach($data as $row){
                            if($dt['nr'] == $row["valdos_nr"]){
                                echo"<div class=\"i-checks\"> <input type='radio' name='ukininkas' value=".$row["valdos_nr"]." disabled> ";
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
                                    <i class="fa fa-check-circle-o"> PASIRINKTI</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            <!-- end panel -->
            </div>
        </div>
        <!-- end col-6 -->
    <!-- begin col-6 -->
    <div class="col-md-6">
        <!-- begin panel -->
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Informacija</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
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
        <!-- end panel -->
    </div>
    <!-- end col-6 -->
    </div>
</div>

