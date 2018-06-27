<?php
    include "../db/mysql_credentials.php";
    ini_set('display_errors','On');
    error_reporting(E_ALL);
    session_start();
    $oldUsername = $_SESSION['username'];
    $webSite = filter_var(htmlspecialchars(trim($_POST['webIn'])), FILTER_SANITIZE_STRING);
    $name = filter_var(htmlspecialchars(trim($_POST['nameIn'])), FILTER_SANITIZE_STRING);
    $surname = filter_var(htmlspecialchars(trim($_POST['surnameIn'])), FILTER_SANITIZE_STRING);
    $username = filter_var(htmlspecialchars(trim($_POST['usernameIn'])), FILTER_SANITIZE_STRING);
    $twitter = filter_var(htmlspecialchars(trim($_POST['twitterIn'])), FILTER_SANITIZE_STRING);
    $instagram = filter_var(htmlspecialchars(trim($_POST['instagramIn'])), FILTER_SANITIZE_STRING);
    $aboutMe = filter_var(htmlspecialchars(trim($_POST['descrizione'])), FILTER_SANITIZE_STRING);
    $città = filter_var(htmlspecialchars(trim($_POST['cittàIn'])), FILTER_SANITIZE_STRING);
    $facebook = filter_var(htmlspecialchars(trim($_POST['faceIn'])), FILTER_SANITIZE_STRING);

    // $uppercase = preg_match('@[A-Z]@', $password);
    // $lowercase = preg_match('@[a-z]@', $password);
    // $number    = preg_match('@[0-9]@', $password);
    // $specialChars = preg_match('@[^\w]@', $password);

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        $message1 = "KO";
    }
    else $message1 = "OK";
    $stmtUser = $conn->prepare("SELECT Username FROM Users WHERE Username=?");
    $stmtUser->bind_param("s", $oldUsername);
    $stmtUser->execute();
    $stmtUser->bind_result($userResult);
    $stmtUser->fetch();
    $stmtUser->close();

    $stmtUser1 = $conn->prepare("SELECT Username FROM Users WHERE Username=?");
    $stmtUser1->bind_param("s", $username);
    $stmtUser1->execute();
    $stmtUser1->bind_result($userResult1);
    $stmtUser1->fetch();
    $stmtUser1->close();

    if(preg_match('@[^\w]@', $surname))
        $message = "Attenzione hai inserito caratteri speciali nel Cognome<br/>";

    //controllo che il nome non contegna caratteri speciali
    else if(preg_match('@[^\w]@', $name))
        $message = "Attenzione hai inserito caratteri speciali nel Nome<br/>";

    //controllo che l'username non contegna caratteri speciali
    else if(preg_match('@[^\w]@', $username))
        $message = "Attenzione hai inserito caratteri speciali nel username<br/>";
    else if (isset($userResult1) && $userResult1 != $oldUsername)
        $message = "Attenzione username già presente nel database";

    //se tutti i controlli vengono passati allora posso inserire l'utente nel database
    else if ($message1 === "KO") {
        $message = "Errore connessione!! <br/>";
    }
    else
    {
        if($oldUsername === $username)
        {
            $query = "UPDATE Users SET Name=?, Surname=?, Citta=?, AboutMe=?, linkWebSite=?, Facebook=?, Instagram=?, Twitter=? WHERE Username=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssssssss", $name, $surname, $città, $aboutMe, $webSite, $facebook, $instagram, $twitter, $userResult);
            if(!$stmt->execute())
                $message = "EXECUTE!!! <br/>";
            $stmt->close();
            $conn->close();
            $message = "Modifica andata a buon fine"; 
        }
        else 
        {
            $query = "UPDATE Users SET Username=?, Name=?, Suername=?, Citta=?, AboutMe=?, linkWebSite=?, Facebook=?, Instagram=?, Twitter=? WHERE Username=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssssssss",$username,$name, $surname, $città, $aboutMe, $webSite, $facebook, $instagram, $twitter, $userResult);
            if(!$stmt->execute())
                $message = "EXECUTE!!! <br/>";
            $_SESSION['username'] = $username;
            $stmt->close();
            $conn->close();
            $message = "Modifica andata a buon fine";
        }
    }
    echo "<label class='userPresent'><b>$message</b></label><br>";
    header( "refresh:5;url=profile.php" );
    echo "<a class='signIn' href='profile.php'>Clicca qui per tornare alla homepage(se il tuo browser non supporta il reindirizzamento automatico)</a>";
?>