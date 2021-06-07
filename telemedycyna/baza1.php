<?php

function polaczZbaza()

{
   include('zmiennedb.php');
   $dbServer = "mysql.agh.edu.pl";
   $dbLogin = "nwasik";
   $dbBaza = "nwasik";
   $dbHaslo = $dbHaslo_NW;
   return @new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);

}

function WykonajZapytanie($polaczenie, $_MySQL)
{
    mysqli_set_charset($polaczenie, 'utf8');
    
    $wynik = @$polaczenie->query($_MySQL);
    return $wynik;
}

function wyswietl_03($wynik){
 
    echo '<table class="table table-sm table-primary"><tr><th>imie</th><th>nazwisko</th><th>specjalizacja</th><th>nazwa</th><th>jednostka</th></tr>';
    while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC)){
            echo "<tr><td>{$wiersz['imie']}</td><td>{$wiersz['nazwisko']}</td><td>{$wiersz['specjalizacja']}</td><td>{$wiersz['nazwa']}</td><td>{$wiersz['jednostka']}</td></tr>";
             
        
    }
    echo '</table>';
}
function wyswietl_04_lekarz($wynik){
 
    echo '<table class="table table-sm table-primary"><tr><th>Imie</th><th>Nazwisko</th><th>Wynik</th><th>Parametr</th></tr>';
    while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC)){
            echo "<tr><td>{$wiersz['imie']}</td><td>{$wiersz['nazwisko']}</td><td>{$wiersz['wynik']}</td><td>{$wiersz['nazwa']}</td></tr>";
             
        
    }
    echo '</table>';
}
function wyswietl_NORMY($wynik){
 
    echo '<table class="table table-sm table-primary"><tr><th>Nazwa</th><th>Wynik</th><th>Norma</th><th>Nazwisko</th><th>Porada</th></tr>';
    while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC)){
            echo "<tr><td>{$wiersz['nazwa']}</td><td>{$wiersz['wynik']}</td><td>{$wiersz['norma']}</td><td>{$wiersz['nazwisko']}</td><td>{$wiersz['PORADA']}</td></tr>";
             
        
    }
    echo '</table>';
}
function wyswietl_NORMY_ZA_WYSOKI($wynik){
    
    echo '<table class="table table-sm table-danger"><tr><th>Nazwa</th><th>Wynik</th><th>ZA WYSOKI</th><th>Nazwisko</th><th>Porada</th></tr>';
    while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC)){
            echo "<tr><td>{$wiersz['nazwa']}</td><td>{$wiersz['wynik']}</td><td>{$wiersz['ZA_WYSOKI']}</td><td>{$wiersz['nazwisko']}</td><td>{$wiersz['PORADA_ZA_WYSOKI']}</td></tr>";
             
        
    }
    echo '</table>';
}
function wyswietl_NORMY_CISNIENIE_N($wynik){
    
    echo '<table class="table table-sm table-danger"><tr><th>Nazwa</th><th>Wynik</th><th>ZA NISKI</th><th>Nazwisko</th><th>Porada</th></tr>';
    while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC)){
            echo "<tr><td>{$wiersz['nazwa']}</td><td>{$wiersz['wynik']}</td><td>{$wiersz['ZA_NISKI']}</td><td>{$wiersz['nazwisko']}</td><td>{$wiersz['PORADA_ZA_NISKI']}</td></tr>";
             
        
    }
    echo '</table>';
}
function wyswietl_NORMY_CISNIENIE_W($wynik){
    
    echo '<table class="table table-sm table-danger"><tr><th>Nazwa</th><th>Wynik</th><th>ZA WYSOKI</th><th>Nazwisko</th><th>Porada</th></tr>';
    while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC)){
            echo "<tr><td>{$wiersz['nazwa']}</td><td>{$wiersz['wynik']}</td><td>{$wiersz['ZA_WYSOKI']}</td><td>{$wiersz['nazwisko']}</td><td>{$wiersz['PORADA_ZA_WYSOKI']}</td></tr>";
             
        
    }
    echo '</table>';
}
function wyswietl_NORMY_CISNIENIE($wynik){
    
    echo '<table class="table table-sm table-primary"><tr><th>Nazwa</th><th>Wynik</th><th>NORMA</th><th>Nazwisko</th><th>Porada</th></tr>';
    while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC)){
            echo "<tr><td>{$wiersz['nazwa']}</td><td>{$wiersz['wynik']}</td><td>{$wiersz['norma']}</td><td>{$wiersz['nazwisko']}</td><td>{$wiersz['PORADA']}</td></tr>";
             
        
    }
    echo '</table>';
}


