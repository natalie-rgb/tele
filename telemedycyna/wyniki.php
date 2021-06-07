<?php
    session_start();
    include("naglowek.php");
    include("baza1.php");

    ?>

<H1> DODANIE MAILA  </H1>
<br>

<a href = "page2lekarz.php"> powrot do interfejsu </a>

<?php
    
    $user = $_SESSION["id_wyniki"];
    $wynik = $_POST["id_wyniki"];

    $sql = sprintf("SELECT pac.imie, pac.nazwisko, p.wynik, par.nazwa FROM _pacjent pac, _pomiary_serce p, _parametry par WHERE p.id_parametry = par.id_parametry AND pac.id_pacjenta = p.id_pacjenta AND pac.id_pacjenta = '$wynik' ") ;
    
  
    if($wynik = WykonajZapytanie2($sql))
        wyswietl_04_lekarz($wynik);
    else echo "brak wynikow <br>";
        ?>

 
    