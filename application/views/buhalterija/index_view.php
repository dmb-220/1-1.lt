<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5># 1-1.LT #</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <?php $this->load->view("buhalterija/meniu_view"); ?>

            <div class="tabs-container" id="tabs">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#ilg_turtas"><i class="fa fa-pie-chart fa-2x text-success"></i> Ilgal. turtas</a></li>
                    <li><a data-toggle="tab" href="#pirkimai_pardavimai"><i class="fa fa-star-o fa-2x"></i> Pirkimai / Pardavimai</a></li>
                    <li><a data-toggle="tab" href="#zinynai"><i class="fa fa-star-o fa-2x"></i> Žinynai</a></li>
                    <li><a data-toggle="tab" href="#mokejimai"><i class="fa fa-star-o fa-2x"></i> Mokėjimai</a></li>
                    <li><a data-toggle="tab" href="#darbo_uzmokestis"><i class="fa fa-briefcase fa-2x"></i> Darbo užm.</a></li>
                    <li><a data-toggle="tab" href="#buhalterija"><i class="fa fa-briefcase fa-2x"></i> Buhalterija</a></li>
                    <li><a data-toggle="tab" href="#uzsakymai"><i class="fa fa-briefcase fa-2x"></i> Užsakymai</a></li>
                </ul>

                <div class="tab-content animated fadeInRight">
                    <?php $this->load->view("buhalterija/pirkimai_pardavimai_view"); ?>

                    <?php $this->load->view("buhalterija/zinynai_view"); ?>

                    <?php $this->load->view("buhalterija/mokejimai_view"); ?>

                    <?php $this->load->view("buhalterija/darbo_uzmokestis_view"); ?>

                    <?php $this->load->view("buhalterija/buhalterija_view"); ?>

                    <?php $this->load->view("buhalterija/ilgalaikis_turtas_view"); ?>

                    <?php $this->load->view("buhalterija/uzsakymai_view"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>assets\js\buhalterija.js"></script>
