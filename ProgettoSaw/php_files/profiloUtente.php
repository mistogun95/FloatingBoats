<?php
    session_start();
    if(isset($_GET["Utente"]))
        $user = $_GET["Utente"];
    else
        header("Refresh:0; URL=../Homepage.html");
    
    echo $user;

    include "../db/mysql_credentials.php";
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        echo "<script type='text/javascript'>alert('connection error');</script>";
        header("Refresh:0; URL=Homepage.html");
    }
    else
    {
        $stmt = $conn->prepare("SELECT FlagFoto, Citta, AboutMe, LinkWebSite, Facebook, Instagram, Twitter, Name, Surname, Interessi FROM Users WHERE Username=?");
        $stmt->bind_param("s",$user);

        if(!$stmt->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=Homepage.html");
        }

        $stmt->bind_result($var_FlagFoto, $var_Citta, $var_AboutMe, $var_LinkWebSite, $var_Facebook, $var_Instagram, $var_Twitter, $var_Name, $var_Surname, $var_interessi);
        $stmt->fetch();
    }
?>