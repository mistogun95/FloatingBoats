<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "Drop Database `$mysql_db`";

    if(!$con->query($query))
        echo("Errore eliminazione database</br>");
    else
        echo("Database eliminato con successo</br>");

    mysqli_close($con);

?>
