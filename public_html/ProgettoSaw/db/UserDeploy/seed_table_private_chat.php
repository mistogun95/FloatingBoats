
<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "INSERT INTO `private_chat` (`Utente1`, `Utente2`) VALUES
    ('zio', 'kaio'),
    ('clin', 'xavier'),
    ('pio', 'papu'),
    ('cyborg', 'kaput');";

    if(!$con->query($query))
        echo("Errore inserimento dati nel database private_chat</br>");
    else
        echo("Dati inseriti con successo nella tabella private_chat</br>");

    mysqli_close($con);
?>