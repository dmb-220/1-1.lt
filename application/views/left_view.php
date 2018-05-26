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
                <a href="<?= base_url(); ?>main/index"><i class="fa fa-road"></i> <span class="nav-label">Į PRADŽIĄ</span></a>
            </li>
                <?php
                if($this->ion_auth->is_admin()){?>
                    <li>
                        <a href="<?= base_url(); ?>admin/admin"><i class="fa fa-briefcase"></i><span class="nav-label">ADMIN PANEL</span></a>
                    </li>

                    <li>
                        <a href="<?= base_url(); ?>buhalterija/buhalterija"><i class="fa fa-calculator"></i><span class="nav-label">BUHALTERINĖ APSKAITA</span></a>
                    </li>
                    <?php } ?>

                <li>
                    <a href="<?= base_url(); ?>zalia_knyga/knyga"><i class="fa fa-bars"></i> <span class="nav-label">DIDŽIOJI KNYGA</span></a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>saskaitos/saskaitos"><i class="fa fa-calculator"></i><span class="nav-label">SĄSKAITOS</span></a>
                </li>
                <li>
                    <a href="<?= base_url(); ?>atsiskaitymas/atsiskaitymas"><i class="fa fa-calculator"></i><span class="nav-label">ATSISKAITYMAI</span></a>
                </li>

                <?php if($act == 'sutartys'){echo'<li class="active">';}else{echo'<li>';} ?>
                <a href="#"><i class="fa fa-keyboard-o"></i> <span class="nav-label">SUTARTYS</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= base_url(); ?>sutartys/skaitciuokle"><i class="fa fa-edit"></i>Skaitčiuoklė ūkininkams</a></li>
                    <li><a href="<?= base_url(); ?>sutartys/skaitciuokle_JA"><i class="fa fa-edit"></i>Skaitčiuoklė JA</a></li>
                    <li><a href="<?= base_url(); ?>sutartys/vidurkis"><i class="fa fa-edit"></i>Vidurkiai</a></li>
                    <li><a href="<?= base_url(); ?>sutartys/kainos"><i class="fa fa-edit"></i>Kainos</a></li>
                    <li><a href="<?= base_url(); ?>sutartys/sutarciu_sarasas"><i class="fa fa-edit"></i>Sutarčių sąrašas</a></li>
                    <li><a href="<?= base_url(); ?>sutartys/sutartys"><i class="fa fa-bars"></i> 2017 metų sutartys</a></li>
                </ul>
                </li>

                <?php if($act == 'ukininkai'){echo'<li class="active">';}else{echo'<li>';} ?>
                <a href="#"><i class="fa fa-suitcase"></i> <span class="nav-label">ŪKININKAI</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= base_url(); ?>ukininkai/prideti_ukininka"><i class="fa fa-edit"></i> Naujas ūkininkas</a></li>
                    <li><a href="<?= base_url(); ?>ukininkai/sarasas_ukininku"><i class="fa fa-bars"></i> Ūkininkų sąrašas</a></li>
                    <li><a href="<?= base_url(); ?>ukininkai/sarasas"><i class="fa fa-bars"></i> Sąrašas</a></li>
                </ul>
            </li>

                <li>
                    <a href="<?= base_url(); ?>galvijai/pradinis"><i class="fa fa-briefcase"></i><span class="nav-label">GALVIJAI (DEMO)</span></a>
                </li>

                <?php if($act == 'paseliai'){echo'<li class="active">';}else{echo'<li>';} ?>
                <a href="#"><i class="fa fa-map-marker"></i> <span class="nav-label">PASĖLIAI</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?= base_url(); ?>paseliai/paseliai">Pasėlių sąrašas</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/nauji_paseliai">Deklaracijos įkėlimas</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/naujas_kodas">Įtraukti naujus pasėlius</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/redaguoti_kodas">Redaguoti pasėlių reikšmes</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/rankinis_paselius">Rankinis pasėlių skaičiavimas</a></li>
                    <li><a href="<?= base_url(); ?>paseliai/skaiciuoti_paselius">Skaičiuoti pasėlius</a></li>
                </ul>
            </li>

                <li>
                    <a href="<?= base_url(); ?>main/kalendorius"><i class="fa fa-calendar"></i> <span class="nav-label">KALENDORIUS</span></a>
                </li>

                <?php
            }
            ?>
        </ul>

    </div>
</nav>
