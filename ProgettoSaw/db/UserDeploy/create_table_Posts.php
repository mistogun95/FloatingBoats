<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "CREATE TABLE `Posts` (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `Nomebarca` varchar(50) DEFAULT NULL,
        `Titolo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
        `NumeroPostiBarca` int(11) NOT NULL,
        `DataInizio` date NOT NULL,
        `DataFine` date DEFAULT NULL,
        `LuogoDiRitrovo` varchar(50) NOT NULL,
        `SpesaViaggioTotale` int(11) NOT NULL,
        `Descrizione` varchar(256) NOT NULL,
        `StrumentazioneRichiesta` varchar(200) NOT NULL,
        `Latitudine` FLOAT(9) DEFAULT NULL,
        `Longitudine` FLOAT(10) DEFAULT NULL,
        `Citta` varchar(50) NOT NULL,
        `UsernameAutore` varchar(50) NOT NULL,
        `Tag` varchar(100),
        PRIMARY KEY (`ID`),
        FOREIGN KEY (`UsernameAutore`) REFERENCES Users(username) on update cascade
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    if(!$con->query($query))
        echo("Errore creazione tabella</br>");
    else 
        echo("Tabella Posts creata con successo</br>");

    mysqli_close($con);


    /*
    CREATE TABLE `Posts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome barca` varchar(50) DEFAULT NULL,
  `Titolo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Numero Posti Barca` int(11) NOT NULL,
  `Data Inizio` date NOT NULL,
  `Data Fine` date DEFAULT NULL,
  `Luogo Di Ritrovo` varchar(50) NOT NULL,
  `Spesa Viaggio Totale` int(11) NOT NULL,
  `Descrizione` varchar(256) NOT NULL,
  `Strumentazione Richiesta` varchar(200) NOT NULL,
  `Coordinata Nord` int(11) DEFAULT NULL,
  `Coordinata Sud` int(11) DEFAULT NULL,
  `Citta` int(11) NOT NULL,
  `Username Autore` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  FOREIGN KEY (`Username Autore`) REFERENCES Users(username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    */
?>
