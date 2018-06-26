<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "CREATE TABLE `Users` (
        `Username` varchar(50) NOT NULL,
        `Name` varchar(100) NOT NULL,
        `Surname` varchar(100) NOT NULL,
        `Password` varchar(256) NOT NULL,
        `FlagFoto` BOOLEAN NOT NULL DEFAULT FALSE,
        `Citta` varchar(100),
        `AboutMe` varchar(256),
        `linkWebSite` varchar(256),
        `Facebook` varchar(256),
        `Instagram` varchar(256),
        `Twitter` varchar(256),
         PRIMARY KEY (`Username`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    if(!$con->query($query))
        echo("Errore creazione tabella</br>");
    else 
        echo("Tabella User creata con successo</br>");

    mysqli_close($con);
?>