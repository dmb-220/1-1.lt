<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>1-1.LT | Administracija</title>

    <link href="<?= base_url(); ?>assets/css\bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/font-awesome\css\font-awesome.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css\plugins\iCheck\custom.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css\animate.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css\style.css" rel="stylesheet">

    <link href="<?= base_url(); ?>assets/css\plugins\awesome-bootstrap-checkbox\awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>

<body>

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
            //Gyvuliai
            case "ikelti_duomenis": $this->load->view("gyvuliai/ikelti_gyvulius_view"); break;
            case "skaiciuoti_gyvulius": $this->load->view("gyvuliai/skaiciuoti_gyvulius_view"); break;
            case "gyvuliu_sarasas": $this->load->view("gyvuliai/gyvuliu_sarasas_view"); break;
            case "nuskaityti_vic": $this->load->view("gyvuliai/nuskaityti_vic_view"); break;
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
            case "naujos_normos": $this->load->view("pasarai/naujos_normos_view"); break;
            case "apskaiciuoti_pasarus": $this->load->view("pasarai/apskaiciuoti_pasarus_view"); break;
            case "rankinis_pasarus": $this->load->view("pasarai/rankinis_pasarus_view"); break;
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
</div>


<!-- Mainly scripts -->
<script src="<?= base_url(); ?>assets/js\jquery-3.1.1.min.js"></script>
<script src="<?= base_url(); ?>assets/js\bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js\plugins\metisMenu\jquery.metisMenu.js"></script>
<script src="<?= base_url(); ?>assets/js\plugins\slimscroll\jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?= base_url(); ?>assets/js\inspinia.js"></script>
<script src="<?= base_url(); ?>assets/js\plugins\pace\pace.min.js"></script>

<!-- iCheck -->
<script src="<?= base_url(); ?>assets/js\plugins\iCheck\icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>

</html>
