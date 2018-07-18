
<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "INSERT INTO `Posts` (`Nomebarca`, `Titolo`, `NumeroPostiBarca`,
                `DataInizio`, `DataFine`, `LuogoDiRitrovo`, `SpesaViaggioTotale`,
                `Descrizione`, `StrumentazioneRichiesta`, `Latitudine`, `Longitudine`,
                `Citta`, `UsernameAutore`,`Tag`) VALUES
    
    ('luna','Pesca immersione la bella vita','8','2018-06-15','2018-06-16','marina di sestri',
    '180','piccola gita per pescare','boccaglio,pinne','44.3995263','8.9324832','Genova','zio','pesca, immersione'),
    
    ('sirena tiger','paesaggio vela la grande botta','5','2018-07-01','2018-07-06','fiera di genova',
    '250','viaggio in mezzo al mare','solo la voglia di ammirare il mare','44.4085325','8.8870322','Genova','kaio','paesaggio, vela'),
    
    ('caronte express','vela immersione settima destinazione','5','2018-07-01','2018-07-06','genova est',
    '250','vela mania!!','niente','44.3802013','9.0371402','Genova','kaio','vela, immersione'),

    ('traghetto','pesca immersione franchino e ricky le roy','5','2018-07-01','2018-07-06','genova est',
    '250','vela mania!!','niente','44.3911002','8.9736535','Genova','kaio','barca solo a motore, immersione'),

    ('traghetto','pesca vela mondo visione','5','2018-07-01','2018-07-06','genova est',
    '250','vela mania!!','niente','44.392182','8.9492265','Genova','zio','pesca, vela')
        
        ;";

    if(!$con->query($query))
        echo("Errore inserimento dati nel database (Posts)</br>");
    else
        echo("Dati inseriti con successo (Posts)</br>");

    mysqli_close($con);
?>