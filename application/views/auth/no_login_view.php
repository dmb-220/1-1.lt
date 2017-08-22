<div class="wrapper wrapper-content animated fadeInRight">
    <?php
    if($this->session->flashdata('message')){ ?>
        <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> ATSIJUNGTA
        </div>
        <div class="panel-body">
        <?php echo $this->session->flashdata('message'); ?>
        </div>
    </div>
    <?php }
    ?>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Informacija</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            Informacija neturintiems prisijungimo.<br>
            Kam skirtas puslapis.<br>
            Kas gali juo naudotis.<br>
            Kaip gauti prieiga prie šio puslapio.
        </div>
    </div>
</div>



