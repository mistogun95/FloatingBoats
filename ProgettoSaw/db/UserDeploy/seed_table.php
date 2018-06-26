
<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "INSERT INTO `Users` (`Username`, `Name`, `Surname`, `Password`) VALUES
    ('carolad99', 'Carola', 'Ghiradi', 'f64f1ebf0a9ded23ccca46bc81a062f1095b56af'),
    ('riccardo75', 'Riccardo', 'Mirabelli', 'bdf8ea2891a2db943c0fbc1e70c5807ba17fe945');";

    if(!$con->query($query))
        echo("Errore inserimento dati nel database</br>");
    else
        echo("Dati inseriti con successo</br>");

    mysqli_close($con);

?>