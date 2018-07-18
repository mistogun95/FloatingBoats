<?php
    function take_chat_id($user1, $conn)
    {
        $Id_chats = array();
        $stmt = $conn->prepare("SELECT ID FROM private_chat WHERE Utente1=?");
        $stmt->bind_param("s", $user1);

        if(!$stmt->execute())
        {
            $stmt->close();
            header("Location: ../error.php");
            exit;
        }

        $stmt->bind_result($Id_chat);
        while($stmt->fetch())
        {
            $Id_chats[] = $Id_chat;
        }
        $stmt->close();

        $stmt = $conn->prepare("SELECT ID FROM private_chat WHERE Utente2=?");
        $stmt->bind_param("s", $user1);

        if(!$stmt->execute())
        {
            $stmt->close();
            header("Location: ../error.php");
            exit;
        }

        $stmt->bind_result($Id_chat);
        while($stmt->fetch())
        {
            $Id_chats[] = $Id_chat;
        }
        $stmt->close();
        
        return $Id_chats;
    }
?>