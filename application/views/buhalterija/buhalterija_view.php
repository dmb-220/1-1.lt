<div class="wrapper wrapper-content">

    <div class="btn-group">
        <button class="btn btn-default" type="button">Dropdown</button>
        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-submenu>
            <span class="caret"></span>
        </button>

        <ul class="dropdown-menu">
            <li class="dropdown-submenu">
                <a tabindex="0">Action</a>

                <ul class="dropdown-menu">
                    <li><a tabindex="0">Sub action</a></li>
                    <li class="dropdown-submenu">
                        <a tabindex="0">Another sub action</a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="0">Sub action</a></li>
                            <li><a tabindex="0">Another sub action</a></li>
                            <li><a tabindex="0">Something else here</a></li>
                        </ul>
                    </li>
                    <li><a tabindex="0">Something else here</a></li>
                    <li class="disabled"><a tabindex="-1">Disabled action</a></li>
                    <li class="dropdown-submenu">
                        <a tabindex="0">Another action</a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="0">Sub action</a></li>
                            <li><a tabindex="0">Another sub action</a></li>
                            <li><a tabindex="0">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown-header">Dropdown header</li>
            <li class="dropdown-submenu">
                <a tabindex="0">Another action</a>

                <ul class="dropdown-menu">
                    <li><a tabindex="0">Sub action</a></li>
                    <li><a tabindex="0">Another sub action</a></li>
                    <li><a tabindex="0">Something else here</a></li>
                </ul>
            </li>
            <li><a tabindex="0">Something else here</a></li>
            <li class="divider"></li>
            <li><a tabindex="0">Separated link</a></li>
        </ul>
    </div>

    <hr>

    <div class="btn-group btn-group-justified">
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">DARBAS <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Sąskaita - Faktūra</a></li>
                <li><a href="#">Automatinis sąskaitų generavimas</a></li>
                <li><a href="#">Krovinio vaštaraštis</a></li>
                <li><a href="#">Prekių gavimas</a></li>
                <li><a href="#">Pardavimas gyventojams</a></li>
                <li><a href="#">Nurašymas</a></li>
                <li><a href="#">Grąžinimas iš pirkėjos</a></li>
                <li class="dropdown-submenu"><a tabindex="-1" href="#">Vidinės sandelio operacijos</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Perrušiavimas</a></li>
                        <li><a href="#">Komplektavimas</a></li>
                        <li><a href="#">Iškomplektavimas</a></li>
                    </ul>
                </li>
                <li><a href="#">PVM užskaita</a></li>
                <li><a href="#">Periodinių duomenų importas / eksportas</a></li>
            </ul>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">GAMYBA <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Prekės</a></li>
                <li><a href="#">Prekių grupės</a></li>
            </ul>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">ŽINYNAI <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Prekės</a></li>
                <li><a href="#">Prekių grupės</a></li>
            </ul>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">PERŽIŪRA <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Sąskaita - Faktūra</a></li>
                <li><a href="#">Automatinis sąskaitų generavimas</a></li>
            </ul>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">ATASKAITOS <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Prekės</a></li>
                <li><a href="#">Prekių grupės</a></li>
            </ul>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">MOKĖJIMAI <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Prekės</a></li>
                <li><a href="#">Prekių grupės</a></li>
            </ul>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">PARAMETRAI <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Sąskaita - Faktūra</a></li>
                <li><a href="#">Automatinis sąskaitų generavimas</a></li>
            </ul>
        </div>
    </div>
    <br>
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
                            <span class="fa  fa-plus-square-o"></span> <br/>Krovinio važtarštis
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