function wyswietl_05_lekarz($wynik){
 
    echo '<table class="table table-sm table-primary"><tr><th>Email pacjenta</th><th>Temat</th><th>Tresc</th><th>Data</th></tr>';
    while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC)){
            echo "<tr><td>{$wiersz['Email pacjenta']}</td><td>{$wiersz['temat']}</td><td>{$wiersz['tresc']}</td><td>{$wiersz['data']}</td></tr>";
             
        
    }
    echo '</table>';
}



function zwrocSkalar($_MySQL)
{
    if($polaczenieNW = polaczZbaza()){
        mysqli_set_charset($polaczenieNW, 'utf_8');
        if($dataSet = WykonajZapytanie($polaczenieNW, $_MySQL)){
            $wiersz = $dataSet -> fetch_array(MYSQLI_NUM);
            if($wiersz)
                return $wiersz[0];
            else return NULL;
        } else return NULL;

        }else return NULL;

    }
    
    function WykonajZapytanie2($_MySQL)
    {
        
        if($polaczenie = polaczZbaza()){
          
            mysqli_set_charset($polaczenie, 'utf_8');
      
            $wynik = @$polaczenie -> query($_MySQL);
          
            return $wynik;
          


        }else return NULL;
    }
function opcjeBadania(){
    $retVal = "";
    $sql = "SELECT `id_pacjenta`, `email` FROM `_pacjent`";
    $wynik = WykonajZapytanie2($sql);
    if($wynik){
        while($wiersz = $wynik -> fetch_assoc())
            $retVal .= '<option value = "' . $wiersz["id_pacjenta"] . '" >' . $wiersz["email"] . '</option>';
            return $retVal;

    }
    else $retVal;
}
function opcjeBadania_wyniki(){
    $retVal = "";
    $sql = "SELECT `id_pacjenta`, `nazwisko` FROM `_pacjent`";
    $wynik = WykonajZapytanie2($sql);
    if($wynik){
        while($wiersz = $wynik -> fetch_assoc())
            $retVal .= '<option value = "' . $wiersz["id_pacjenta"] . '" >' . $wiersz["nazwisko"] . '</option>';
            return $retVal;

    }
    else $retVal;
}

function opcjeBadania_param(){
    $retVal = "";
    $sql = "SELECT `id_parametry`, `nazwa` FROM `_parametry`";
    $wynik = WykonajZapytanie2($sql);
    if($wynik){
        while($wiersz = $wynik -> fetch_assoc())
            $retVal .= '<option value = "' . $wiersz["id_parametry"] . '" >' . $wiersz["nazwa"] . '</option>';
            return $retVal;

    }
    else $retVal;
}

function opcjeBadania_pacjent(){
    $retVal = "";
    $sql = "SELECT `id_pacjenta`, `email` FROM `_pacjent`";
    $wynik = WykonajZapytanie2($sql);
    if($wynik){
        while($wiersz = $wynik -> fetch_assoc())
            $retVal .= '<option value = "' . $wiersz["id_pacjenta"] . '" >' . $wiersz["email"] . '</option>';
            return $retVal;

    }
    else $retVal;
}

function opcjeBadania_lekarz(){
    $retVal = "";
    $sql = "SELECT `id_lekarz`, `email_lekarz` FROM `_lekarz`";
    $wynik = WykonajZapytanie2($sql);
    if($wynik){
        while($wiersz = $wynik -> fetch_assoc())
            $retVal .= '<option value = "' . $wiersz["id_lekarz"] . '" >' . $wiersz["email_lekarz"] . '</option>';
            return $retVal;

    }
    else $retVal;
}


function wyswietl_02($wynik){
    echo "wyswietl_02 <br><br>";
    while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC)){
        foreach($wiersz as $pole)
            echo $pole . " ; ";
        echo "<br>";
    }
}

?>
