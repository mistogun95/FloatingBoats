
<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "INSERT INTO `Posts` (`Nome barca`, `Titolo`, `Numero Posti Barca`,
                `Data Inizio`, `Data Fine`, `Luogo Di Ritrovo`, `Spesa Viaggio Totale`,
                `Descrizione`, `Strumentazione Richiesta`, `Coordinata Nord`, `Coordinata Sud`,
                `Citta`, `Username Autore`,`Tag`) VALUES
    
    ('luna','Pesca immersione','8','2018-06-15','2018-06-16','marina di sestri',
    '180','piccola gita per pescare','boccaglio,pinne','45.60','36.88','Genova','zio','pesca, immersione'),
    
    ('sirena tiger','paesaggio vela','5','2018-07-01','2018-07-06','fiera di genova',
    '250','viaggio in mezzo al mare','solo la voglia di ammirare il mare','20.156','26.895','Genova','kaio','paesaggio, vela'),
    
    ('caronte express','vela immersione','5','2018-07-01','2018-07-06','genova est',
    '250','vela mania!!','niente','20.156','26.895','Genova','kaio','vela, immersione'),

    ('traghetto','pesca immersione','5','2018-07-01','2018-07-06','genova est',
    '250','vela mania!!','niente','20.156','26.895','Genova','kaio','barca solo a motore, immersione'),

    ('traghetto','pesca vela','5','2018-07-01','2018-07-06','genova est',
    '250','vela mania!!','niente','20.156','26.895','Genova','zio','pesca, vela')
        
        ;";

    if(!$con->query($query))
        echo("Errore inserimento dati nel database (Posts)</br>");
    else
        echo("Dati inseriti con successo (Posts)</br>");

    mysqli_close($con);
?>