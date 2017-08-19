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
            <h4 class="panel-title">Pašarų normos 1 gyvuliui per parą</h4>
        </div>
        <div class="panel-body">
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
    <!-- end panel -->
</div>
<!-- end #content -->