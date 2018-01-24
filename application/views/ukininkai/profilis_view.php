<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profilis</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <?php
                        //nustatom paveiksliuka, vyras ar moteris, pagal asmens koda
                        if($this->main_model->info['ukininkas'][0]['asmens_kodas'][0] == 3){
                            echo'<img alt="image" class="img-responsive" src="'.base_url().'assets/img/human.png">';
                        }else if($this->main_model->info['ukininkas'][0]['asmens_kodas'][0] == 4){
                            echo'<img alt="image" class="img-responsive" src="'.base_url().'assets/img/woman.png">';
                        }else{echo'<img alt="image" class="img-responsive" src="'.base_url().'assets/img/no.png">';}
                        ?>

                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong><?= $this->main_model->info['ukininkas'][0]['vardas']." ".$this->main_model->info['ukininkas'][0]['pavarde'] ?></strong></h4>
                        <p><i class="fa fa-map-marker"></i> <?= $this->main_model->info['ukininkas'][0]['adresas'] ?></p>
                        <hr>
                        <h5>
                           Mano informacija
                        </h5>
                        <?php
                        $ukio_tipas = array("GYVULININKYSTĖ", "AUGALININKYSTĖ", "ŽUVININKYSTĖ", "MIŠKININKYSTĖ");
                        $banda = array("", "PIENINIAI", "MĖSINIAI", "MIŠRŪS");
                        echo"<table class='table table-striped table-bordered'>";
                        if(!$this->main_model->info['ukininkas'][0]['viclt']){
                            echo"<tr><td>VIC.LT:</td>";
                            echo"<td>Vartotojo vardas: ".$this->main_model->info['ukininkas'][0]['VIC_vartotojo_vardas']."<br>
                                Slaptažodis: ".$this->main_model->info['ukininkas'][0]['VIC_slaptazodis']."</td></tr>";
                            }
                        echo"<tr><td>Ūkio tipas:</td>";
                        echo"<td>".$ukio_tipas[$this->main_model->info['ukininkas'][0]['ukio_tipas']]."</td></tr>";

                        if($this->main_model->info['ukininkas'][0]['banda']){
                            echo"<tr><td>Banda:</td>";
                            echo"<td>".$banda[$this->main_model->info['ukininkas'][0]['banda']]."</td></tr>";
                        }

                        if($this->main_model->info['ukininkas'][0]['asmens_kodas']){
                            echo"<tr><td>Asmens kodas:</td>";
                            echo"<td>".$this->main_model->info['ukininkas'][0]['asmens_kodas']."</td></tr>";
                        }

                        if($this->main_model->info['ukininkas'][0]['pvm_kodas']){
                            echo"<tr><td>PVM kodas:</td>";
                            echo"<td>".$this->main_model->info['ukininkas'][0]['pvm_kodas']."</td></tr>";
                        }

                        if($this->main_model->info['ukininkas'][0]['saskaitos_nr']){
                            echo"<tr><td>Sąskaitos NR.:</td>";
                            echo"<td>".$this->main_model->info['ukininkas'][0]['saskaitos_nr']."</td></tr>";
                        }

                        if($this->main_model->info['ukininkas'][0]['bankas']){
                            echo"<tr><td>Bankas:</td>";
                            echo"<td>".$this->main_model->info['ukininkas'][0]['bankas']."</td></tr>";
                        }
                        if($this->main_model->info['ukininkas'][0]['email']){
                            echo"<tr><td>El. paštas:</td>";
                            echo"<td>".$this->main_model->info['ukininkas'][0]['email']."</td></tr>";
                        }
                        if($this->main_model->info['ukininkas'][0]['telefonas']){
                            echo"<tr><td>Telefono NR.:</td>";
                            echo"<td>".$this->main_model->info['ukininkas'][0]['telefonas']."</td></tr>";
                        }
                        echo"</table>";

                        ?>
                        <br>
                        <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn btn-primary btn-sm btn-block" href="<?= base_url().'ukininkai/siusti_zinute/'.$this->main_model->info['ukininkas'][0]['valdos_nr']; ?>">
                                        <i class="fa fa-envelope"></i> Siūsti žinutę</a>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-default btn-sm btn-block" href="<?= base_url().'ukininkai/redaguoti/'.$this->main_model->info['ukininkas'][0]['valdos_nr']; ?>">
                                        <i class="glyphicon glyphicon-pencil"></i> Redaguoti</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Veismų žurnalas</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                        <div class="feed-activity-list">
                            <div class="feed-element">
                                <a href="#" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?= base_url() ?>assets/img/a1.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">1m ago</small>
                                    <strong>Andrius Norkus</strong> Čia padarysim kad rodytu žurnalą, kada buvo jungtasi prie VIC.LT, kada kokia sutarties sugeneruota, kada atspauzdintas vienas ar kitas lapas. <br>
                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Spausdinti</button>
                </div>
            </div>
        </div>
    </div>
</div>