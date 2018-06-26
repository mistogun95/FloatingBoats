
<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "INSERT INTO `Tags` (`Name`) VALUES
    ('vela'),
    ('barca solo a motore'),
    ('pesca'),
    ('balneazione'),
    ('paesaggio'),
    ('immersione');";

    if(!$con->query($query))
        echo("Errore inserimento dati nel database</br>");
    else
        echo("Dati inseriti con successo</br>");

    mysqli_close($con);

?>