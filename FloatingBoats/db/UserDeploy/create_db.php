<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass) or die ("Errore Connessione al Database");
    $query = "CREATE DATABASE IF NOT EXISTS $mysql_db";
    
    if(!$con->query($query))
        echo("Errore creazione database</br>");
    else
        echo("Database creato con successo</br>");
    mysqli_close($con);

?>