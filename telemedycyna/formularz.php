<html>
<body> 
<H3> Formularz 1 </H3>
<form action = "../baza1.php" method = "POST">
    <select name = "zapytaj">
    <p>Choice:</p>

    <option value = "SELECT * FROM `_stud_ib`" >Wszystko</option>
    <option value = "INSERT INTO `_stud_ib` (`id`, `imie`, `email`,`nr_albumu`, `tajne`) VALUES (81,djdk, sksk@op.pl,1092,dkfm)'" >hm</option>
    <option value = "SELECT * FROM `_stud_ib` WHERE imie ='Aleksandra'" >Ola</option>
   
</select>
    <input type = "submit" value = "Submit">
    <input type = "reset" value = "Reset"> <br>
</form>



</body>
</html>
