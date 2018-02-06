<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>PRANEŠIMAI</h5>
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
        ?>
    </div>
</div>