<?php
    session_start();
    include("naglowek.php");
    include("baza1.php");

    ?>

<H1> DODANIE MAILA  </H1>
<br>

<a href = "page2.php"> powrot do interfejsu </a>

<?php
    
    $user = $_SESSION["id_lekarz"];
    $sql = sprintf("INSERT INTO `_mail_pacjent` (`id_mail`, `id_lekarz`, `tresc`, `temat`, `data`) VALUES (NULL, %d, '%s', '%s', now())",
         $_POST["id_lekarz"], $_POST["text"], $_POST["topic"], $_POST["data"]);
    echo "<br> $sql <br>";

    

    if($wynik = WykonajZapytanie2($sql))
        echo "<H1> Dodano wynik</H1>";
    else
        echo "<H1> blad dodawania rekordu </H1>";
    

    if(isset($_POST['Wyslij'])){
        $to = $_POST('id_mail');
        $subject = $_POST('topic');
        $message = $_POST('text');
         
        $headers = "From: The Sender Name <natalia4027@gmail.com>\r\n";
        $headers .= "Content type: text/html\r\n";
    
        mail($to, $subject, $message, $headers); 
        echo "mail wyslany";
    }else "nie udalo sie";

     
    ?>

    <pre>
<?php
    include("stopka.php");
    ?>
