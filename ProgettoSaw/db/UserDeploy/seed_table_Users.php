
<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "INSERT INTO `Users` (`Username`, `Name`, `Surname`, `Password`) VALUES
    ('zio', 'Carlini', 'rossi', 'a810368ec47867e1c68e2d02a9293a2c04cd314c'),
    ('pio', 'aldo', 'papu', 'a810368ec47867e1c68e2d02a9293a2c04cd314c'),
    ('kaio', 'Riccardo', 'Mirabelli', 'a810368ec47867e1c68e2d02a9293a2c04cd314c');";

    if(!$con->query($query))
        echo("Errore inserimento dati nel database</br>");
    else
        echo("Dati inseriti con successo</br>");

    mysqli_close($con);

?>