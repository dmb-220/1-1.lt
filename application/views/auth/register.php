<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1-1.LT | Registracija</title>
    <link href="<?= base_url(); ?>assets\css\bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets\font-awesome\css\font-awesome.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets\css\plugins\awesome-bootstrap-checkbox\awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets\css\animate.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets\css\style.css" rel="stylesheet">
</head>
<body class="md-skin">
<div class="middle-box text-center"">
    <div>
        <h3>Sveiki, atvykę į 1-1.LT</h3>
        <p>Užsiregistruokite norėdami gauti paslaugų paketa, registracija patvirtinama per 24 val.</p>
        <?php if($this->session->flashdata('message')){
            echo"<div class='alert alert-danger'>";
            echo $this->session->flashdata('message');
            echo "</div>";}?>
        <div class="pull-left">Registracija:</div><br>
        <hr>
        <form class="m-t" action="<?= base_url(); ?>auth/register" method="POST" >
            <div class="form-group">
                <?php echo form_error('v_vardas'); ?>
                <input type="text" class="form-control" name="v_vardas" placeholder="Vartotojo vardas" required="">
            </div>
            <div class="form-group">
                <?php echo form_error('vardas'); ?>
                <input type="text" class="form-control" name="vardas" placeholder="Vardas" required="">
            </div>
            <div class="form-group">
                <?php echo form_error('pavarde'); ?>
                <input type="text" class="form-control" name="pavarde" placeholder="Pavardė" required="">
            </div>
            <div class="form-group">
                <?php echo form_error('email'); ?>
                <input type="email" class="form-control" name="email" placeholder="El. paštas" required="">
            </div>
            <div class="form-group">
                <?php echo form_error('password'); ?>
                <input type="password" class="form-control" name="password" placeholder="Slaptažodis" required="">
            </div>
            <div class="form-group">
                <?php echo form_error('password2'); ?>
                <input type="password" class="form-control" name="password2" placeholder="Pakartotį slaptažodį" required="">
            </div>
            <div class="pull-left">
                <div class="form-group">
                    <div class="checkbox checkbox-info">
                        <input  name="sutinku" type="checkbox">
                        <label> Sutinku su taisyklėmis</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">REGISTRUOTIS</button>

            <p class="text-muted text-center"><small>Jau esate užsiregistravęs?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="<?= base_url(); ?>auth/login">PRISIJUNGTI</a>
        </form>
        <p class="m-t"> <small>&copy; 2017 1-1.LT - All Rights Reserved.</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?= base_url(); ?>assets\js\jquery-3.1.1.min.js"></script>
<script src="<?= base_url(); ?>assets\js\bootstrap.min.js"></script>

</body>
</html>
