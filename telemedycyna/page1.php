<?php
   
   
    session_start();
    include("naglowek.php");
    include("baza1.php");
    
?>
    
    <H3> <div class="p-3 mb-2 bg-success text-white">Witaj</div> </H3>
    <?php
    echo "<h1>Jestes zalogowany</h1>";
    if($_SESSION['startLogin'] != 1)
        echo "Dostep zabroniony";  
    else{
        $_SESSION['startLogin'] != -1;
        $email = $_POST['email'];
        $haslo = md5($_POST['haslo']);

        $sql = "SELECT COUNT(*) AS ileRazy FROM `_pacjent` WHERE `email` = '$email'";
        $ileLoginow = zwrocSkalar($sql);
    
        if($ileLoginow == 1){
            

            $sql = sprintf("SELECT id_pacjenta FROM `_pacjent` WHERE `email` = '$email' AND haslo = '%s' ",
            $_POST['haslo']);
            
            $czyJestPoprawnaPara = zwrocSkalar($sql);
            if($czyJestPoprawnaPara){
                $_SESSION['zalogowany'] = 1;
                $_SESSION['id_pacjenta'] = $czyJestPoprawnaPara;
                echo " Jestes zalogowany jako id: $czyJestPoprawnaPara <br><br>";
                echo '<a href = page2.php> Idz do interfejsu pacjenta</a>';
            }else{
                $_SESSION['zalogowany'] = -1;
                $_SESSION['id_pacjenta'] = -1;
                echo "Podales zle dane<br><br>";
                echo '<a href = "hello.php"> Sprobuj ponownie</a>';
                
            }
            } elseif ($ileLoginow == 0)
                echo "!Podales bledne dane<br>";
            else 
                echo "Masz niespojna baze!";


            }

    
 
    
?>
