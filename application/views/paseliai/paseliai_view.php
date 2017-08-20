<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Informacija</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
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
                    foreach($data['results'] as $col){
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
            <?php echo $data['links']; ?>
        </div>
    </div>
</div>