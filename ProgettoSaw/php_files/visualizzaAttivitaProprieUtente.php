<li class="nav-item"><a class="nav-link" href="php_files/visualizzaAttivitaProprieUtente.php?username=<?php echo $username ?>">Attività</a></li>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
	    <meta name ="homepage" content ="homepage here" />
	    <meta name ="" content ="" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="profileStyle.css"/>
    </head>
    <body class>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhnvNJTfDyfVn08mAufLn9p1SA-DdhlXo&callback=myMap"></script>
        <nav class="navbar navbar-expand-lg bg-info navbar-light sticky-top">
            <a class="navbar-brand" href="../HomepagePersonale.php">
                <img src="../Immagini/logo1.png" alt="logo" style="width:60px;">
            </a>
            <ul class = "navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#AboutUs">AboutUs</a></li>
                <li class="nav-item"><a class="nav-link" href="#contatti">Contattaci</a></li>
                <li class="nav-item"><a class="nav-link" href="php_files/get_data_profile.php">Profilo</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Messaggi</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="../Logout.php">Logout</a></li>
            </ul>
        </nav>
        <table class = "tabel table-hover table-bordered personalTable">
            <thead>
                <tr>
                    <th>Nome Barca</th>
                    <th>Titolo</th>
                    <th>Numero Posti Barca</th>
                    <th>Data Inizio</th>
                    <th>Data Fine</th>
                    <th>Luogo di Ritrovo</th>
                    <th>Spesa totale viaggio</th>
                    <th>Descrizione</th>
                    <th>Strumentazione richiesta</th>
                    <th>Coordinata Nord</th>
                    <th>Coordinata Sud</th>
                    <th>Città</th>
                    <th>Autore post</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
                    $username = $_GET["username"];
                    $query = "SELECT Nomebarca,Titolo,NumeroPostiBarca,DataInizio,DataFine,LuogoDiRitrovo,SpesaViaggioTotale,Descrizione,StrumentazioneRichiesta,Latitudine,Longitudine,Citta FROM Posts WHERE UsernameAutore=?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->bind_result($NomeB, $Titol, $NPosti, $Inizio, $Fine, $Ritrovo, $Spesa, $Descr, $Strumentazione, $Latitudine, $Longitudine, $citta);
                    while($stmt->fetch())
                    {
                        
                        echo "<tr>";
                        echo "<td>".$NomeB."</td>";
                        echo "<td>".$Titol."</td>";
                        echo "<td>".$NPosti."</td>";
                        echo "<td>".$Inizio."</td>";
                        echo "<td>".$Fine."</td>";
                        echo "<td>".$Ritrovo."</td>";
                        echo "<td>".$Spesa."</td>";
                        echo "<td>".$Descr."</td>";
                        echo "<td>".$Strumentazione."</td>";
                        echo "<td>".$Latitudine."</td>";
                        echo "<td>".$Longitudine."</td>";
                        echo "<td>".$citta."</td>";
                        echo "</tr>";

                    }
                    $stmt->close();
                    $conn->close();
                ?>
            </tbody>
        </table>
    </body>
</html>

