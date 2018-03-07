<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="Ūkininkai, Buhalterija, Gyvuliai, Pašarai, Pasėliai, Skaičiavimai">
    <meta name="description" content="Ūkininkų buhalterijos vedimas, gyvulių, pasėlių ir pašarų skaičiavimas">
    <meta name="author" content="Andrius Norkus (DMB-220)">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $action = $this->uri->segment(2); ?>
    <title>1-1.LT | Administracija</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>assets\euro.ico" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets\font-awesome\css\font-awesome.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets\css\style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets\css\plugins\awesome-bootstrap-checkbox\awesome-bootstrap-checkbox.css" rel="stylesheet">
    <!-- mano CSS -->
    <link href="<?= base_url(); ?>assets/css/mano.css" rel="stylesheet"/>
    <?php if($action == 'skaitciuokle'){ ?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet"/>
    <?php } ?>
    <?php if($action == 'saskaitos'){ ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
    <?php } ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body class="md-skin">
<?php
//istrinsim top-navigation ir atkomentuosim left_view
//uzkraunam meniu
$this->load->view('left_view');
?>
    <div id="page-wrapper" class="gray-bg">
        <?php
        //uzkraunam virsutini meniu
        $this->load->view('header_view');
        //uzkraunam informacijos juosta
        $this->load->view("info_view");

        switch ($action) {
            //Ukininkai
            case "prideti_ukininka": $this->load->view("ukininkai/prideti_ukininkus_view"); break;
            case "sarasas_ukininku": $this->load->view("ukininkai/sarasas_ukininku_view"); break;
            case "redaguoti": $this->load->view("ukininkai/redaguoti_view"); break;
            case "profilis": $this->load->view("ukininkai/profilis_view"); break;
            case "sarasas": $this->load->view("ukininkai/sarasas"); break;
            //Saskaitos
            case "saskaitos": $this->load->view("saskaitos/saskaitos"); break;
            //Atsiskaitymai
            case "atsiskaitymas": $this->load->view("atsiskaitymas/atsiskaitymas"); break;
            //Gyvuliai
            case "pradinis": $this->load->view("galvijai/pradinis_view"); break;
            case "kopijuoti": $this->load->view("galvijai/kopijuoti"); break;
            case "ikelti_duomenis": $this->load->view("galvijai/ikelti_gyvulius_view"); break;
            case "skaiciuoti_gyvulius": $this->load->view("galvijai/skaiciuoti_gyvulius_view"); break;
            case "gyvuliu_sarasas": $this->load->view("galvijai/gyvuliu_sarasas_view"); break;
            case "nuskaityti_vic": $this->load->view("galvijai/nuskaityti_vic_view"); break;
            //Paseliai
            case "nauji_paseliai": $this->load->view("paseliai/nauji_paseliai_view"); break;
            case "skaiciuoti_paselius": $this->load->view("paseliai/skaiciuoti_paselius_view"); break;
            case "rankinis_paselius": $this->load->view("paseliai/rankinis_paselius_view"); break;
            case "naujas_kodas": $this->load->view("paseliai/naujas_kodas_view"); break;
            case "redaguoti_kodas": $this->load->view("paseliai/redaguoti_kodas_view"); break;
            case "paseliai": $this->load->view("paseliai/paseliai_view"); break;
            //Pasarai
            case "normos": $this->load->view("pasarai/normos_view"); break;
            case "meslas": $this->load->view("pasarai/meslas_view"); break;
            case "priesvoris": $this->load->view("pasarai/priesvoris_view"); break;
            case "ganykliniai_pasarai": $this->load->view("pasarai/ganykliniai_pasarai_view"); break;
            case "apskaiciuoti_pasarus": $this->load->view("pasarai/apskaiciuoti_pasarus_view"); break;
            case "rankinis_pasarus": $this->load->view("pasarai/rankinis_pasarus_view"); break;
            //Zalioji knyga
            case "knyga": $this->load->view("knyga/knyga_view"); break;
            //Sutartys
            case "skaitciuokle": $this->load->view("sutartys/skaitciuokle_view"); break;
            case "sutartys": $this->load->view("sutartys/sutartys_view"); break;
            case "vidurkis": $this->load->view("sutartys/vidurkis_view"); break;
            case "kainos": $this->load->view("sutartys/kainos"); break;
            case "sutarciu_sarasas": $this->load->view("sutartys/sarasas"); break;
            case "perziureti": $this->load->view("sutartys/perziureti"); break;
            case "darbo_sutartis": $this->load->view("sutartys/darbo_sustartis_view"); break;
            case "formuoti": $this->load->view("sutartys/formuoti_view"); break;
            //Kalendorius
            case "kalendorius": $this->load->view("kalendorius_view"); break;
            //Administravimo meniu
            case "admin": $this->load->view("admin/admin_view"); break;
            //Buhalterija meniu
            case "buhalterija": $this->load->view("buhalterija/index_view"); break;
            //kai niekas netinka
            default:
                if ($this->ion_auth->logged_in()) {
                    $this->load->view("home_view");
                }else{
                    redirect('auth/login');}
                break;
        }

        $this->load->view('footer_view');
        ?>

    </div>
    <?php
    //$this->load->view("chat_view");
    //$this->load->view("sidebar_view");
    ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets\js\plugins\metisMenu\jquery.metisMenu.js"></script>
<script src="<?= base_url(); ?>assets\js\plugins\slimscroll\jquery.slimscroll.min.js"></script>
<script src="<?= base_url(); ?>assets\js\plugins\pace\pace.min.js"></script>
<script src="<?= base_url(); ?>assets\js\inspinia.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<!-- mano JS -->
<script src="<?= base_url(); ?>assets\js\mano.js"></script>
<!-- skaiciuokles programa, kad uzsipildytu laukeliai su informacija, kuria paduosim, formajant sutarti -->
<?php if($action == 'skaitciuokle'){ ?>
    <script src="<?= base_url(); ?>assets/js/bootstrap-number-input.js"></script>
    <script src="<?= base_url(); ?>assets/js/skaitciuokle.js"></script>
<?php }
if($action == 'pradinis'){ ?>
<script src="<?= base_url(); ?>assets/js/galvijai.js"></script>
<?php } ?>
<?php
if($action == 'saskaitos'){ ?>
<script src="<?= base_url(); ?>assets/js/saskaitos.js"></script>
<?php } ?>
<?php
if($action == 'atsiskaitymas'){ ?>
    <script src="<?= base_url(); ?>assets/js/atsiskaitymas.js"></script>
<?php } ?>
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    $('#data_knyga .input-group.date').datepicker({
        weekStart: 1,
        defaultViewDate: "today",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy.mm.dd"
    });

    $('#paslaugu_sutartis .input-group.date').datepicker({
        weekStart: 1,
        defaultViewDate: "today",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy.mm.dd"
    });
</script>
</body>
</html>
