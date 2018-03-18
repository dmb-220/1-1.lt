<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Banko išrašo įkėlimas</h5>
        <div class="ibox-tools">
            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            <a class="close-link"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="ibox-content">
    <?php
    //isvedamos klaidos
    if(count($this->main_model->info['error']) > 0){
        foreach ($this->main_model->info['error'] as $klaida){
            echo'<div class="alert alert-danger">';
            echo $klaida;
            echo '</div>';
        }
    }
        echo"Bandymas";
        var_dump($mokejimai);
        ?>
    </div>
</div>