<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Informacija</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
        </div>
    </div>


<?php
if($error['action']) {
    ?>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Informacija</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <table class="table table-bordered text-center">
                <thead>
                <tr>
                    <td rowspan=2><b>Nr.</b></td>
                    <td rowspan=2><b>Data</b></td>
                    <td rowspan=2><b>Operacija</b></td>
                    <td rowspan=2><b>Kiekis</b></td>
                    <td rowspan=2><b>Mato vnt.</b></td>
                    <td colspan=3><b>Pirkimas</b></td>
                    <td colspan=3><b>Pardavimas</b></td>
                    <td rowspan=2><b>Veiksmai</b></td>
                </tr>
                <tr>
                    <td>Vertė</td>
                    <td>PVM</td>
                    <td>Kodas</td>
                    <td>Vertė</td>
                    <td>PVM</td>
                    <td>Kodas</td>
                </tr>
                </thead>
                <tbody
                <tr>
                    <td>1</td>
                    <td>2017.08.26</td>
                    <td>pavedimas sdflghk derhkgoe</td>
                    <td>1</td>
                    <td>12</td>
                    <td>21</td>
                    <td>jkl</td>
                    <td>36</td>
                    <td>11</td>
                    <td>jk</td>
                    <td>
                        <a data-toggle='modal' href='#redaguoti-form' id=".$data[$i]['gid']."
                           class='btn btn-sm btn-outline btn-primary'>
                            <i class='fa fa-edit'></i></a>
                        <a data-toggle='modal' href='#istrinti-form' id=".$data[$i]['gid']."
                           class='btn btn-sm btn-outline btn-danger'>
                            <i class='fa fa-trash'></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}
    ?>
</div>


