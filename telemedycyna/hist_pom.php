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
        $sql = "SELECT p.nazwa, ps.wynik, ps.data_pomiaru FROM _pomiary_serce ps, _parametry p WHERE ps.id_pacjenta = '$user' AND ps.id_parametry = p.id_parametry" ;
        echo "<br> $sql <br>"; //dla wszystkich pomiarow

    }else{

        $sql = "SELECT ps.wynik, ps.data_pomiaru FROM _pomiary_serce ps, _parametry p WHERE ps.id_pacjenta = '$user' AND ps.id_parametry = p.id_parametry AND p.id_parametry = '$id_badania'" ;
        echo "<br> $sql <br>"; //dla wybranego pomiaru     
    }

    if($wynik = WykonajZapytanie2($sql))
            echo '<table class="table table-sm table-primary"><tr><th>Data</th><th>Wynik</th></tr>';
                while($wiersz = $wynik -> fetch_array(MYSQLI_ASSOC))
                    {
                        echo "<tr><td>{$wiersz['data_pomiaru']}</td><td>{$wiersz['wynik']}</td></tr>";
                }
            echo '</table>';

            echo "<H1>Wyświetlono historię pomiarów</H1>";
        else
            echo "<H1>Błąd wyświetlania historii</H1>";
?>
//tu wykres 
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Wartość pomiaru'],
          <?php
          if(mysqli_num_rows($wynik) > 0) {
              while($wiersz = mysqli_fetch_array($wynik)){
                  echo "['".$wiersz['wynik']."', '".$wiersz['data_pomiaru']."']";
              }
          }
          ?>
        ]);

        var options = {
          title: 'Wyniki pomiarów',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>


<?php
}
else
    echo "Dostęp zabroniony";
?>

    <pre>
<?php
    include("stopka.php");
    ?>
