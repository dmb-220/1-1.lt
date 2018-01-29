<?php
$menesiai = array("Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsejis", "Spalis","Lapkritis", "Gruodis");
?>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Duomenų įkėlimas iš (VIC.LT)</h5>
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
        /*if($this->main_model->info['txt']['galviju_sk'] > 0){
            echo"<div class='alert alert-info'<h3>".$this->main_model->info['txt']['metai']." - ".$menesiai[$this->main_model->info['txt']['menesis']-1].",
             rasti ".$this->main_model->info['txt']['galviju_sk']." galvijų įrašai.</h3></div>";
        }else{
            echo"<div class='alert alert-info'<h3>".$this->main_model->info['txt']['metai']." - ".$menesiai[$this->main_model->info['txt']['menesis']-1].",
            duomenų apie galvijus nerasta.</h3></div>";
        }*/
        ?>
    </div>
</div>