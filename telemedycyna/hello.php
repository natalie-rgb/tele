<?php
include("nagl.php");
session_start();

if(!isset($_SESSION['startLogin']) || $_SESSION['startLogin'] = 1){
    session_regenerate_id(); //odnowienie sesji
    $_SESSION = array(); //usuniecie zmiennych
    $_SESSION['startLogin'] = 1; // start logowania znacznik!
    $_SESSION['komunikat'] = "A jednak"; // check czy fragment sie wykonal
//p1 inicjuje sesje i przesyla POST tajne haslo dp p2
}


?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title>Strona logowania</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        
<H3> <div class="p-3 mb-2 bg-success text-white">ZALOGUJ SIE</div><br> </H3>
<p class="text-success border border-success">Jako pacjent</p>
<form action="./page1.php" method="POST">
  Email: <input type="email" name="email" placeholder = "podaj email" required><br>
  Hasło: <input type="password" name="haslo" placeholder = "podaj haslo" required><br>
  <input type="submit" value="Zaloguj"><br><br>
 
</form>

<p class="text-success border border-success">Jako lekarz</p>
<form action="./page1lekarz.php" method="POST">
  Email: <input type="email" name="email_lekarz" placeholder = "podaj email" required><br>
  Hasło: <input type="password" name="haslo_lekarz" placeholder = "podaj haslo" required><br>
  <input type="submit" value="Zaloguj"><br>
  
</body>
</html>
