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
    <div class="row animated fadeInRight">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Basic left float timeline</h5>
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

                <div class="ibox-content inspinia-timeline">

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-briefcase"></i>
                                6:00 am
                                <br>
                                <small class="text-navy">2 hour ago</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>Meeting</strong></p>

                                <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the
                                    sale.</p>

                                <p><span data-diameter="40" class="updating-chart">5,3,9,6,5,9,7,3,5,2,5,3,9,6,5,9,4,7,3,2,9,8,7,4,5,1,2,9,5,4,7,2,7,7,3,5,2</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-file-text"></i>
                                7:00 am
                                <br>
                                <small class="text-navy">3 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Send documents to Mike</strong></p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-coffee"></i>
                                8:00 am
                                <br>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Coffee Break</strong></p>
                                <p>
                                    Go to shop and find some products.
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-phone"></i>
                                11:00 am
                                <br>
                                <small class="text-navy">21 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Phone with Jeronimo</strong></p>
                                <p>
                                    Lorem Ipsum has been the industry's standard dummy text ever since.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-user-md"></i>
                                09:00 pm
                                <br>
                                <small>21 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Go to the doctor dr Smith</strong></p>
                                <p>
                                    Find some issue and go to doctor.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-user-md"></i>
                                11:10 pm
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Chat with Sandra</strong></p>
                                <p>
                                    Lorem Ipsum has been the industry's standard dummy text ever since.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-comments"></i>
                                12:50 pm
                                <br>
                                <small class="text-navy">48 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Chat with Monica and Sandra</strong></p>
                                <p>
                                    Web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-phone"></i>
                                08:50 pm
                                <br>
                                <small class="text-navy">68 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Phone to James</strong></p>
                                <p>
                                    Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-file-text"></i>
                                7:00 am
                                <br>
                                <small class="text-navy">3 hour ago</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Send documents to Mike</strong></p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

