<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "CREATE TABLE `Tags` (
        `Name` varchar(50) NOT NULL,
         PRIMARY KEY (`Name`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    if(!$con->query($query))
        echo("Errore creazione tabella</br>");
    else 
        echo("Tabella User creata con successo</br>");

    mysqli_close($con);
?>