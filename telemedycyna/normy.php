
 <?php
    session_start();
    include("naglowek.php");
    include("baza1.php");

    ?>

<H1> NORMY </H1>
<br>

<a href = "page2lekarz.php"> powrot do interfejsu </a>

<?php
    
 $param = $_POST["id_param"];

                 
$sql = sprintf("SELECT p.nazwa, w.wynik, n.norma, pa.nazwisko, n.PORADA FROM _parametry p, _pomiary_serce w, _threshold n, _pacjent pa WHERE pa.id_pacjenta = w.id_pacjenta AND w.wynik < 99 AND p.nazwa = 'poziom cukru' AND p.id_parametry = '$param' AND n.id_threshold = '1' ") ;
$sql2 = sprintf("SELECT p.nazwa, w.wynik, n.ZA_WYSOKI, pa.nazwisko, n.PORADA_ZA_WYSOKI FROM _parametry p, _pomiary_serce w, _threshold n, _pacjent pa WHERE pa.id_pacjenta = w.id_pacjenta AND w.wynik > 100 AND p.nazwa = 'poziom cukru' AND p.id_parametry = '$param' AND n.id_threshold = '1' ") ;


if($wynik = WykonajZapytanie2($sql2))
    wyswietl_NORMY_ZA_WYSOKI($wynik);
else echo "brak wynikow <br>";
if($wynik = WykonajZapytanie2($sql))
    wyswietl_NORMY($wynik);
else echo "brak wynikow <br>";


$sql3 = sprintf("SELECT p.nazwa, w.wynik, n.norma, pa.nazwisko, n.PORADA FROM _parametry p, _pomiary_serce w, _threshold n, _pacjent pa WHERE pa.id_pacjenta = w.id_pacjenta AND w.wynik < 180 AND w.wynik > 90 AND p.nazwa = 'Cisnienie krwi' AND p.id_parametry = '$param' AND n.id_threshold = '2' ") ;
$sql4 = sprintf("SELECT p.nazwa, w.wynik, n.ZA_WYSOKI, pa.nazwisko, n.PORADA_ZA_WYSOKI FROM _parametry p, _pomiary_serce w, _threshold n, _pacjent pa WHERE pa.id_pacjenta = w.id_pacjenta AND w.wynik > 180 AND p.nazwa = 'Cisnienie krwi' AND p.id_parametry = '$param' AND n.id_threshold = '2' ") ;
$sql5 = sprintf("SELECT p.nazwa, w.wynik, n.ZA_NISKI, pa.nazwisko, n.PORADA_ZA_NISKI FROM _parametry p, _pomiary_serce w, _threshold n, _pacjent pa WHERE pa.id_pacjenta = w.id_pacjenta AND w.wynik < 90 AND p.nazwa = 'Cisnienie krwi' AND p.id_parametry = '$param' AND n.id_threshold = '2' ") ;

if($wynik = WykonajZapytanie2($sql4))
    wyswietl_NORMY_CISNIENIE_W($wynik);
else echo "brak wynikow <br>";
if($wynik = WykonajZapytanie2($sql5))
    wyswietl_NORMY_CISNIENIE_N($wynik);
else echo "brak wynikow <br>";
if($wynik = WykonajZapytanie2($sql3))
    wyswietl_NORMY_CISNIENIE($wynik);
else echo "brak wynikow <br>";

?>