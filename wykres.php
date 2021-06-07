<!DOCTYPE html>

<?php
    session_start();
    include("naglowek.php");
    include("baza1.php");

//index.php
$user = 1;
$id_badania = 1;
$sql = "SELECT ps.id_pomiary, p.nazwa, ps.wynik, ps.data_pomiaru FROM _pomiary_serce ps, _parametry p WHERE ps.id_pacjenta = '$user' AND ps.id_parametry = p.id_parametry AND p.id_parametry = '$id_badania' ORDER BY ps.data_pomiaru ASC" ;
        echo "<br> $sql <br>"; //dla wybranego pomiaru     
$wynik = WykonajZapytanie2($sql);
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

while($row = mysqli_fetch_array($wynik))
{
 $sub_array = array();
 $datetime = explode(".", $row["data_pomiaru"]);
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
$jsonTable = json_encode($table);

?>


<html>
 <head>
     <title>Historia pomiarów - wykres</title>
        <meta charset = "UTF-8">
        <link rel = "stylesheet" href = "./style.css" type = "text/css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart()
   {
    var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

    var options = {
     chartArea:{width:'95%', height:'65%'},
     colors: ['#d36c6c']
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
 </head>  
 <body>
  <div class="page-wrapper">
   <br />
   <h2 align="center">Wyniki pomiarów</h2>
   <div id="scatter_chart" style="width: 100%; height: 500px"></div>
  </div>
 </body>
</html>
