
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->main_model->info['txt']['meniu']; ?></h2>
        <ol class="breadcrumb">
            <?php echo $this->main_model->info['txt']['info']; ?>
        </ol>
    </div>

    <div class="spin-icon">
        <i class="fa fa-cogs fa-spin"></i>
    </div>
</div>

<?php
if($this->session->flashdata('message')){ ?>
<script type="text/javascript">
    $(document).ready(function() {
    var message = "<?php echo $this->session->flashdata('message'); ?>";
    setTimeout(function() {
        toastr.options = {
            closeButton: true,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
            positionClass: "toast-top-full-width",
            timeOut: "5000",
            hideDuration: "1000"
    };
    toastr.warning(message, 'Informacija');

    }, 0);
    });
    </script>

<?php }
?>
