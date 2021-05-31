<?php
    session_start();
    include("naglowek.php");
    include("baza1.php");

    ?>

<H1> Zapis nowego pomiaru </H1>
<br>

<a href = "page2.php"> powrot do interfejsu </a>

<?php

    
    $user = $_SESSION["id_pacjenta"];
    $sql = sprintf("INSERT INTO `_pomiary_serce` (`id_pomiary`, `id_pacjenta`, `id_parametry`, `wynik`, `data_pomiaru`) VALUES (NULL, %d, %d, %f, now())",
        $_SESSION["id_pacjenta"], $_POST["id_badanie"], $_POST["wartPom"]);
    echo "<br> $sql <br>";

    if($wynik = WykonajZapytanie2($sql))
        echo "<H1> Dodano wynik</H1>";
    else
        echo "<H1> blad dodawania rekordu </H1>";
    ?>

    <pre>
<?php
    include("stopka.php");
    ?>
