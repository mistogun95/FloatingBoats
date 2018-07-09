<?php
    ini_set('display_errors','On');
    error_reporting(E_ALL); 
    session_start();
    if(!isset($_SESSION["username"]))
        header("Refresh:0; URL=../Homepage.html");
    else
    {
        $user = stripslashes($_SESSION["username"]);
        $user2 = $_GET['userContact'];
    }
    include "../db/mysql_credentials.php"; 
?>

<html>
    <head>
        <title>Messaggi</title>
        <!-- <meta name ="homepage" content ="homepage here" />
	    <meta name ="" content ="" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8"/>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="profileStyle.css"/> -->
    <head>
    <body>
        <p>Benvenuto<b><?php echo $user; ?></b></p>
        <div id="CHAT"></div>
        <form name="chat" method="post" action="message.php" enctype="multipart/form-data">
            <input type="text" name="username_chat" size="50" maxlength="200" placeholder="Username persona da contattare" value=<?php echo $user2 ?>>
            <input type="text" name="messaggio" size="50" maxlength="200" placeholder="Scrivi qui il messaggio">
            <input type="submit" value="CHAT">
        </form>
        <?php
            $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
            if ($conn->connect_error) {
                $message = "Conn ERORR!! <br/>";
            }
            else
            {
                show_message_user1($user, $user2, $conn);
                show_message_user2($user, $user2, $conn);
                $conn->close();
            }
        ?>
    </body>
</html>

<?php
    function show_message_user1($user1, $user2, $conn)
    {
        $stmt = $conn->prepare("SELECT ID FROM private_chat WHERE Utente1=? AND Utente2=?");
        $stmt->bind_param("ss", $user1, $user2);

        if(!$stmt->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=../HomepagePersonale.php");
        }

        $stmt->bind_result($Id_chat);
        $stmt->fetch();
        $stmt->close();

        $stmt2 = $conn->prepare("SELECT Contenuto, Data, Username_Autore FROM mes WHERE ID_Private_Chat=?");
        $stmt2->bind_param("i", $Id_chat);

        if(!$stmt2->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt2->close();
            $conn->close();
            header("Refresh:0; URL=../HomepagePersonale.php");
        }

        $stmt2->bind_result($mex, $dataMex, $autor);
        while($stmt2->fetch())
        {
            echo "<span class=\"\">".$dataMex."</span>";
            echo "<label><p>"."<b>".$autor." scrive "."</b>".$mex."</p></label>";
        }
        
        if($autor != $user1)
            update_see_message($Id_chat, $conn);
        
        $stmt2->close();
    }

    function show_message_user2($user1, $user2, $conn)
    {
        $stmt = $conn->prepare("SELECT ID FROM private_chat WHERE Utente1=? AND Utente2=?");
        $stmt->bind_param("ss", $user2, $user1);

        if(!$stmt->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=../HomepagePersonale.php");
        }

        $stmt->bind_result($Id_chat);
        $stmt->fetch();
        $stmt->close();

        $stmt2 = $conn->prepare("SELECT Contenuto, Data, Username_Autore FROM mes WHERE ID_Private_Chat=?");
        $stmt2->bind_param("i", $Id_chat);

        if(!$stmt2->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt2->close();
            $conn->close();
            header("Refresh:0; URL=../HomepagePersonale.php");
        }

        $stmt2->bind_result($mex, $dataMex, $autor);
        while($stmt2->fetch())
        {
            echo "<span class=\"\">".$dataMex."</span>";
            echo "<label><p>"."<b>".$autor." scrive "."</b>".$mex."</p></label>";
        }
        
        if($autor != $user1)
            update_see_message($Id_chat, $conn);
        
        $stmt2->close();
    }

    function update_see_message($Id_chat, $conn)
    {
        $stmt = $conn->prepare("UPDATE mes SET Letto=1 WHERE ID_Private_Chat=?");
        $stmt->bind_param("i", $Id_chat);

        if(!$stmt->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=../HomepagePersonale.php");
        }
        $stmt->close();

    }
?>
