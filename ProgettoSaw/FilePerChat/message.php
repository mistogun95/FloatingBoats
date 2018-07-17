<?php
    ini_set('display_errors','On');
    error_reporting(E_ALL);
    session_start();
    if(!isset($_SESSION["username"]))
        header("Location: ../error.php");
    else 
        $user1 = stripslashes($_SESSION["username"]);
    include "../db/mysql_credentials.php";
    if ($_GET["userContact"] != "")
        $user2 = filter_var(htmlspecialchars(trim($_GET["userContact"])));
    else 
        $user2 = filter_var(htmlspecialchars(trim($_POST["username_chat"])));
    if($user2 === $user1)
        header("Location: ../error.php");
    else{
        $mex = filter_var(htmlspecialchars(trim($_POST["messaggio"])));

        $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
        if ($conn->connect_error) {
            header("Location: ../error.php");
        }
        else
        {
            $stmt = $conn->prepare("SELECT ID FROM private_chat WHERE (Utente1=? AND Utente2=?) OR (Utente1=? AND Utente2=?)");
            $stmt->bind_param("ssss", $user1, $user2, $user2, $user1);

            if(!$stmt->execute())
            {
                $stmt->close();
                $conn->close();
                header("Location: ../error.php");
            }

            $stmt->bind_result($Id_chat);
            $stmt->fetch();
            $stmt->close();

            if(!isset($Id_chat))
            {
                set_private_chat($conn, $user1, $user2);
                $Id_chat1 = take_chat_id($user1, $user2, $conn);
                send_message($user1, $Id_chat1, $mex, $conn);
                $conn->close();
                header("Refresh:0; URL=chat.php?userContact=".$user2);
            }
            else
            {
                send_message($user1, $Id_chat, $mex, $conn);
                $conn->close();
                header("Refresh:0; URL=chat.php?userContact=".$user2);
            }
        }
    }


    function set_private_chat($conn, $user1, $user2)
    {
        $query = "INSERT INTO private_chat (Utente1,Utente2) VALUES (?,?)";
        $stmt2 = $conn->prepare($query);
        $stmt2->bind_param("ss", $user1,$user2);

        if(!$stmt2->execute())
        {
            $stmt2->close();
            $conn->close();
            header("Location: ../error.php");
        }

        $stmt2->close();
    }

    function take_chat_id($user1, $user2, $conn)
    {
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
        return $Id_chat;
    }

    function send_message($user1, $Id_private_chat, $mex, $conn)
    {
        $date = date("Y/m/d");
        $query = "INSERT INTO mes (Username_Autore, ID_Private_Chat, Data, Contenuto) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("siss", $user1,$Id_private_chat,$date,$mex);

        if(!$stmt->execute())
        {
            $stmt->close();
            $conn->close();
            header("Location: ../error.php");
        }

        $stmt->close();
    }

?>