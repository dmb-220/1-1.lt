<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Ūkininkų sąrašas</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Valdos numeris</th>
                <th>Veiksmai</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($this->main_model->info['ukininkai'] as $row) {
                echo"<tr >
                <td>".$row['vardas']."</td >
                <td>".$row['pavarde']."</td >
                <td>".$row['valdos_nr']."</td >
                <td><a href='perziureti/".$row['valdos_nr']."'>Peržiūrėti</a> |<a href='redaguoti/".$row['valdos_nr']."'>Readaguoti</a> | <a href='istrinti/".$row['valdos_nr']."'>Ištrinti</a></td >
            </tr >";
}?>
            </tbody>

        </table>
        </div>
    </div>
</div>
