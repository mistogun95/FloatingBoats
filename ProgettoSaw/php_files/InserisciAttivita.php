<?php 
    include "../db/mysql_credentials.php";
    ini_set('display_errors','On');
?>
<?php
    session_start();
    include "../db/mysql_credentials.php";
    $username = $_SESSION['username'];
    $boat = filter_var(htmlspecialchars(trim($_POST['boatIn'])), FILTER_SANITIZE_STRING);
    $title = filter_var(htmlspecialchars(trim($_POST['titleIn'])), FILTER_SANITIZE_STRING);
    $seats = filter_var(htmlspecialchars(trim($_POST['Nseats'])), FILTER_SANITIZE_STRING);
    $start = filter_var(htmlspecialchars(trim($_POST['startIn'])), FILTER_SANITIZE_STRING);
    $end = filter_var(htmlspecialchars(trim($_POST['endIn'])), FILTER_SANITIZE_STRING);
    $place = filter_var(htmlspecialchars(trim($_POST['placeIn'])), FILTER_SANITIZE_STRING);
    $description = filter_var(htmlspecialchars(trim($_POST['descrizione'])), FILTER_SANITIZE_STRING);
    $città = filter_var(htmlspecialchars(trim($_POST['cittàIn'])), FILTER_SANITIZE_STRING);
    $place = filter_var(htmlspecialchars(trim($_POST['placeIn'])), FILTER_SANITIZE_STRING);
    $totalCost = filter_var(htmlspecialchars(trim($_POST['totalCostIn'])), FILTER_SANITIZE_STRING);
    $instrumentation = filter_var(htmlspecialchars(trim($_POST['instrumentationIn'])), FILTER_SANITIZE_STRING);
    $Latitudine = filter_var(htmlspecialchars(trim($_POST['Latitudine'])), FILTER_SANITIZE_STRING);
    $Longitudine = filter_var(htmlspecialchars(trim($_POST['Longitudine'])), FILTER_SANITIZE_STRING);
    $tags = "";
    $regexDate = '/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/';
    /*echo $start."<br>";
    echo $end."<br>";
    */
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

    $stmt = $conn->prepare("SELECT COUNT(*) FROM Tags");
    $count = 0;
    
    if(!$stmt->execute())
    {
        echo "<script type='text/javascript'>alert('Execute Error');</script>";
        $stmt->close();
        $conn->close();
        header("Refresh:0; URL=HomepagePersonale.php");
    }

    $stmt->bind_result($numberTags);
    $stmt->fetch();
    $stmt->close();
    for($i = 0; $i<$numberTags; $i++)
    {
        if(isset($_POST['check'.$i]))
        {
            $tags = $tags.$_POST['check'.$i].",";
        }
    }

    if(!preg_match($regexDate, $start) || !preg_match($regexDate, $end))
    {
        echo "Errore inserimento data";
    }
    else
    {
        $stmt = $conn->prepare("INSERT INTO Posts (Nomebarca, Titolo, NumeroPostiBarca, DataInizio, DataFine, LuogoDiRitrovo, SpesaViaggioTotale, Descrizione, StrumentazioneRichiesta, Latitudine, Longitudine, Citta, UsernameAutore, Tag) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssddsss", $boat, $title, $seats, $start, $end, $place, $totalCost, $description, $instrumentation, $Latitudine, $Longitudine, $città, $username, $tags);
        if(!$stmt->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=HomepagePersonale.php");
        }
        $stmt->close(); 
    }
    $conn->close();
    header( "refresh:0;url=../HomepagePersonale.php" );

    
?>

