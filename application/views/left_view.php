<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <?php $dt = $this->session->userdata(); ?>
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="<?= base_url(); ?>assets/img/profile_small.jpg">
                    </span>
                    <span class="clear">
                        <span class="block m-t-xs">
                            <strong class="font-bold">
                                <?php
                                if($dt['email']){echo $dt['email'];}else{echo "Neprisijungęs";}
                                $user = $this->ion_auth->user()->row();
                                ?>
                            </strong>
                        </span>
                        <span class="text-muted text-xs block">
                            <?= $user->username ?>
                        </span>
                    </span>
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
                <?php
                if($this->ion_auth->is_admin()){?>
                    <li>
                        <a href="<?= base_url(); ?>admin/admin"><i class="fa fa-briefcase"></i><span class="nav-label">Admininstracija</span></a>
                    </li>

                    <li>
                        <a href="<?= base_url(); ?>buhalterija/buhalterija"><i class="fa fa-calculator"></i><span class="nav-label">Buhalterinė apskaita</span></a>
                    </li>

                    <!-- <li>
                        <a href="<?= base_url(); ?>zalia_knyga/knyga"><i class="fa fa-bars"></i> <span class="nav-label">Didžioji Knyga</span></a>
                    </li> -->

                    <?php } ?>

                <?php if($act == 'sutartys'){echo'<li class="active">';}else{echo'<li>';} ?>
                <a href="#"><i class="fa fa-keyboard-o"></i> <span class="nav-label">Sutartys</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= base_url(); ?>sutartys/skaitciuokle"><i class="fa fa-edit"></i>Sutarties skaitčiuoklė</a></li>
                    <li><a href="<?= base_url(); ?>sutartys/sutartys"><i class="fa fa-bars"></i> 2017 metų sutartys</a></li>
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
                    <li><a href="<?= base_url(); ?>galvijai/pradinis"><i class="fa fa-briefcase"></i>Pradinis (DEMO)</a></li>
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
            }
            ?>
        </ul>

    </div>
</nav>
