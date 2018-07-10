<?php
function check_new_message($user1, $conn)
{
    ini_set('display_errors','On');
    error_reporting(E_ALL); 
    include "take_chat_id.php";

    $Id_chats = take_chat_id($user1, $conn);
    $query = "SELECT Username_Autore FROM mes WHERE ID_Private_Chat=? AND Letto=?";
    $usernames = array();
    $b = FALSE;

    foreach($Id_chats as $Id_chat)
    {
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $Id_chat, $b);
        if(!$stmt->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error2');</script>";
            $stmt->close();
            header("Refresh:0; URL=../HomepagePersonale.php");
        }
        $stmt->bind_result($username);
        $stmt->fetch();
        $stmt->close();
        $usernames[] = $username;
    }
    return $usernames;
}
   
    
?>