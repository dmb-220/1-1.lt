<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="Ūkininkai, Buhalterija, Gyvuliai, Pašarai, Pasėliai, Skaičiavimai">
    <meta name="description" content="Ūkininkų buhalterijos vedimas, gyvulių, pasėlių ir pašarų skaičiavimas">
    <meta name="author" content="Andrius Norkus (DMB-220)">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>1-1.LT | Administracija</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>assets\euro.ico" />

    <link href="<?= base_url(); ?>assets\css\bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets\font-awesome\css\font-awesome.css" rel="stylesheet">
    <!-- Date picker -->
    <link href="<?= base_url(); ?>assets\css\plugins\datapicker\datepicker3.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="<?= base_url(); ?>assets\css\plugins\toastr\toastr.min.css" rel="stylesheet">

    <link href="<?= base_url(); ?>assets\css\animate.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets\css\style.css" rel="stylesheet">
    <!-- FORMS -->
    <link href="<?= base_url(); ?>assets\css\plugins\awesome-bootstrap-checkbox\awesome-bootstrap-checkbox.css" rel="stylesheet">
    <!-- mano CSS -->
    <link href="<?= base_url(); ?>assets/css/mano.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body class="md-skin">
<div id="wrapper">
<?php
//uzkraunam meniu
$this->load->view('left_view');
?>
    <div id="page-wrapper" class="gray-bg">
        <?php
        //uzkraunam virsutini meniu
        $this->load->view('header_view');
        //uzkraunam informacijos juosta
        $this->load->view("info_view");

        $action = $this->uri->segment(2);
        switch ($action) {
            //Ukininkai
            case "prideti_ukininka": $this->load->view("ukininkai/prideti_ukininkus_view"); break;
            case "sarasas_ukininku": $this->load->view("ukininkai/sarasas_ukininku_view"); break;
            case "redaguoti": $this->load->view("ukininkai/redaguoti_view"); break;
            //Gyvuliai
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
            //Autorizacija
            case "login": $this->load->view("auth/login.php"); break;
            case "register": $this->load->view("auth/register.php"); break;
            case "auth_error": $this->load->view("auth/auth_error_view"); break;
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
            case "paslaugu_teikimas": $this->load->view("sutartys/paslaugu_teikimas_view"); break;
            case "darbo_sutartis": $this->load->view("sutartys/darbo_sustartis_view"); break;
            //Kalendorius
            case "kalendorius": $this->load->view("kalendorius_view"); break;
            //kai niekas netinka
            default:
                if ($this->ion_auth->logged_in()) {
                    $this->load->view("home_view");
                }else{
                    $this->load->view("auth/no_login_view");
                }
                break;
        }

        $this->load->view('footer_view');
        ?>

    </div>
    <?php
    $this->load->view("chat_view");
    $this->load->view("sidebar_view");
    ?>
</div>

<!-- Mainly scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js"></script>
<!-- axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>
<script src="<?= base_url(); ?>assets\js\bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets\js\plugins\metisMenu\jquery.metisMenu.js"></script>
<script src="<?= base_url(); ?>assets\js\plugins\slimscroll\jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="<?= base_url(); ?>assets\js\inspinia.js"></script>
<script src="<?= base_url(); ?>assets\js\plugins\pace\pace.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url(); ?>assets\js\plugins\toastr\toastr.min.js"></script>
<!-- Data picker -->
<script src="<?= base_url(); ?>assets\js\plugins\datapicker\bootstrap-datepicker.js"></script>
<!-- mano JS -->
<script src="<?= base_url(); ?>assets\js\mano.js"></script>
<script src="<?= base_url(); ?>assets\js\vuejs.js"></script>

<script type="text/javascript">
    $('#data_1 .input-group.date').datepicker({
        weekStart: 1,
        defaultViewDate: "today",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy-mm-dd"
    });

    $('#data_2 .input-group.date').datepicker({
        weekStart: 1,
        defaultViewDate: "today",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy-mm-dd"
    });

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

<script>
</script>
</body>
</html>
