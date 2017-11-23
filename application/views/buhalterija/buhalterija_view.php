<div class="wrapper wrapper-content">
    <?php
    $this->load->view("buhalterija/meniu_view");
    ?>
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-star-o"></i> Pirkimai / Pardavimai</a></li>
            <li><a data-toggle="tab" href="#menu1"><i class="fa fa-star-o"></i> Žinynai</a></li>
            <li><a data-toggle="tab" href="#menu2"><i class="fa fa-star-o"></i> Mokėjimai</a></li>
            <li><a data-toggle="tab" href="#menu3"><i class="fa fa-briefcase"></i><span> Darbo užm.</span></a></li>
            <li><a data-toggle="tab" href="#menu4"><i class="fa fa-briefcase"></i><span> Buhalterija</span></a></li>
            <li><a data-toggle="tab" href="#menu5"><i class="fa fa-briefcase"></i><span> Ilgal. turtas</span></a></li>
            <li><a data-toggle="tab" href="#menu6"><i class="fa fa-briefcase"></i><span> Užsakymai</span></a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="panel-body">
                    <div class="alert alert-success" role="alert">
                        <a data-toggle="modal" data-target="#laikotarpis" class="btn btn-default" role="button">
                            <span class="glyphicon glyphicon glyphicon-calendar"></span> <br/>Sąskaita - Faktūra
                        </a>
                        <a data-toggle="modal" data-target="#organizaciju_sarasas" class="btn btn-default" role="button">
                            <span class="fa  fa-plus-square-o"></span> <br/>Krovinio važtaraštis
                        </a>
                        <a data-toggle="modal" data-target="#naujas_irasas" class="btn btn-default" role="button">
                            <span class="fa fa-pencil-square-o"></span> <br/>Nurašymas
                        </a>
                        <a data-toggle="modal" data-target="#naujas_irasas" class="btn btn-default" role="button">
                            <span class="fa fa-pencil-square-o"></span> <br/>Gavimas
                        </a>
                        <a data-toggle="modal" data-target="#naujas_irasas" class="btn btn-default" role="button">
                            <span class="fa fa-pencil-square-o"></span> <br/>Nurašymas
                        </a>
                        <a data-toggle="modal" data-target="#naujas_irasas" class="btn btn-default" role="button">
                            <span class="fa fa-pencil-square-o"></span> <br/>Pardavimai gyventojams
                        </a>
                        <a data-toggle="modal" data-target="#naujas_irasas" class="btn btn-default" role="button">
                            <span class="fa fa-pencil-square-o"></span> <br/>Likučiai
                        </a>
                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="panel-body">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <div class="panel-body">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
                </div>
            </div>
            <div id="menu3" class="tab-pane fade">
                <div class="panel-body">
                <h3>Menu 3</h3>
                <p>Some content in menu 3.</p>
                </div>
            </div>
            <div id="menu4" class="tab-pane fade">
                <div class="panel-body">
                <h3>Menu 4</h3>
                <p>Some content in menu 4.</p>
                </div>
            </div>
            <div id="menu5" class="tab-pane fade">
                <div class="panel-body">
                <h3>Menu 5</h3>
                <p>Some content in menu5.</p>
                </div>
            </div>
            <div id="menu6" class="tab-pane fade">
                <div class="panel-body">
                <h3>Menu 6</h3>
                <p>Some content in menu 6.</p>
                </div>
            </div>
        </div>
    </div>
</div>