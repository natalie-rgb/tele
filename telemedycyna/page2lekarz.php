<?php
session_start();
include("naglowek.php");
include("baza1.php");
include("stopka.php");


if($_SESSION['zalogowany'] != 1)
    echo "Dostep zabroniony";
else {
?>
<H3> <div class="p-3 mb-2 bg-success text-white">Interfejs lekarza</div> </H3>

    

<form action = "page2lekarz.php" method = "post">
    <button name = "opcja" value = "1" class="btn btn-outline-success">Pokaz wyniki pacjentow </button>
    <button name = "opcja" value = "2" class="btn btn-outline-success"> x </button>
</form>



<?php 
if(isset($_POST['opcja']))
    switch($_POST['opcja']){
        case '1':
            
            echo "Wyniki pacjentów <br>";
            $sql = "SELECT pac.imie, pac.nazwisko, p.wynik, par.nazwa ";
            $sql .= "FROM _pacjent pac, _pomiary_serce p, _parametry par ";
            $sql .= "WHERE p.id_parametry = par.id_parametry AND pac.id_pacjenta = p.id_pacjenta" ;


          
            if($wynik = WykonajZapytanie2($sql))
                wyswietl_04_lekarz($wynik);
            else echo "brak wynikow <br>";
            break;

        case "2";
            echo "<br> Dodaj wyniki <br> ";
?>
            <br> Ktory parametr:
            <form action = "page3.php" method = "post">
                <select name = "id_badanie">
            <?php
                echo opcjeBadania();

            ?>
                </select><br>
                Podaj wartosc pomiaru: <input type = "text" name = "wartPom" required> <br>
                <input type = "submit" value = "Zapisz"> <br>

        <?php
            break;
        }}
?>

