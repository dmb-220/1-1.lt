<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Lentelė su pašarų normomis</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th border="1" class="hidden-xs">Gyvuliai</th>
                    <th>Šienas</th>
                    <th>Šiaudai</th>
                    <th>Grudai</th>
                    <th>Šakniavaisiai</th>
                    <th>Šienainis</th>
                    <th>Bulvės</th>
                    <th>Silosas</th>
                    <th>Runkeliai</th>
                    <th>VEIKSMAI</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for($i = 0; $i < count($data); $i++) {
                    echo"<tr >
                <td><strong>".$data[$i]['gyvuliai']."</strong></td >
                <td>".$data[$i]['sienas']." kg.</td >
                <td>".$data[$i]['siaudai']." kg.</td >
                <td>".$data[$i]['grudai']." kg.</td >
                <td>".$data[$i]['sakniavaisiai']."kg.</td >
                <td>".$data[$i]['sienainis']." kg.</td >
                <td>".$data[$i]['bulves']." kg.</td >
                <td>".$data[$i]['silosas']." kg.</td >
                <td>".$data[$i]['runkeliai']." kg.</td >
                <td><a href='redaguoti/".$data[$i]['gid']."'>Readaguoti</a> | <a href='istrinti/".$data[$i]['gid']."'>Ištrinti</a></td >
            </tr >";
                }?>
                </tbody>

            </table>
        </div>
    </div>
</div>