<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Suformuota sutartis</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <?php
            $dekla = array(
                "pvm_12" => "PVM x12",
                "pvm_2" => "PVM x2",
                "FR457" => "FR457",
                "FR572_12" => "FR572 x12",
                "FR573" => "FR573",
            );
            //var_dump($data);
            ?>
            <div id="table-responsive">
                <div class="text-center">
                    <strong>PASLAUGŲ TEIKIMO SUTARTIS Nr. <?php echo $this->main_model->info['txt']['numeris']; ?></strong>
                </div>
                <div class="text-center">
                    <?php echo $this->main_model->info['txt']['data']; ?>
                </div>
                <div class="text-center">
                    Šiauliai
                </div>
                <br>
                <div class="text-left-left first">
                    <b>UAB Alūzo transportas</b>, atstovaujama direktoriaus <b>Andriaus Norkaus</b>, toliau vadinamu Vykdytoju ir <b><?php echo $this->main_model->info['ukininkas'][0]['vardas']."
                    ".$this->main_model->info['ukininkas'][0]['pavarde']; ?></b> toliau vadinamu užsakovu, sudarėme šią sutartį:
                </div>
                <div class="text-left">
                    1. Sutarties objektas- buhalterinės apskaitos tvarkymas dvejybine apskaitos sistema, suvedant ir susisteminant pateiktus pirminus dokumentus,
                    sudarant finansines, mokestines ataskaitas ir pateikimas ataskaitų vartotojams įstatymų nustatyta tvarka. Apskaita tvarkoma kalendoriniais metais.
                    Finansinės ataskaitos sudaromos vieną kartą metuose. Esant poreikiui tarpinės finansinės ataskaitos aptariamos atskiru susitarimu ir atskirai išrašoma sąskaita.
                </div>
                <div class="text-left">
                    2. Sutartis galioja vienerius kalendorinius metus nuo einamųjų metų pirmosios metų dienos iki einamųjų metų paskutinės kalendorinės dienos.
                </div>
                <div class="text-left">
                    3. Vykdytojas įsipareigoja tvarkyti užsakovo buhalterinę apskaitą nuo užsakovo pateiktų pirminių dokumentų registravimo iki finansinės atskaitomybės pateikimo užsakovui,
                    įskaitant reikalingų deklaracijų teikimą valstybinėms institucijoms. Pasikeitus teisės aktams, situacija aptariama su užsakovu dėl
                    padidėjusių/sumažėjusių/ nekitusių kaštų, terminų ir kitų sąlygų.
                </div>
                <div class="text-left">
                    4. Užsakovas įsipareigoja pateikti visus reikalingus, teisingai įformintus dokumentus bei informaciją teisingam ūkio apskaitos tvarkymui ir
                    laiku atsiskaityti už suteiktas paslauga pagal pateiktas sąskaitas faktūras. Pateikti dokumentai turi būti priskiriami tik ūkio veiklai vykdyti,
                    o asmeniniams poreikiams priskiramos išlaidos/pajamos aiškiai identifikuojamos. Taip pat nenuslėpti ir neatlikti tyčinių veiksmų,
                    kurie gali sukelti pavojų teisingam buhalterinės apskaitos tvarkymui. Užsakovas suteikia visus reikalingus įgaliojimus, priėjimus prie sistemų,
                    duomenų bazių vykdytojui, o vykdytojas įsipareigoja šiuos duomenis tvarkyti LR įstatymų nustatyta tvarka.
                </div>
                <div class="text-left">
                    5. Atsiskaitymo tvarka; užsakovas atsiskaito už paslaugas pagal pateiktas sąskaitas-faktūras. Paslaugos įkainis nustatomas <b><?php echo $data['viso_menesis'] ?></b> eurų per mėnesį.
                    Mėnesinį paslaugų įkainį sumokėti  iki sekančo mėnesio paskutinės kalendorinės dienos. Už gruodžio mėnesį sąskaita išrašoma paskutinio metų mėnesio 31 d.
                    Atlygis indeksuojamas atskiru susitarimu, jei toks susitarimas yra būtinas. Apie tokio susitarimo būtinumą užsakovas informuoja raštu.
                    Už papildomus darbus apmokama atskiru susitarimu.
                </div>
                <div class="text-left">
                    6. Vykdytojas gali reikalauti 0,2 proc. netesybų nuo neapmokėtos sumos, jei užsakovas vėluoja atsiskaityti už suteiktas paslaugas
                    ilgiau nei 45 kalendorines dienas nuosąskaitos-faktūros išrašymo dienos.
                </div>
                <div class="text-left">
                    7. Ši sutartis gali būti keičiama, papildoma, nutraukiama šaliu susitarimu arba bet kurios šalies iniciatyva informuojant kitą šalį prieš vieną
                    kalendorinį mėnesį, iki sutarties nutraukimo turi būti pilnai atsiskaityta už paslaugas ir grąžinti dokumentai užsakovui proporcingai apmokėtiems atliktiems darbams.
                    Užsakovas neteikia archyvavimo paslaugų.
                </div>
                <div class="text-left">
                    8. Ši sutartis sudaryta 2 (dviem) egzemplioriais, turinčiais vienodą juridinę galią. Iškilę ginčai sprendžiami LR įstatymų nustatyta tvarka.
                </div>
                <div class="text-left">
                    9. Šalių atsakomybė už buhalterinę apskaitą numatyta LR Buhalterinės apskaitos įstatyme.
                </div>
                <div class="text-left">
                    10. Ši sutartis yra konfidenciali ir negali būti atskleista tretiesiems asmenims visą sutarties vykdymo laikotarpį ir 1 (vienerius) metus po sutarties nutraukimo,
                    nebent konfidencialios informacijos atskleidimas yra būtinas LR įstatymų nustatyta tvarka. Pažeidus šį punktą taikomos netesybos 12 VDU.
                </div>
                <br>
                <br>

                <div class="pull-left">Direktorius Andrius Norkus</div>
                <div class="pull-right"><?php echo $this->main_model->info['ukininkas'][0]['vardas']." ".$this->main_model->info['ukininkas'][0]['pavarde']; ?></div>
                <br>
                <div class="pull-left">UAB Alūzo transportas</div>
                <div class="pull-right">a.k. <?php if($this->main_model->info['ukininkas'][0]['asmens_kodas']){ echo $this->main_model->info['ukininkas'][0]['asmens_kodas']; }else{echo"NERASTA";} ?></div>
                <br>
                <div class="pull-left">įm.k. 301151289</div>
                <div class="pull-right"> </div>
                <br>
                <div class="pull-left">A.Mickevičiaus g. 3-46 Šiauliai</div>
                <div class="pull-right"><?php if($this->main_model->info['ukininkas'][0]['adresas']){ echo $this->main_model->info['ukininkas'][0]['adresas']; }else{echo"NERASTA";} ?></div>
                <br>
                <div class="pull-left">A.s. LT567290000006467266</div>
                <div class="pull-right"><?php if($this->main_model->info['ukininkas'][0]['saskaitos_nr']){ echo $this->main_model->info['ukininkas'][0]['saskaitos_nr']; }else{echo"NERASTA";} ?></div>
                <br>
                <div class="pull-left">AB Citadelė bankas</div>
                <div class="pull-right"><?php if($this->main_model->info['ukininkas'][0]['bankas']){ echo $this->main_model->info['ukininkas'][0]['bankas']; }else{echo"NERASTA";} ?></div>
                <br>
                <div class="pull-left">El. p. aluzotransportas@gmail.com</div>
                <div class="pull-right">El. p. <?php if($this->main_model->info['ukininkas'][0]['email']){ echo $this->main_model->info['ukininkas'][0]['email']; }else{echo"NERASTA";} ?></div>
                <br>
                <div class="pull-left">Tel. 864541649</div>
                <div class="pull-right">Tel. <?php if($this->main_model->info['ukininkas'][0]['telefonas']){ echo $this->main_model->info['ukininkas'][0]['telefonas']; }else{echo"NERASTA";} ?></div>
                <br>
                <br>
                <div class="break">
                    <div class="text-center">
                        <h4><strong>SUTARTIES PRIEDAS NR. 1</strong></h4>
                    </div>
                    <br>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Paslauga</th>
                        <th>Kiekis</th>
                        <th>Kaina už menesį</th>
                        <th>Kaina už metus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($data['pirminiai'] != ""){
                    echo"<tr>
                        <td>Pirminiai dokumentai</td>
                        <td>".$data['pirminiai']." vnt.</td>
                        <td>".$data['pirminiai_menuo']."</td>
                        <td>".$data['pirminiai_metai']."</td>
                    </tr>";}

                    if($data['is_darbininkai_2'] == "on" && $data['darbuotojai_2_kiekis'] > 0){
                        echo"<tr>
                        <td>Darbuotojai</td>
                        <td>".$data['darbuotojai_2_kiekis']." vnt.</td>
                        <td>".$data['darbuotojai_2_menesis']."</td>
                        <td>".$data['darbuotojai_2_metai']."</td>
                    </tr>";}

                    if($data['is_darbininkai'] == "on" && $data['darbuotojai_kiekis'] > 0){
                        echo"<tr>
                        <td>Darbuotojai *</td>
                        <td>".$data['darbuotojai_kiekis']." vnt.</td>
                        <td>".$data['darbuotojai_menesis']."</td>
                        <td>".$data['darbuotojai_metai']."</td>
                    </tr>";}

                    if($data['galvijai_kiekis'] > 0){
                        echo"<tr>
                        <td>Galvijai</td>
                        <td>".$data['galvijai_kiekis']." vnt.</td>
                        <td>".$data['galvijai_menesis']."</td>
                        <td>".$data['galvijai_metai']."</td>
                    </tr>";}

                    if($data['dek_plotas'] > 0){
                        echo"<tr>
                        <td>Deklaruojamas plotas</td>
                        <td>".$data['dek_plotas']." ha.</td>
                        <td>".$data['suma_menesis']."</td>
                        <td>".$data['suma_metai']."</td>
                    </tr>";}

                    if($data['bankai'] > 0){
                        echo"<tr>
                        <td>Bankai</td>
                        <td>".$data['bankai']." vnt.</td>
                        <td>".$data['bankai_menesis']."</td>
                        <td>".$data['bankai_metai']."</td>
                    </tr>";}

                    if($data['kreditai'] > 0){
                        echo"<tr>
                        <td>Kreditai</td>
                        <td>".$data['kreditai']." vnt.</td>
                        <td>".$data['kreditai_menesis']."</td>
                        <td>".$data['kreditai_metai']."</td>
                    </tr>";}

                    if(count($data['deklaracija']) > 0){
                        echo"<tr>
                        <td>Deklaracijos</td>
                        <td>"; foreach ($data['deklaracija'] as $row){echo $dekla[$row].", ";} echo"</td>
                        <td>".$data['deklaracija_menesis']."</td>
                        <td>".$data['deklaracija_metai']."</td>
                    </tr>";}

                    if($data['gamtos_apsauga'] =="on"){
                        echo"<tr>
                        <td>Aplinkos taršos mokestis</td>
                        <td> </td>
                        <td>".$data['apsauga_menesis']."</td>
                        <td>".$data['apsauga_metai']."</td>
                    </tr>";}

                    if($data['europa'] =="on"){
                        echo"<tr>
                        <td>Europos parama</td>
                        <td> </td>
                        <td>".$data['europa_menesis']."</td>
                        <td>".$data['europa_metai']."</td>
                    </tr>";}

                    if($data['saskaita'] =="on"){
                        echo"<tr>
                        <td>Sąskaitų planas</td>
                        <td> </td>
                        <td>".$data['saskaita_menesis']."</td>
                        <td>".$data['saskaita_metai']."</td>
                    </tr>";}

                    if($data['kuras'] == "on" && $data['kuras_kiekis'] > 0){
                        echo"<tr>
                        <td>Kuro apskaita</td>
                        <td>".$data['kuras_kiekis']." vnt.</td>
                        <td>".$data['kuras_menesis']."</td>
                        <td>".$data['kuras_metai']."</td>
                    </tr>";}

                    if($data['judejimas'] == "on"){
                        echo"<tr>
                        <td>Galvijų judejimas</td>
                        <td> </td>
                        <td>".$data['judejimas_menesis']."</td>
                        <td>".$data['judejimas_metai']."</td>
                    </tr>";}

                    ?>
                    </tbody>
                </table>
                    <hr>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>...</th>
                        <th>Už menesį</th>
                        <th>Už metus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($data['nuolaida'] > 0){
                    echo"<tr>
                        <td>Nuolaida</td>
                        <td>".$data['nuolaida_menesis']."</td>
                        <td>".$data['nuolaida_metai']."</td>
                    </tr>";}
                    echo"<tr>
                        <td>Viso</td>
                        <td>".$data['viso_menesis']."</td>
                        <td>".$data['viso_metai']."</td>
                    </tr>";
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-outline btn-primary" type="button" onclick="PrintElem('.table-responsive')">
                    <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
                </button>
            </div>
        </div>
    </div>
</div>

