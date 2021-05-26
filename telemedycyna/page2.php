<?php
session_start();
include("naglowek.php");
include("baza1.php");

if($_SESSION['zalogowany'] != 1)
    echo "Dostep zabroniony";
else {
?>
<H3> <div class="p-3 mb-2 bg-success text-white">Interfejs pacjenta</div> </H3>

    

<form action = "page2.php" method = "post">
    <button name = "opcja" value = "1" class="btn btn-outline-success">Jaki lekarz odpowiada za dany parametr? </button>
    <button name = "opcja" value = "2" class="btn btn-outline-success"> Dodaj swoje wyniki </button>
    <button name = "opcja" value = "3" class="btn btn-outline-success"> Historia pomiarów</button>
</form>



<?php 
if(isset($_POST['opcja']))
    switch($_POST['opcja']){
        case '1':
            
            echo "Jaki lekarz odpowiada za dany parametr?<br>";
            $sql = "SELECT l.imie, l.nazwisko, l.specjalizacja, p.nazwa, j.jednostka ";
            $sql .= "FROM _lekarz l, _parametry p, _jednostki j ";
            $sql .= "WHERE p.id_jednostka = j.id_jednostka AND l.id_lekarz = p.id_lekarz" ;
            if($wynik = WykonajZapytanie2($sql))
                wyswietl_03($wynik);
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

        case "3";
        echo "<br> Historia pomiarów <br> ";
        ?>
                    <br> Ktory parametr:
                    <form action = "hist_pom.php" method = "post">
                        <select name = "id_badania">
                    <?php
                        echo opcjeBadania();
                    ?>
                        <option value = "-1" name = "all"> wszystkie pomiary </option>
                        </select><br>
                        <input type = "submit" value = "Zapisz" name = "submit_H"> <br>
        
                <?php
                    break;
        }}
?>

