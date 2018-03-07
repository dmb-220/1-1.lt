<div class="wrapper wrapper-content">
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
            //echo serialize($data);
            ?>
            <div id="sutartis">
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
                <div class="text-justify first">
                    <b>UAB Alūzo transportas</b>, atstovaujama direktoriaus <b>Andriaus Norkaus</b>, toliau vadinamu Vykdytoju ir <b><?php echo $this->main_model->info['ukininkas'][0]['vardas']."
                    ".$this->main_model->info['ukininkas'][0]['pavarde']; ?></b> toliau vadinamu užsakovu, sudarėme šią sutartį:
                </div>
                <div class="text-justify">
                    1. Sutarties objektas- buhalterinės apskaitos tvarkymas dvejybine apskaitos sistema, suvedant ir susisteminant pateiktus pirminus dokumentus,
                    sudarant finansines, mokestines ataskaitas ir pateikimas ataskaitų vartotojams įstatymų nustatyta tvarka. Apskaita tvarkoma kalendoriniais metais.
                    Finansinės ataskaitos sudaromos vieną kartą metuose. Esant poreikiui tarpinės finansinės ataskaitos aptariamos atskiru susitarimu ir atskirai išrašoma sąskaita.
                </div>
                <div class="text-justify">
                    2. Sutartis galioja vienerius kalendorinius metus nuo einamųjų metų pirmosios metų dienos iki einamųjų metų paskutinės kalendorinės dienos.
                </div>
                <div class="text-justify">
                    3. Vykdytojas įsipareigoja tvarkyti užsakovo buhalterinę apskaitą nuo užsakovo pateiktų pirminių dokumentų registravimo iki finansinės atskaitomybės pateikimo užsakovui,
                    įskaitant reikalingų deklaracijų teikimą valstybinėms institucijoms. Pasikeitus teisės aktams, situacija aptariama su užsakovu dėl
                    padidėjusių/sumažėjusių/ nekitusių kaštų, terminų ir kitų sąlygų.
                </div>
                <div class="text-justify">
                    4. Užsakovas įsipareigoja pateikti visus reikalingus, teisingai įformintus dokumentus bei informaciją teisingam ūkio apskaitos tvarkymui iki sekančio mėnesio 15 d. ir
                    laiku atsiskaityti už suteiktas paslaugas pagal pateiktas sąskaitas faktūras. Pateikti dokumentai turi būti priskiriami tik ūkio veiklai vykdyti,
                    o asmeniniams poreikiams priskiramos išlaidos/pajamos aiškiai identifikuojamos. Taip pat nenuslėpti ir neatlikti tyčinių veiksmų,
                    kurie gali sukelti pavojų teisingam buhalterinės apskaitos tvarkymui. Užsakovas suteikia visus reikalingus įgaliojimus, priėjimus prie sistemų,
                    duomenų bazių vykdytojui, o vykdytojas įsipareigoja šiuos duomenis tvarkyti LR įstatymų nustatyta tvarka.
                </div>
                <div class="text-justify">
                    5. Atsiskaitymo tvarka; užsakovas atsiskaito už paslaugas pagal pateiktas sąskaitas-faktūras. Paslaugos įkainis nustatomas <b><?php echo $data['viso_menesis'] ?></b> eurų per mėnesį.
                    Mėnesinį paslaugų įkainį sumokėti  iki sekančo mėnesio paskutinės kalendorinės dienos. Už gruodžio mėnesį sąskaita išrašoma paskutinio metų mėnesio 31 d.
                    Atlygis indeksuojamas atskiru susitarimu, jei toks susitarimas yra būtinas. Apie tokio susitarimo būtinumą užsakovas informuoja raštu.
                    Už papildomus darbus apmokama atskiru susitarimu.
                </div>
                <div class="text-justify">
                    6. Vykdytojas gali reikalauti 0,2 proc. netesybų nuo neapmokėtos sumos, jei užsakovas vėluoja atsiskaityti už suteiktas paslaugas
                    ilgiau nei 45 kalendorines dienas nuosąskaitos-faktūros išrašymo dienos. Už pavėluotą dokumentų peteikimą (4 punktas) vykdytojui,
                    gali būti skaičiuojamas sutarties netesybos - 1 euras už 1 pavėluotą kalendorinę dieną.
                </div>
                <div class="text-justify">
                    7. Ši sutartis gali būti keičiama, papildoma, nutraukiama šaliu susitarimu arba bet kurios šalies iniciatyva informuojant kitą šalį prieš vieną
                    kalendorinį mėnesį, iki sutarties nutraukimo turi būti pilnai atsiskaityta už paslaugas ir grąžinti dokumentai užsakovui proporcingai apmokėtiems atliktiems darbams.
                    Užsakovas neteikia archyvavimo paslaugų.
                </div>
                <div class="text-justify">
                    8. Ši sutartis sudaryta 2 (dviem) egzemplioriais, turinčiais vienodą juridinę galią. Iškilę ginčai sprendžiami LR įstatymų nustatyta tvarka.
                </div>
                <div class="text-justify">
                    9. Šalių atsakomybė už buhalterinę apskaitą numatyta LR Buhalterinės apskaitos įstatyme.
                </div>
                <div class="text-justify">
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
                <div class="pull-left">A.s. LT50 7300 0101 5253 5051</div>
                <div class="pull-right"><?php if($this->main_model->info['ukininkas'][0]['saskaitos_nr']){ echo $this->main_model->info['ukininkas'][0]['saskaitos_nr']; }else{echo"NERASTA";} ?></div>
                <br>
                <div class="pull-left">AB Swedbank bankas</div>
                <div class="pull-right"><?php if($this->main_model->info['ukininkas'][0]['bankas']){ echo $this->main_model->info['ukininkas'][0]['bankas']; }else{echo"NERASTA";} ?></div>
                <br>
                <div class="pull-left">El. p. aluzotransportas@gmail.com</div>
                <div class="pull-right">El. p. <?php echo $this->main_model->info['ukininkas'][0]['email']; ?></div>
                <br>
                <div class="pull-left">Tel. 864541649</div>
                <div class="pull-right">Tel. <?php echo $this->main_model->info['ukininkas'][0]['telefonas']; ?></div>
                <br><br><br><br>
                <div class="pull-left">
                    ......................................................................
                    <div class="text-center"><h5><small>(Parašas)</small></h5></div>
                </div>
                <div class="pull-right">
                    .......................................................................
                    <div class="text-center"><h5><small>(Parašas)</small></h5></div>
                </div>
                <br><br><br><br><br><br>

                <div class="break">
                <div class="text-center">
                    <h4><strong>Sutarties priedas nr. 1</strong></h4>
                </div>
                <hr>
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
                <tr><td class='success' colspan='4'>BAZINĖ KAINA</td></tr>
                <?php
                if($data['pirminiai'] != ""){
                echo"<tr>
                    <td>Pirminiai dokumentai</td>
                    <td>".$data['pirminiai']." vnt.</td>
                    <td>".$data['pirminiai_menuo']."</td>
                    <td>".$data['pirminiai_metai']."</td>
                </tr>";
                    echo"<tr><td class='text-left' colspan='4'><h5><small> Pagal įrašų skaičių nustatoma kaina. Vienas įrašas neapsiriboja sąskaitos įvedimu. 
Į įrašų skaičių patenka nurašymai, pajamavimas, kiti tarpiniai įrašai, reikalingi teisingos buhalterijos tvarkymui.</small></h5></td></tr>";}

                if($data['inventorizacija_kiekis'] !=""){
                    echo"<tr>
                    <td>Metinė inventorizacija</td>
                    <td>".$data['inventorizacija_kiekis']." vnt.</td>
                    <td>".$data['inventorizacija_menesis']."</td>
                    <td>".$data['inventorizacija_metai']."</td>
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

                if($data['saskaita'] =="on"){
                    echo"<tr>
                    <td>Sąskaitų planas</td>
                    <td> </td>
                    <td>".$data['saskaita_menesis']."</td>
                    <td>".$data['saskaita_metai']."</td>
                </tr>";
                    echo"<tr><td class='text-left' colspan='4'><h5><small>2018-01-01 pasikeitus ūkininkų sąskaitų planui, neišvengiamai turi būti buhalterijos pervedimas prie naujo sąskaitų planų. 
Šis sąskaitų planas programuotojų apmokestinamas.</small></h5></td></tr>";}


                if($data['is_darbininkai_2'] == "on" && $data['darbuotojai_2_kiekis'] > 0) {
                    echo "<tr><td class='success' colspan='4'>DARBO UŽMOKESČIO APSKAITOS KAINA</td></tr>";

                    if ($data['is_darbininkai_2'] == "on" && $data['darbuotojai_2_kiekis'] > 0) {
                        echo "<tr>
                    <td>Darbuotojai</td>
                    <td>" . $data['darbuotojai_2_kiekis'] . " vnt.</td>
                    <td>" . $data['darbuotojai_2_menesis'] . "</td>
                    <td>" . $data['darbuotojai_2_metai'] . "</td>
                </tr>";
                    }

                    if ($data['is_darbininkai'] == "on" && $data['darbuotojai_kiekis'] > 0) {
                        echo "<tr>
                    <td>Darbuotojai *</td>
                    <td>" . $data['darbuotojai_kiekis'] . " vnt.</td>
                    <td>" . $data['darbuotojai_menesis'] . "</td>
                    <td>" . $data['darbuotojai_metai'] . "</td>
                </tr>";
                    }
                    if ($data['darbuotojai_kiekis'] > 0 || $data['darbuotojai_2_kiekis'] > 0) {
                        echo "<tr><td class='text-left' colspan='4'><h5><small>Į šią kainą įeina darbuotojų darbo užmokesčio skaičiavimas, tabelio pildymas, kitos ataskaitos, 
išskyrus deklaracijos teikimus. </small></h5></td></tr>";
                    }

                    //<!-- FR572 keiciam i GPM313 FR573 keiciam i GPM312 -->
                    if ($data['darbuotojai_kiekis'] > 0 || $data['darbuotojai_2_kiekis'] > 0) {
                        echo "<tr>
                    <td>GPM313 forma</td>
                    <td> </td>
                    <td>" . $data['fr572_menesis'] . "</td>
                    <td>" . $data['fr572_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>Mėnesinė pajamų mokesčio nuo A klasės pajamų deklaracija.</small></h5></td></tr>";
                    }

                    if ($data['darbuotojai_kiekis'] > 0 || $data['darbuotojai_2_kiekis'] > 0) {
                        echo "<tr>
                    <td>GPM312 forma</td>
                    <td> </td>
                    <td>" . $data['fr573_menesis'] . "</td>
                    <td>" . $data['fr573_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>Metinė A klasės išmokų, nuo jų išskaičiuoto ir sumokėto pajamų mokesčio deklaracija.</small></h5></td></tr>";
                    }

                    if ($data['sam_kiekis'] > 0) {
                        echo "<tr>
                    <td>SAM pranešimai</td>
                    <td>" . $data['sam_kiekis'] . " vnt.</td>
                    <td>" . $data['sam_menesis'] . "</td>
                    <td>" . $data['sam_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>Samdomiems darbuotojams apskaičiuoti ATLYGINIMAI bei ĮMOKOS „Sodrai“.</small></h5></td></tr>";
                    }

                    if ($data['sd_kiekis'] > 0) {
                        echo "<tr>
                    <td>SD pranešimai</td>
                    <td>" . $data['sd_kiekis'] . " vnt.</td>
                    <td>" . $data['sd_menesis'] . "</td>
                    <td>" . $data['sd_metai'] . "</td>
                </tr>";
                    }
                }

                if($data['galvijai_kiekis'] > 0 || $data['dek_plotas'] > 0 || $data['technika_kiekis']) {
                    echo "<tr><td class='success' colspan='4'>";
                    if ($this->main_model->info['txt']['ukis'] == 0) {
                        echo 'GYVULININKYSTĖS APSKAITOS KAINA';
                    }
                    if ($this->main_model->info['txt']['ukis'] == 1) {
                        echo 'AUGALININKYSTĖS APSKAITOS KAINA';
                    }
                    echo "</td></tr>";

                    if ($data['galvijai_kiekis'] > 0) {
                        echo "<tr>
                    <td>Galvijai</td>
                    <td>" . $data['galvijai_kiekis'] . " vnt.</td>
                    <td>" . $data['galvijai_menesis'] . "</td>
                    <td>" . $data['galvijai_metai'] . "</td>
                </tr>";
                    }

                    if($data['judejimas'] == "on"){
                        echo"<tr>
                    <td>Galvijų judejimas</td>
                    <td> </td>
                    <td>".$data['judejimas_menesis']."</td>
                    <td>".$data['judejimas_metai']."</td>
                </tr>";}

                    if ($data['dek_plotas'] > 0) {
                        echo "<tr>
                    <td>Deklaruojamas plotas</td>
                    <td>" . $data['dek_plotas'] . " ha.</td>
                    <td>" . $data['suma_menesis'] . "</td>
                    <td>" . $data['suma_metai'] . "</td>
                </tr>";
                    }

                    if ($data['technika'] == "on" && $data['technika_kiekis']) {
                        echo "<tr>
                    <td>Technika</td>
                    <td>" . $data['technika_kiekis'] . " vnt.</td>
                    <td>" . $data['technika_menesis'] . "</td>
                    <td>" . $data['technika_metai'] . "</td>
                </tr>";
                    }
                }

                if($data['pvm_x12'] == "on" || $data['pvm_x2'] == "on" || $data['fr457_kiekis'] > 0 || $data['gpm308'] == "on" ||
                    $data['sav1_kiekis'] > 0 || $data['ivaz_kiekis'] > 0 || $data['isaf_12'] == "on" || $data['isaf_2'] == "on") {
                    echo "<tr><td class='success' colspan='4'>DEKLARACIJŲ KAINA</td></tr>";

                    if ($data['pvm_x12'] == "on") {
                        echo "<tr>
                    <td>PVM x12</td>
                    <td> </td>
                    <td>" . $data['pvm_x12_menesis'] . "</td>
                    <td>" . $data['pvm_x12_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>PVM deklaracija 12 kartų per metus, t.y. kiekviena menesį. </small></h5></td></tr>";
                    }

                    if ($data['pvm_x2'] == "on") {
                        echo "<tr>
                    <td>PVM x2</td>
                    <td> </td>
                    <td>" . $data['pvm_x2_menesis'] . "</td>
                    <td>" . $data['pvm_x2_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>PVM deklaracija 2 kartų per metus, t.y. kartą per pusmetį.</small></h5></td></tr>";
                    }

                    if ($data['fr457'] == "on" && $data['fr457_kiekis'] > 0) {
                        echo "<tr>
                    <td>FR457 forma</td>
                    <td> </td>
                    <td>" . $data['fr457_menesis'] . "</td>
                    <td>" . $data['fr457_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>Individualioje veikloje naudojamo ilgalaikio materialiojo turto deklaracija.</small></h5></td></tr>";
                    }

                    if ($data['gpm308'] == "on") {
                        echo "<tr>
                    <td>GPM308 forma</td>
                    <td> </td>
                    <td>" . $data['gpm308_menesis'] . "</td>
                    <td>" . $data['gpm308_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>Metinė pajamų deklaracija.</small></h5></td></tr>";
                    }

                    if ($data['sav1'] == "on" && $data['sav1_kiekis'] > 0) {
                        echo "<tr>
                    <td>SAV1 forma</td>
                    <td>" . $data['sav1_kiekis'] . "</td>
                    <td>" . $data['sav1_menesis'] . "</td>
                    <td>" . $data['sav1_metai'] . "</td>
                </tr>";
                    }

                    if ($data['ivaz'] == "on" && $data['ivaz_kiekis'] > 0) {
                        echo "<tr>
                    <td>I-VAZ</td>
                    <td>" . $data['ivaz_kiekis'] . "</td>
                    <td>" . $data['ivaz_menesis'] . "</td>
                    <td>" . $data['ivaz_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>i.VAZ - elektroninių važtaraščių posistemis.</small></h5></td></tr>";
                    }

                    if ($data['isaf_12'] == "on") {
                        echo "<tr>
                    <td>I-SAF x12</td>
                    <td> </td>
                    <td>" . $data['isaf_12_menesis'] . "</td>
                    <td>" . $data['isaf_12_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>i.SAF - elektroninis sąskaitų faktūrų posistemis. Teikiama 12 kart per metus, t.y. kiekvien1 menesį.</small></h5></td></tr>";
                    }

                    if ($data['isaf_2'] == "on") {
                        echo "<tr>
                    <td>I-SAF x2</td>
                    <td> </td>
                    <td>" . $data['isaf_2_menesis'] . "</td>
                    <td>" . $data['isaf_2_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>i.SAF - elektroninis sąskaitų faktūrų posistemis. Teikiama 2 kartus per metus, t.y. kas pusmetį</small></h5></td></tr>";
                    }
                }


                if($data['kuras_kiekis'] > 0 || $data['gamtos_apsauga'] == "on" || $data['zemes_kiekis'] > 0 || $data['europa'] == "on") {
                    echo "<tr><td class='success' colspan='4'>KITŲ PASLAUGŲ KAINA</td></tr>";

                    if ($data['gamtos_apsauga'] == "on") {
                        echo "<tr>
                    <td>Aplinkos taršos mokestis</td>
                    <td> </td>
                    <td>" . $data['apsauga_menesis'] . "</td>
                    <td>" . $data['apsauga_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>Pagal LR atliekų tvarkymo įstatymą į Lietuvą įvežus daugiau kaip 5 vnt. baterijų savo reikmėms, 
o verslo reikmėms nuo pirmo tokio vieneto gamintojas arba importuotojas turi registruotis Gamintojų ir importuotojų sąvade, organizuoti surinkimą, vežimą, pasiruošimą naudoti, 
šviesti visuomenę gaminių tvarkymo klausimais, tvarkyti gaminių apskaitą, teikti ataskaitas.<br>
Nuo mokesčio už aplinkos teršimą iš mobilių taršos šaltinių atleidžiami:
    1. fiziniai ir juridiniai asmenys, turintys išmetamųjų dujų neutralizavimo sistemas
    2. fiziniai ir juridiniai asmenys, teršiantys iš transporto priemonių naudojamų žemės ūkio veiklai, jei jų pajamos iš šios veiklos sudaro daugiau kaip 50 procentų visų gaunamų pajamų.
    3. fiziniai asmenys, kurie verčiasi individualia veikla ir naudoją asmenines transporto priemones.
    4. fiziniai ir juridiniai asmenys naudojantys biodegalus.<br>
Nuo mokesčio už aplinkos teršimą iš stacionarių taršos šaltinių atleidžiami:
    1. fiziniai ir juridiniai asmenys, įgyvendinantys aplinkosaugos priemones.
    2. fiziniai ir juridiniai asmenys, pateikę ... sunaudojimą patvirtinančius dokumentus
.</small></h5></td></tr>";
                    }

                    if ($data['zemes_mokestis'] == "on" && $data['zemes_kiekis'] > 0) {
                        echo "<tr>
                    <td>Žemės mokestis</td>
                    <td>" . $data['zemes_kiekis'] . " vnt.</td>
                    <td>" . $data['zemes_menesis'] . "</td>
                    <td>" . $data['zemes_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>Nuo 2018-01-01 mokant žemės mokestį, ūkininkas privalo išskaičiuoti gyventojų pajamų mokestį, sumokėti ir deklaruoti VMI.<br>
Nuo 2018-01-01 mokant žemės nuomos mokestį fiziniams asmenims, ūkininkas privalo išskaičiuoti ir deklaruoti gyventojų pajamų mokestį GPM313 deklaracijoje.</small></h5></td></tr>";
                    }

                    if ($data['europa'] == "on") {
                        echo "<tr>
                    <td>Europos parama</td>
                    <td> </td>
                    <td>" . $data['europa_menesis'] . "</td>
                    <td>" . $data['europa_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>Pasinaudojus ES struktūrinių fondų, kita ES parama skaičiuojamas paramos procentas, 
skirstomas paramos nusidėvėjimas ir nusidėvėjimas standartinėmis sąnaudomis.</small></h5></td></tr>";
                    }


                    if ($data['kuras'] == "on" && $data['kuras_kiekis'] > 0) {
                        echo "<tr>
                    <td>Kuro apskaita</td>
                    <td>" . $data['kuras_kiekis'] . " vnt.</td>
                    <td>" . $data['kuras_menesis'] . "</td>
                    <td>" . $data['kuras_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>Kuro apskaitą vykdome, jei įtraukiami į apskaitą visų rūšių degalai. 
Pildomi kelionės lapai kiekvienai transporto priemonei. </small></h5></td></tr>";
                    }

                    if ($data['kitos_paslaugos'] == "on" && $data['kitos_paslaugos_kiekis'] > 0) {
                        echo "<tr>
                    <td>Kitos paslaugos</td>
                    <td>" . $data['kitos_paslaugos_kiekis'] . " vnt.</td>
                    <td>" . $data['kitos_paslaugos_menesis'] . "</td>
                    <td>" . $data['kitos_paslaugos_metai'] . "</td>
                </tr>";
                        echo "<tr><td class='text-left' colspan='4'><h5><small>Kitos paslaugos, teikiamos ūkininkui, kai netinka, jokiai kitai kategorijai.</small></h5></td></tr>";
                    }
                }

                ?>
                </tbody>
            </table>
                <hr>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th> </th>
                    <th>Už menesį</th>
                    <th>Už metus</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $be_nuolaidos_menuo = str_replace(" €", "", $data['viso_menesis']) + str_replace(" €", "", $data['nuolaida_menesis']);
                $be_nuolaidos_metai = str_replace(" €", "", $data['viso_metai']) + str_replace(" €", "", $data['nuolaida_metai']);
                echo"<tr>
                    <td>Be nuolaidos</td>
                    <td>".$be_nuolaidos_menuo." €</td>
                    <td>".$be_nuolaidos_metai." €</td>
                </tr>";
                if($data['nuolaida'] > 0){
                echo"<tr>
                    <td>Nuolaida ( ".$data['nuolaida']."% ), iš jų:<br>";
                if($data['laiku_atsiskaito'] == "on"){echo"Laiku atsiskaito: ( 2% )<br>";}
                if($data['seimos_nariai'] == "on"){echo"Šeimos nariai veda apskaitą: ( 5% )<br>";}
                    if($data['laiku_dokumentai'] == "on"){echo"Laiku pateikia pirminius dokumentus: ( 10% )";}
                echo"</td>
                    <td>".$data['nuolaida_menesis']."</td>
                    <td>".$data['nuolaida_metai']."</td>
                </tr>";}else{
                    echo"<tr>
                    <td>Nuolaida ( 0% )</td>
                    <td>0 €</td>
                    <td>0 €</td>
                </tr>";
                }
                echo"<tr class='danger'>
                    <td>Viso</td>
                    <td>".$data['viso_menesis']."</td>
                    <td>".$data['viso_metai']."</td>
                </tr>";
                ?>
                </tbody>
            </table>
                    <div id="footer" class="text-danger text-left">
                        Jei Jūs samdytumėte buhalterį, tai jums kainuotų 650 eurų per menesį, 7793 eurai per metus. Mokant tik minimalią algą
                    </div>
                <br>
            </div>
                <div class="break" style="display:none">
                    <div class="text-center">
                        <strong>SUTIKIMAS DĖL DUOMENŲ NAUDOJIMO</strong>
                    </div>
                    <div class="text-center">
                        <?php echo $this->main_model->info['txt']['data']; ?>
                    </div>
                    <div class="text-center">
                        Šiauliai
                    </div>
                    <br>
                    <div class="text-justify first">
                        Aš, ūkininkas (-ė) <b><?php echo $this->main_model->info['ukininkas'][0]['vardas']."
                    ".$this->main_model->info['ukininkas'][0]['pavarde']; ?></b>, asmens kodas <?php if($this->main_model->info['ukininkas'][0]['asmens_kodas']){
                        echo $this->main_model->info['ukininkas'][0]['asmens_kodas']; }else{echo"NERASTA";} ?> sutinku, kad buhalterinės apskaitos tikslais būtų naudojami mano asmeniai duomenys,
                        prisijungimo kodai valstybinių įstaigų internetiniuose puslapiuose, kita mano asmeninė informacija. Informacija turi būti naudojama tik apskaitos tikslais
                        (teikti deklaracijas Valstybinei mokesčių inspekcijai, valstybinio socialinio draudimo fondui, valstybės įmonė Žemės ūkio informacijos ir kaimo verslo centras)
                        Man yra žinoma, kad aš turiu teisę: būti informuotas apie savo asmens duomenų tvarkymą; susipažinti su savo asmens duomenimis ir  kaip jie  yra tvarkomi;
                        reikalauti ištaisyti,  sunaikinti savo asmens duomenis arba sustabdyti, išskyrus saugojimą, savo asmens duomenų tvarkymo veiksmus,
                        kai duomenys tvarkomi nesilaikant LR asmens duomenų teisinės apsaugos ir kitų įstatymų nuostatų; nesutikti, kad būtų tvarkomi mano asmens duomenys.
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="text-center">
                        ........................................................................................................................................
                        <h5><small>(Vardas, pavardė, parašas)</small></h5>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-outline btn-primary" type="button" onclick="printDiv('sutartis')">
                    <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
                </button>
            </div>
        </div>
    </div>
</div>

