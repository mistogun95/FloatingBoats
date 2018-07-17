<?php
    ini_set('display_errors','On');
    error_reporting(E_ALL); 
    session_start();
    if(!isset($_SESSION["username"]))
        header("Location: ../error.php");
    else
    {
        $user = stripslashes($_SESSION["username"]);
        $user2 = filter_var(htmlspecialchars(trim($_GET['userContact'])));
    }
    include "../db/mysql_credentials.php"; 
?>

<html>
    <head>
        <title>Messaggi</title>
        <meta name ="homepage" content ="homepage here" />
	    <meta name ="" content ="" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8"/>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="chatStyle.css"/>
    <head>
    <body>
        <nav class="navbar navbar-expand-lg bg-info navbar-light sticky-top">
            <a class="navbar-brand" href="../HomepagePersonale.php">
                <img src="../Immagini/logo1.png" alt="logo" style="width:60px;">
            </a>
            <ul class="navbar-nav">
            <li class="nav-item"><p><b>Benvenuto <?php echo $user ?></b></p></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="../Logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class = "bg">
        <div class="row h-100 justify-content-center align-items-center" id="chat_div">
            <div class="anyclass">
                <?php
                    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
                    if ($conn->connect_error) {
                        header("Location: ../error.php");
                    }
                    else
                    {
                        show_message_user1($user, $user2, $conn);
                        show_message_user2($user, $user2, $conn);
                        $conn->close();
                    }
                ?>
            </div>
            <?php
                if($user2 === "") 
                    echo "<div id=\"CHAT\" class=\"offset-md-1 col-md-8\">";
                else
                    echo "<div id=\"CHAT\" class=\"offset-md-4 col-md-8\">";
            ?>
                <form name="chat" method="post" action="message.php?userContact=<?php echo $user2 ?>" enctype="multipart/form-data">
                    <?php
                        if($user2 === "")
                            echo "<input type=\"text\" class=\"inputMessage\" name=\"username_chat\" size=\"50\" maxlength=\"200\" placeholder=\"Username persona da contattare\">"
                    ?>
                    <input type="text" name="messaggio" class="inputMessage"  maxlength="200" placeholder="Scrivi qui il messaggio">
                    <input type="submit" value="CHAT">
                </form>
            </div>
        </div>
        </div>
    </body>
</html>

<?php
    function show_message_user1($user1, $user2, $conn)
    {
        include_once "take_user_profile_imeage.php";
        $stmt = $conn->prepare("SELECT ID FROM private_chat WHERE Utente1=? AND Utente2=?");
        $stmt->bind_param("ss", $user1, $user2);

        if(!$stmt->execute())
        {
            $stmt->close();
            $conn->close();
            header("Location: ../error.php");
        }

        $stmt->bind_result($Id_chat);
        $stmt->fetch();
        $stmt->close();

        $stmt2 = $conn->prepare("SELECT Contenuto, Data, Username_Autore FROM mes WHERE ID_Private_Chat=?");
        $stmt2->bind_param("i", $Id_chat);

        if(!$stmt2->execute())
        {
            $stmt2->close();
            $conn->close();
            header("Location: ../error.php");
        }

        $stmt2->bind_result($mex, $dataMex, $autor);
        while($stmt2->fetch())
        {
            if($autor === $user1)
            {
                echo "<div class=\"container\">";
                $imagePath = take_user_profile_image($autor, "../ImmaginiCaricate/");
                echo "<img src=\"".$imagePath."\"alt=\"Avatar\" style=\"width:40px;\"";
                echo "<label><p>"."<b>".$autor." scrive "."</b>".$mex."</p></label>";
                echo "<span class=\"time-right\">".$dataMex."</span>";
                echo "</div>";
            }
            else
            {
                echo "<div class=\"container darker\">";
                $imagePath = take_user_profile_image($autor, "../ImmaginiCaricate/");
                echo "<img src=\"".$imagePath."\"alt=\"Avatar\" class=\"right\" style=\"width:40px;\"";
                echo "<label><p>"."<b>".$autor." scrive "."</b>".$mex."</p></label>";
                echo "<span class=\"time-left\">".$dataMex."</span>";
                echo "</div>";
            }
        }
        
        if($autor != $user1)
            update_see_message($Id_chat, $conn);
        
        $stmt2->close();
    }

    function show_message_user2($user1, $user2, $conn)
    {
        include_once "take_user_profile_imeage.php";
        $stmt = $conn->prepare("SELECT ID FROM private_chat WHERE Utente1=? AND Utente2=?");
        $stmt->bind_param("ss", $user2, $user1);

        if(!$stmt->execute())
        {
            $stmt->close();
            $conn->close();
            header("Location: ../error.php");
        }

        $stmt->bind_result($Id_chat);
        $stmt->fetch();
        $stmt->close();

        $stmt2 = $conn->prepare("SELECT Contenuto, Data, Username_Autore FROM mes WHERE ID_Private_Chat=?");
        $stmt2->bind_param("i", $Id_chat);

        if(!$stmt2->execute())
        {
            $stmt2->close();
            $conn->close();
            header("Location: ../error.php");
        }

        $stmt2->bind_result($mex, $dataMex, $autor);
        while($stmt2->fetch())
        {
            if($autor === $user1)
            {
                echo "<div class=\"container\">";
                $imagePath = take_user_profile_image($autor, "../ImmaginiCaricate/");
                echo "<img src=\"".$imagePath."\"alt=\"Avatar\"  style=\"width:40px;\"";
                echo "<label><p>"."<b>".$autor." scrive "."</b>".$mex."</p></label>";
                echo "<span class=\"time-right\">".$dataMex."</span>";
                echo "</div>";
            }
            else
            {
                echo "<div class=\"container darker\">";
                $imagePath = take_user_profile_image($autor, "../ImmaginiCaricate/");
                echo "<img src=\"".$imagePath."\"alt=\"Avatar\" class=\"right\" style=\"width:40px;\"";
                echo "<label><p>"."<b>".$autor." scrive "."</b>".$mex."</p></label>";
                echo "<span class=\"time-left\">".$dataMex."</span>";
                echo "</div>";
            }
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
            $stmt->close();
            $conn->close();
            header("Location: ../error.php");
        }
        $stmt->close();

    }
?>
