<?php
    session_start();
    include("naglowek.php");
    include("baza1.php");

    ?>

<H1> Historia pomiarów </H1>
<br>

<a href = "page2.php"> powrót do interfejsu </a>

<?php
if ($_SESSION['zalogowany'] = 1 && isset($_POST['submit_H']))
{
    $user = $_SESSION["id_pacjenta"];
    $id_badania = $_POST["id_badania"];

    if($id_badania == -1)
    {
        $sql = "SELECT ps.id_pomiary, p.nazwa, ps.wynik FROM _pomiary_serce ps, _parametry p WHERE ps.id_pacjenta = '$user' AND ps.id_parametry = p.id_parametry" ;
        echo "<br> $sql <br>"; //dla wszystkich pomiarow

    }else{

        $sql = "SELECT ps.id_pomiary, ps.wynik FROM _pomiary_serce ps, _parametry p WHERE ps.id_pacjenta = '$user' AND ps.id_parametry = p.id_parametry AND p.id_parametry = '$id_badania'" ;
        echo "<br> $sql <br>"; //dla wybranego pomiaru     
    }

    if($wynik = WykonajZapytanie2($sql))
            echo "<H1>Wyświetlono historię pomiarów</H1>";
        else
            echo "<H1>Błąd wyświetlania historii</H1>";

}
else
    echo "Dostęp zabroniony";
?>

    <pre>
<?php
    include("stopka.php");
    ?>
