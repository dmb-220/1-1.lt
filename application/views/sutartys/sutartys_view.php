<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Sutikimas dėl duomenų naudojimo</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal form-bordered" action="<?= base_url(); ?>sutartys/sutartys" method="POST">
                <?php $dt = $this->session->userdata(); ?>
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ūkininkas</label>
                        <div class="col-md-10">
                            <?php echo form_error('ukininko_vardas'); ?>
                                <select name="ukininko_vardas" class="form-control">
                                    <option value="">Pasirinkite...</option>
                                    <?php
                                    foreach ($this->main_model->info['ukininkai'] as $row) {
                                        echo "<option value='$row[valdos_nr]'>";
                                        echo $row['vardas'];
                                        echo " ";
                                        echo $row['pavarde'];
                                        echo "</option>";
                                    }
                                    ?>
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Sutarties numeris:</label>
                        <div class="col-md-10">
                            <?php echo form_error('numeris'); ?>
                            <input name="numeris" type="text" class="form-control" placeholder="Sutarties numeris" value="2017/" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2"></label>
                        <div class="col-md-10 col-sm-10">
                            <button class="btn btn-block btn-outline btn-primary" type="submit">
                                <i class="fa fa-check-circle-o fa-lg"> SUKURTI</i>
                            </button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
    <?php
    if($this->main_model->info['error']['action'] == 1) {
        ?>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Sutikimas dėl duomenų naudojimo</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
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
                    <b>UAB Alūzo transportas</b>, atstovaujama direktoriaus <b>Andriaus Norkaus</b>, toliau vadinamu Vykdytoju ir <b><?php echo $this->main_model->info['txt']['vardas']."
                    ".$this->main_model->info['txt']['pavarde']; ?></b> toliau vadinamu užsakovu, sudarėme šią sutartį:
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
                    5. Atsiskaitymo tvarka; užsakovas atsiskaito už paslaugas pagal pateiktas sąskaitas-faktūras. Paslaugos įkainis nustatomas <b><?php echo $this->main_model->info['txt']['suma']['uz_menesi'] ?></b> eurų per mėnesį.
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
                    Aš, ūkininkas (-ė) <b><?php echo $this->main_model->info['txt']['vardas']."
                    ".$this->main_model->info['txt']['pavarde']; ?></b>, asmens kodas <?php if($this->main_model->info['txt']['asmens_kodas']){
                        echo $this->main_model->info['txt']['asmens_kodas']; }else{echo"NERASTA";} ?> sutinku, kad buhalterinės apskaitos tikslais būtų naudojami mano asmeniai duomenys,
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
                <div class="form-group">
                    <button class="btn btn-block btn-outline btn-primary" type="button" onclick="printDiv('sutartis')">
                        <i class="fa fa-check-circle-o fa-lg"> SPAUSDINTI</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>
