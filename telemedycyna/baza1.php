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
        echo "2. $_MySQL <br>";
        if($polaczenie = polaczZbaza()){
          
            mysqli_set_charset($polaczenie, 'utf_8');
      
            $wynik = @$polaczenie -> query($_MySQL);
          
            return $wynik;
          


        }else return NULL;
    }

function opcjeBadania(){
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


function wyswietl_02($wynik){
    echo "wyswietl_02 <br><br>";
    while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC)){
        foreach($wiersz as $pole)
            echo $pole . " ; ";
        echo "<br>";
    }
}

?>
