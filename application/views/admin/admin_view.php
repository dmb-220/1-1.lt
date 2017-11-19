<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Dashboard</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-6">
                    <h1>Grupės:</h1>
                    <?php
                    $groups = $this->ion_auth->groups()->result();
                    var_dump($groups);
                    ?>
                </div>
                <div class="col-md-6">
                    <h1>Vartotojai:</h1>
                    <?php
                    $users = $this->ion_auth->users()->result();
                    var_dump($users);
                    ?>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">.col-md-4</div>
                <div class="col-md-4">.col-md-4</div>
                <div class="col-md-4">.col-md-4</div>
            </div>
        </div>
    </div>
</div>
