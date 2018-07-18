<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "Drop Table Tags";

    if(!$con->query($query))
        echo("Errore eliminazione tabella Tags</br>");
    else
        echo("Tabella eliminata con successo</br>");

    mysqli_close($con);

?>
