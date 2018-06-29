
<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "INSERT INTO `mes` (`Username Autore`, `ID_Private_Chat`, `Data`, `Contenuto`) VALUES
    ('zio', '1', '2018-07-01', 'ciao, ci sei?'),
    ('kaio', '1', '2018-07-01', 'si ci sono, dimmi tutto.'),
    ('zio', '1', '2018-07-01', 'niente volevo solo salutarti'),
    ('kaio', '1', '2018-07-01', 'ok...'),
    
    ('clin', '2', '2018-07-01', 'perche\' non sei venuto?'),
    ('xavier', '2', '2018-07-01', 'non stavo tanto bene Q_Q'),
    ('clin', '2', '2018-07-01', 'oki, dai fatti forza!!'),
    
    ('pio', '3', '2018-07-01', 'andiamo al cinema oggi?'),
    ('papu', '3', '2018-07-01', 'cosa fai stasera?'),
    ('papu', '3', '2018-07-01', 'ah lol, hai scrito prima te xD'),
    ('papu', '3', '2018-07-01', 'ah lol, comunque per me va bene!'),
        
    ('kaput', '4', '2018-07-01', 'stasera andiamo su da Clin??'),
    ('cyborg', '4', '2018-07-01', 'no devo incontarmi con ROSITA!!'),
    ('kaput', '4', '2018-07-01', 'smetttila con ste GALLINE!!!');";
    
    

    if(!$con->query($query))
        echo("Errore inserimento dati nel database mes</br>");
    else
        echo("Dati inseriti con successo nella tabella mes</br>");

    mysqli_close($con);
?>