<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <?php $dt = $this->session->userdata(); ?>

            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?= base_url(); ?>assets/img\profile_small.jpg">
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs">
                                    <strong class="font-bold">
                                        <?php if($dt['email']){echo $dt['email'];}else{echo "Neprisijungęs";} ?>
                                    </strong>
                             </span> <span class="text-muted text-xs block">Administratorius<b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?= base_url(); ?>main/profilis">Profilis</a></li>
                        <li><a href="<?= base_url(); ?>main/kontaktai">Kontaktai</a></li>
                        <li><a href="<?= base_url(); ?>main/zinutes">Žinutės</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    1-1.LT
                </div>
            </li>
            <?php
            $act = $this->uri->segment(1);

            if ($this->ion_auth->logged_in()) {
            ?>
            <li>
                <a href="<?= base_url(); ?>main/index"><i class="fa fa-road"></i> <span class="nav-label">Į pradžią</span></a>
            </li>
                
                <li>
                    <a href="<?= base_url(); ?>zalia_knyga/knyga"><i class="fa fa-bars"></i> <span class="nav-label">Didžioji Knyga</span></a>
                </li>

                <?php if($act == 'sutartys'){echo'<li class="active">';}else{echo'<li>';} ?>
                <a href="#"><i class="fa fa-keyboard-o"></i> <span class="nav-label">Sutartys</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= base_url(); ?>sutartys/skaitciuokle"><i class="fa fa-edit"></i>Sutarties skaitčiuoklė</a></li>
                    <li><a href="<?= base_url(); ?>sutartys/paslaugu_teikimas"><i class="fa fa-bars"></i> Paslaugų teikimas</a></li>
                    <li><a href="<?= base_url(); ?>sutartys/sutartys"><i class="fa fa-bars"></i> Sutikimas dėl duomenų naudojimo</a></li>
                    <li><a href="<?= base_url(); ?>sutartys/darbo_sutartis"><i class="fa fa-bars"></i> Darbo sutartis</a></li>
                </ul>
                </li>

                <?php if($act == 'ukininkai'){echo'<li class="active">';}else{echo'<li>';} ?>
                <a href="#"><i class="fa fa-suitcase"></i> <span class="nav-label">Ūkininkai</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= base_url(); ?>ukininkai/prideti_ukininka"><i class="fa fa-edit"></i> Naujas ūkininkas</a></li>
                    <li><a href="<?= base_url(); ?>ukininkai/sarasas_ukininku"><i class="fa fa-bars"></i> Ūkininkų sąrašas</a></li>
                </ul>
            </li>
                <?php if($act == 'galvijai'){echo'<li class="active">';}else{echo'<li>';} ?>
                <a href="#"><i class="fa fa-paw"></i> <span class="nav-label">Galvijai</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= base_url(); ?>galvijai/nuskaityti_vic"><i class="fa fa-plus"></i> Įtraukti iš VIC.LT</a></li>
                    <li><a href="<?= base_url(); ?>galvijai/gyvuliu_sarasas"><i class="fa fa-list"></i> Galvijų sąrašas</a></li>
                    <li><a href="<?= base_url(); ?>galvijai/skaiciuoti_gyvulius"><i class="fa fa-table"></i> Skaičiuoti galvijus</a></li>
                </ul>
            </li>
                <?php if($act == 'paseliai'){echo'<li class="active">';}else{echo'<li>';} ?>
                <a href="#"><i class="fa fa-map-marker"></i> <span class="nav-label">Pasėliai</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= base_url(); ?>paseliai/paseliai">Pasėlių sąrašas</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/nauji_paseliai">Deklaracijos įkėlimas</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/naujas_kodas">Įtraukti naujus pasėlius</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/redaguoti_kodas">Redaguoti pasėlių reikšmes</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/rankinis_paselius">Rankinis pasėlių skaičiavimas</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/skaiciuoti_paselius">Skaičiuoti pasėlius</a></li>
                </ul>
            </li>
                <?php if($act == 'pasarai'){echo'<li class="active">';}else{echo'<li>';} ?>
                <a href="#"><i class="fa fa-leaf"></i> <span class="nav-label">Pašarai</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= base_url(); ?>pasarai/normos">Normų sąrašas</a></li>
                    <li><a href="<?= base_url(); ?>pasarai/apskaiciuoti_pasarus">Apskaiciuoti pašarus</a></li>
                    <li><a href="<?= base_url(); ?>pasarai/rankinis_pasarus">Rankinis pašarų skaičiavimas</a></li>
                    <li><a href="<?= base_url(); ?>pasarai/priesvoris">Priesvoris</a></li>
                    <li><a href="<?= base_url(); ?>pasarai/meslas">Meslas</a></li>
                    <li><a href="<?= base_url(); ?>pasarai/ganykliniai_pasarai">Ganykliniai pašarai</a></li>
        </ul>
            </li>

                <li>
                    <a href="<?= base_url(); ?>main/kalendorius"><i class="fa fa-calendar"></i> <span class="nav-label">Kalendorius</span></a>
                </li>

                <?php
            }else{
            ?>

            <li><a href="<?= base_url(); ?>main"><i class="fa fa-road"></i> <span>Į pradžią</span></a</li>
            <li><a data-toggle="modal" href="#login-form"><i class="fa fa-user"></i> <span>Prisijungti</span></a></li>
            <li><a data-toggle="modal" href="#register-form"><i class="fa fa-users"></i> <span>Registruotis</span></a></li>

                <?php
            }
            ?>
        </ul>

    </div>
</nav>
<!-- Prisijungimo forma -->
<div id="login-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">PRISIJUNGIMAS</h3>
                        <hr>
                        <form role="form" action="<?= base_url(); ?>auth/login" method="POST" >
                            <div class="form-group">
                                <label>El. paštas:</label>
                                <input type="email" name="identity" placeholder="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Slaptažodis:</label>
                                <input type="password" name="password" placeholder="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label></label>
                                <input type="checkbox" class="i-checks"> Prisiminti mane
                            </div>
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> PRISIJUNGTI</i>
                            </button>
                        </form>
                    </div>
                    <div class="col-sm-6"><h4>Dar neturite prieigos? Jūs galite užsiregistruoti:</h4>
                        <h5>Administracija turės patvirtinti Jūsų registracija, tai gali užtrukti iki 24 valandų.</h5>
                        <hr>
                        <p class="text-center">
                            <a href="<?= base_url(); ?>auth/register"><i class="fa fa-sign-in big-icon"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registracijos forma -->
<div id="register-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">REGISTRACIJA</h3>
                        <hr>
                        <form role="form" action="<?= base_url(); ?>auth/register" method="POST" >
                            <div class="form-group">
                                <label>El. paštas:</label>
                                <input type="email" name="identity" placeholder="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Slaptažodis:</label>
                                <input type="password" name="password" placeholder="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Pakartoti slaptažodį:</label>
                                <input type="password" name="password2" placeholder="" class="form-control">
                            </div>
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> REGISTRUOTIS</i>
                            </button>
                        </form>
                    </div>
                    <div class="col-sm-6"><h4>Jūs jau esate užsiregistravęs? Galite prisijungti:</h4>
                        <hr>
                        <p class="text-center">
                            <a href="<?= base_url(); ?>auth/login"><i class="fa fa-user big-icon"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
