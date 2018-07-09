<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "CREATE TABLE `mes` (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `Username_Autore` varchar(50) NOT NULL,
        `ID_Private_Chat` int(11) NOT NULL,
        `Data` date NOT NULL,
        `Contenuto` varchar(256) NOT NULL,
        'Letto' boolean NOT NULL,
        PRIMARY KEY (`ID`),
        FOREIGN KEY (`Username_Autore`) REFERENCES Users(username),
        FOREIGN KEY (`ID_Private_Chat`) REFERENCES private_chat(ID)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    if(!$con->query($query))
        echo("Errore creazione tabella</br>");
    else 
        echo("Tabella mes creata con successo</br>");

    mysqli_close($con);
?>
