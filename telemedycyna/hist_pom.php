<!DOCTYPE html>
<html>
    <head> 
        <title>Historia pomiarów</title>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" href = "./style.css" type = "text/css">
    </head>
<?php
    session_start();
    include("naglowek.php");
    include("baza1.php");

    ?>

<H1> Historia pomiarów </H1>
<br>


<?php
if ($_SESSION['zalogowany'] = 1 && isset($_POST['submit_H']))
{
    $user = $_SESSION["id_pacjenta"];
    $id_badania = $_POST["id_badania"];

    if($id_badania == -1)
    {
        $sql = "SELECT ps.id_pomiary, p.nazwa, ps.wynik, ps.data_pomiaru FROM _pomiary_serce ps, _parametry p WHERE ps.id_pacjenta = '$user' AND ps.id_parametry = p.id_parametry" ;
        // echo "<br> $sql <br>"; //dla wszystkich pomiarow

    }else{

        $sql = "SELECT ps.id_pomiary, p.nazwa, ps.wynik, ps.data_pomiaru FROM _pomiary_serce ps, _parametry p WHERE ps.id_pacjenta = '$user' AND ps.id_parametry = p.id_parametry AND p.id_parametry = '$id_badania'" ;
        // echo "<br> $sql <br>"; //dla wybranego pomiaru     
    }

    if($wynik = WykonajZapytanie2($sql))
            { 
?>
                <table class="table table-sm">
                    <thead><tr>
                        <th>Rodzaj pomiaru</th>
                        <th>Data pomiaru</th>
                        <th>Wynik</th>													
                    </tr></thead>
                <tbody>
                    <?php while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC)) { ?>
                    <tr id="<?php echo $wiersz['id_pomiary']; ?>">
                    <td><?php echo $wiersz['nazwa']; ?></td>
                    <td><?php echo $wiersz['data_pomiaru']; ?></td>
                    <td><?php echo $wiersz['wynik']; ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
<?php
            }
        else
            echo "<H3>Błąd wyświetlania historii</H3>";
            //jeszcze wykres
}
else
    echo "Dostęp zabroniony";
?>

    <pre>

<a href = "page2.php"> powrót do interfejsu </a>




 </body>
</html>
