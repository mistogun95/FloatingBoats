<?php
    ini_set('display_errors','On');
    error_reporting(E_ALL);
    include "../db/mysql_credentials.php"; 
    session_start();
    if(!isset($_SESSION["username"]))
        header("Refresh:0; URL=Homepage.html");
    else 
        $user = stripslashes($_SESSION["username"]);
?>

<html>
    <head>
        <title>Messaggi</title>
    <head>
    <body>
        <p>Benvenuto<b><?php echo $user; ?></b></p>
        <div id="CHAT"></div>
        <form name="chat" method="post" action="message.php" target="MSG">
            <input type="text" name="username_chat" size="50" maxlength="200" placeholder="Username persona da conttare">
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
                show_message_user1($user, $conn);
                show_message_user2($user, $conn);
                $conn->close();
            }
        ?>
    </body>
</html>

<?php
    function show_message_user1($user, $conn)
    {
                $stmt = $conn->prepare("SELECT ID FROM private_chat WHERE Utente1=?");
                $stmt->bind_param("s", $user);

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
                    echo "<span class=\"chat_date\">".$dataMex."</span>";
                    echo "<label><p>"."<b>".$autor." scrive "."</b>".$mex."</p></label>";
                }
                $stmt2->close();
    }

    function show_message_user2($user, $conn)
    {
        $stmt = $conn->prepare("SELECT ID FROM private_chat WHERE Utente2=?");
                $stmt->bind_param("s", $user);

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
                    echo "<span class=\"chat_date\">".$dataMex."</span>";
                    echo "<label><p>"."<b>".$autor." scrive "."</b>".$mex."</p></label>";
                }
                $stmt2->close();
    }
?>
