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
            for($i = 0; $i < count($data); $i++) {
                echo"<tr >
                <td>".$data[$i][vardas]."</td >
                <td>".$data[$i][pavarde]."</td >
                <td>".$data[$i][valdos_nr]."</td >
                <td><a href='redaguoti/".$data[$i][valdos_nr]."'>Readaguoti</a> | <a href='istrinti/".$data[$i][valdos_nr]."'>Ištrinti</a></td >
            </tr >";
}?>
            </tbody>

        </table>
        </div>
    </div>
</div>
