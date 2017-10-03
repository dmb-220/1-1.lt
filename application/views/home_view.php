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
                            <label class="col-lg-2 control-label">Rinktis :</label>
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
                    <br>
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
                    <h5>Naujienos</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="ibox-content inspinia-timeline">
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-briefcase"></i>
                                2017.09.07
                                <br>
                                <small class="text-navy">...</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>Sutvarkyta:</strong></p>

                                <p>
                                    * Sutvarkytas meslu skaiciavimas<br>
                                    * skaiciuoja pasirinkta menesi arba visa sezona<br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-briefcase"></i>
                                2017.09.02
                                <br>
                                <small class="text-navy">...</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>Sutvarkyta:</strong></p>

                                <p>
                                    * Sukelti ukininku gyvuliai uz rugpjuti<br>
                                    * P. Platakis neleidzia susikelti duomenu, neprisijungiu prie VIC.LT<br>
                                    * Čejauskas yra klaida, surasiu ir istaisysiu, kazkas su telyciu judejimu i karves, 1 pameta<br>
                                    * Taip pat Cejausko VIC.LT yra klaida karve parduota 08-31 ja rodo ir prie Visu ir prie Gyvu, vic.lt yra 306 galvijai, man pas manes skaiciuoja 305 galvijus, ismeta ta parduota<br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-briefcase"></i>
                                2017.08.22
                                <br>
                                <small class="text-navy">...</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>Sutvarkyta:</strong></p>

                                <p>
                                    * paspaudus PRISIJUNGTI, iššoka langas ir ten įvedus duomenis prisijungiama<br>
                                    * sutvarkytas datos pasirinkimas, pasalintas jquery UI, pridetas bootstrap stilius<br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-briefcase"></i>
                                2017.08.21
                                <br>
                                <small class="text-navy">...</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>Pakeista:</strong></p>

                                <p>
                                    * jei paspaudi meniu kuris turi papildomus pasirinkimus, uzsikrovus puslapiui jis lieka atviras<br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-briefcase"></i>
                                2017.08.20
                                <br>
                                <small class="text-navy">...</small>
                            </div>
                            <div class="col-xs-7 content no-top-border">
                                <p class="m-b-xs"><strong>Pakeistas stilius:</strong></p>

                                <p>
                                    * pakeistas viso puslapio dizainas<br>
                                    * pakeistas myktuku stylius<br>
                                    * spauzdinimo myktukas didelis ir gerai matomas
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-xs-3 date">
                                <i class="fa fa-file-text"></i>
                                2017.08.12
                                <br>
                                <small class="text-navy">...</small>
                            </div>
                            <div class="col-xs-7 content">
                                <p class="m-b-xs"><strong>Sutvarkyta:</strong></p>
                                <p>
                                    * istaisytos klaidos pasaru skaiciavime (skaiciuodavo pasarus tik vienai dienai per menesi o ne visoms dienoms)<br>
                                    * pasaru skaiciavime dabar jau rodo MIN, VID ir MAX vienoje lentele, nebereik rinktis ka rodyti<br>
                                    * idetas pasaru skaiciavimas pusmeciams ir ketvirciam<br>
                                    * visi sitie pakeitimai pritaikyti ir rankiniam pasaru skaiciavimui<br><br>
                                    * sutvarkytas paseliu skaiciavimas, itrauktas naujas stulpelis derlius, apskaiciuoja derliu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

