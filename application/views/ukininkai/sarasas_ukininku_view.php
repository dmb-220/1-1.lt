<!-- begin #content -->
<div id="content" class="content">
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Ūkininkų sąrašas</h4>
        </div>
        <div class="panel-body">

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
<!-- end #content -->