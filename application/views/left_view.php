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
                        <li><a href="profile.html">Profilis</a></li>
                        <li><a href="contacts.html">Kontaktai</a></li>
                        <li><a href="mailbox.html">Žinutės</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Atsijungti</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    1-1.LT
                </div>
            </li>
            <?php
            if ($this->ion_auth->logged_in()) {
            ?>
            <li>
                <a href="<?= base_url(); ?>main/index"><i class="fa fa-road"></i> <span class="nav-label">Į pradžią</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-suitcase"></i> <span class="nav-label">Ūkininkai</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= base_url(); ?>ukininkai/prideti_ukininka">Naujas ūkininkas</a></li>
                    <li><a href="<?= base_url(); ?>ukininkai/sarasas_ukininku">Ūkininkų sąrašas</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-paw"></i> <span class="nav-label">Gyvuliai</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= base_url(); ?>gyvuliai/nuskaityti_vic">Įtraukti gyvulius iš VIC.LT</a></li>
                    <li><a href="<?= base_url(); ?>gyvuliai/gyvuliu_sarasas">Gyvulių sąrašas</a></li>
                    <li><a href="<?= base_url(); ?>gyvuliai/skaiciuoti_gyvulius">Skaičiuoti gyvulius</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-map-marker"></i> <span class="nav-label">Pasėliai</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= base_url(); ?>paseliai/paseliai">Pasėlių sąrašas</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/nauji_paseliai">Įtraukti deklaracijas</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/naujas_kodas">Įtraukti naujus pasėlius</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/redaguoti_kodas">Redaguoti pasėlių reikšmes</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/rankinis_paselius">Rankinis pasėlių skaičiavimas</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/skaiciuoti_paselius">Skaičiuoti pasėlius</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-leaf"></i> <span class="nav-label">Pašarai</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= base_url(); ?>pasarai/normos">Normų sąrašas</a></li>
                    <li><a href="<?= base_url(); ?>pasarai/naujos_normos">Pridėti naujas normas</a></li>
                    <li><a href="<?= base_url(); ?>pasarai/apskaiciuoti_pasarus">Apskaiciuoti pašarus</a></li>
                    <li><a href="<?= base_url(); ?>pasarai/rankinis_pasarus">Rankinis pašarų skaičiavimas</a></li>
                    <li><a href="<?= base_url(); ?>pasarai/meslas">Meslas</a></li>
                </ul>
            </li>

                <?php
            }else{
            ?>

            <li><a href="<?= base_url(); ?>main"><i class="fa fa-road"></i> <span>Į pradžią</span></a</li>
            </br></br>
            <li><a href="<?= base_url(); ?>auth/login"><i class="fa fa-user"></i> <span>Prisijungti</span></a></li>
            <li><a href="<?= base_url(); ?>auth/register"><i class="fa fa-users"></i> <span>Registruotis</span></a></li>

                <?php
            }
            ?>
        </ul>

    </div>
</nav>