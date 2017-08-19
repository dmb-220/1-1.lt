<!-- begin #content -->
<div id="content" class="content">
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Pasėliai</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Sutrumpinimas (kodas)</th>
                        <th>Pavadinimas</th>
                        <th>Sėklos (kg.), 1 ha.</th>
                        <th>Derlius (kg.), iš 1 ha.</th>
                        <th>Veiksmai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($results as $col){
                        echo"<tr><td><b>".$col['sutrumpinimas']."</b></td>";
                        echo"<td>".$col['pavadinimas']."</td>";
                        echo"<td>".$col['sekla']."</td>";
                        echo"<td>".$col['derlius']."</td>"; ?>
                        <td><a href='<?= base_url(); ?>paseliai/redaguoti_kodas/read/<?= $col['sutrumpinimas'] ?>'>Redaguoti</a> | <a href='<?= base_url(); ?>paseliai/istrinti_kodas'>Istrinti</a></td>
                        <?php echo"</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <?php echo $links; ?>

        </div>
    </div>
</div>
<!-- end panel -->
</div>
<!-- end #content -->