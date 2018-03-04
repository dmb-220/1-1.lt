<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Skaitčiuoklės kainos</h5>
            <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="ibox-content">
            <?php
            $pavadinimas = array(
                "dokumentai" => "BAZINĖ KAINA",
                "darbuotojai" => "DARBO UZMOKESCIO APSKAITOS KAINA",
                "ukis" => "ŪKIO APSKAITOS KAINA",
                "deklaracija" => "DEKLARACIJŲ TEIKIMO KAINA",
                "kita" => "KITŲ PASLAUGŲ KAINA",
                "nuolaida" => "NUOLAIDOS"
            );
            $raktas = array(
                //BAZINE
                "pirminiai" => "Priminiai dokumentai",
                "inventorizacija" => "Metinė inventorizacija",
                "bankas" => "Banko sąskaita",
                "kreditas" => "Kreditas",
                "saskaita_kaina" => "Sąskaitų planas",
                //DARBUOTOJAI
                "vykdomi_rastai" => "Darbuotojas *",
                "be_vykdomu_rastu" => "Darbuotojas",
                "FR572_kaina" => "GPM313 forma",
                "FR573_kaina" => "GPM312 forma",
                "SAM_kaina" => "SAM pranešimaas",
                "SD_kaina" => "SD pranešimaas",
                //UKIS
                "melziamos" => "Melžiamos karvės",
                "ne_melziamos" => "Mėsinės karvės",
                "galvijai" => "Deklaracija ( gyvulininkystė )",
                "augalai" => "Deklaracija ( augalininkystė )",
                "technika_kaina" => "Technika",
                "galviju_judejimas" => "Galvijų judėjimas",
                //DEKLARACIJOS
                "pvm_12_kaina" => "PVM x12",
                "pvm_2_kaina" => "PVM x2",
                "FR457_kaina" => "FR457",
                "GPM308_kaina" => "GPM308",
                "SAV1_kaina" => "SAV1",
                "ivaz_kaina" => "IVAZ",
                "isaf_2_kaina" => "ISAF x2",
                "isaf_12_kaina" => "ISAF x12",
                //KITI
                "kuras_kaina" => "Kuro apskaita",
                "gamtos_apsauga" => "Aplinkos taršos mokestis",
                "zemes_mokestis" => "Žemės mokestis",
                "europa_kaina" => "Europos parama",
                //NUOLAIDOS
                "laiku_atsiskaito" => "Laiku atsiskaito",
                "seimos_nariai" => "Šeimos nariai veda apskaita",
                "laiku_dokumentai" => "Laiku pateikia pirminius dokumentus",

             );
            //var_dump($data);
            echo"<div class='row'>";
            foreach ($data as $key => $row){
                echo'<div class="alert alert-info text-center">'.$pavadinimas[$key].'</div>';
                foreach ($row as $kei => $col){
                    //echo"<div class='col-md-4'>";
                    echo'<div class="alert alert-warning text-left">'.$raktas[$kei].' [-] Kaina: '.$col.'</div>';
                    //echo'</div>';
                }
            }
            echo'</div>';
            ?>
        </div>
    </div>
</div>
