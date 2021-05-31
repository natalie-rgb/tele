<?php
   
   
    session_start();
    include("naglowek.php");
    include("baza1.php");
    
?>
    
    <H3> <div class="p-3 mb-2 bg-success text-white">Witaj</div> </H3>
    <?php
    echo "<h1>Jestes zalogowany jako lekarz</h1>";
    if($_SESSION['startLogin'] != 1)
        echo "Dostep zabroniony";  
    else{
        $_SESSION['startLogin'] != -1;
        $email = $_POST['email_lekarz'];
        $haslo = md5($_POST['haslo_lekarz']);

        $sql = "SELECT COUNT(*) AS ileRazy FROM `_lekarz` WHERE `email_lekarz` = '$email'";
        $ileLoginow = zwrocSkalar($sql);
    
        if($ileLoginow == 1){
            

            $sql = sprintf("SELECT id_lekarz FROM `_lekarz` WHERE `email_lekarz` = '$email' AND haslo_lekarz = '%s' ",
            $_POST['haslo_lekarz']);
            
            $czyJestPoprawnaPara = zwrocSkalar($sql);
            if($czyJestPoprawnaPara){
                $_SESSION['zalogowany'] = 1;
                $_SESSION['id_pacjenta'] = $czyJestPoprawnaPara;
                echo " Jestes zalogowany jako id: $czyJestPoprawnaPara <br><br>";
                echo '<a href = page2lekarz.php> Idz do interfejsu lekarza</a>';
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