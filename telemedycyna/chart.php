<!DOCTYPE html>
<html>
<?php
    session_start();
    include("naglowek.php");
    include("baza1.php");

?>

<H1> Historia pomiarów <?php echo $nazwa_badania; ?><br></H1>
<br>

<a href = "page2.php"> powrót do interfejsu </a>

<?php
if ($_SESSION['zalogowany'] = 1 && isset($_POST['submit_H']))
{
        $user = $_SESSION["id_pacjenta"];
        $id_badania = $_POST["id_badania"];

        $sql_nazwa_badania = "SELECT p.nazwa FROM _pomiary_serce ps, _parametry p WHERE ps.id_parametry = '$id_badania' "; 
        $nazwa_badania = WykonajZapytanie2($sql_nazwa_badania);
        
        $sql = "SELECT ps.id_pomiary, p.nazwa, ps.wynik, ps.data_pomiaru FROM _pomiary_serce ps, _parametry p WHERE ps.id_pacjenta = '$user' AND ps.id_parametry = p.id_parametry AND p.id_parametry = '$id_badania' ORDER BY ps.data_pomiaru ASC" ;   
        $sql_g = "SELECT ps.id_pomiary, p.nazwa, ps.wynik, ps.data_pomiaru FROM _pomiary_serce ps, _parametry p WHERE ps.id_pacjenta = '$user' AND ps.id_parametry = p.id_parametry AND p.id_parametry = '$id_badania' AND ps.wynik < p.upper_th AND ps.wynik > p.lower_th ORDER BY ps.data_pomiaru ASC" ;   
        $sql_h = "SELECT ps.id_pomiary, p.nazwa, ps.wynik, ps.data_pomiaru FROM _pomiary_serce ps, _parametry p WHERE ps.id_pacjenta = '$user' AND ps.id_parametry = p.id_parametry AND p.id_parametry = '$id_badania' AND ps.wynik > p.upper_th ORDER BY ps.data_pomiaru ASC" ;   
        $sql_l = "SELECT ps.id_pomiary, p.nazwa, ps.wynik, ps.data_pomiaru FROM _pomiary_serce ps, _parametry p WHERE ps.id_pacjenta = '$user' AND ps.id_parametry = p.id_parametry AND p.id_parametry = '$id_badania' AND ps.wynik < p.lower_th ORDER BY ps.data_pomiaru ASC" ;   


    //poprawne
        if($wynik_g = WykonajZapytanie2($sql))
                { 

                $rows = array();
                $table = array();
 
                $table['cols'] = array(
                array(
                'label' => 'Data', 
                'type' => 'string'
                ),
                array(
                'label' => 'Wynik pomiaru', 
                'type' => 'number'
                )
                );

                while($row = mysqli_fetch_array($wynik_g))
                {
                $sub_array = array();
                $sub_array[] =  array(
                    "v" => $row["data_pomiaru"]
                    );
                $sub_array[] =  array(
                    "v" => $row["wynik"]
                    );
                $rows[] =  array(
                    "c" => $sub_array
                    );
                }
                $table['rows'] = $rows;
                $jsonTable_g = json_encode($table);}

//Wysoki
if($wynik_h = WykonajZapytanie2($sql_h))
                { 

                $rows_h = array();
                $table_h = array();

                $table_h['cols_h'] = array(
                array(
                'label' => 'Data', 
                'type' => 'string'
                ),
                array(
                'label' => 'Za wysoki', 
                'type' => 'number'
                )
                );

                while($row_h = mysqli_fetch_array($wynik_h))
                {
                $sub_array_h = array();
                $sub_array_h[] =  array(
                    "v" => $row_h["data_pomiaru"]
                    );
                $sub_array_h[] =  array(
                    "v" => $row_h["wynik"]
                    );
                $rows_h[] =  array(
                    "c" => $sub_array_h
                    );
                }
                $table_h['rows_h'] = $rows_h;
                $jsonTable_h = json_encode($table_h);}

//Niski
if($wynik_l = WykonajZapytanie2($sql_l))
                {  

                $rows_l = array();
                $table_l = array();

                $table_l['cols_l'] = array(
                array(
                'label' => 'Data', 
                'type' => 'string'
                ),
                array(
                'label' => 'Za niski', 
                'type' => 'number'
                )
                );

                while($row_l = mysqli_fetch_array($wynik_l))
                {
                $sub_array_l = array();
                $sub_array_l[] =  array(
                    "v" => $row_l["data_pomiaru"]
                    );
                $sub_array_l[] =  array(
                    "v" => $row_l["wynik"]
                    );
                $rows_l[] =  array(
                    "c" => $sub_array_l
                    );
                }
                $table_l['rows_l'] = $rows_l;
                $jsonTable_l = json_encode($table_l, JSON_NUMERIC_CHECK);}


                $merged = json_encode(array_merge(json_decode($jsonTable_g, true),json_decode($jsonTable_h, true), json_decode($jsonTable_l, true)))
                    ?>


           
                <title>Historia pomiarów </title>
                    <meta charset = "UTF-8">
                    <link rel = "stylesheet" href = "./style.css" type = "text/css">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                    <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart()
            {
                var data = new google.visualization.DataTable(<?php echo $jsonTable_g; ?>);

                var options = {
                chartArea:{width:'95%', height:'65%'},
                colors: ['#961f1f'],
                title: "Wyniki pomiarów",
                titlePosition: "center",
                titleFontSize:30,
                backgroundColor: 'none',
                hAxis: {title: 'Data pomiaru',
                textStyle:{color: '#000'},
                baselineColor: '#000000'},
                vAxis: {title: 'Wartość',
                textStyle:{color: '#000'},
                baselineColor: '#000000'}
                };

                var chart = new google.visualization.ScatterChart(document.getElementById('scatter_chart'));

                chart.draw(data, options);
            }
            </script>
            <style>
            .page-wrapper
            {
            width:1000px;
            margin:0 auto;
            }
            </style>
            <div class="page-wrapper">
            <br />
            <div id="scatter_chart" style="width: 100%; height: 500px"></div>
            </div>
            
<?php
}
else
    echo "Dostęp zabroniony";
?>

</html>
