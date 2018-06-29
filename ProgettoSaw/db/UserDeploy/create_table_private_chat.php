<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "CREATE TABLE `private_chat` (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `Utente1` varchar(50) NOT NULL,
        `Utente2` varchar(50) NOT NULL,
        PRIMARY KEY (`ID`),
        FOREIGN KEY (`Utente1`) REFERENCES Users(username),
        FOREIGN KEY (`Utente2`) REFERENCES Users(username)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    if(!$con->query($query))
        echo("Errore creazione tabella</br>");
    else 
        echo("Tabella private_chat creata con successo</br>");

    mysqli_close($con);
?>
