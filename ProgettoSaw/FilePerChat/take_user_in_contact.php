<?php 
    function take_user_in_contact($user, $conn)
    {
        ini_set('display_errors','On');
    error_reporting(E_ALL);
        if ($conn->connect_error) {
            $message = "Conn ERORR!! <br/>";
        }
        else
        {
            include "check_new_message.php";
            $arrayContact = array();
            $arrayUsers = check_new_message($user, $conn);
            $stmt = $conn->prepare("SELECT Utente2 FROM private_chat WHERE Utente1=?");
            $stmt->bind_param("s", $user);

            if(!$stmt->execute())
            {
                echo "<script type='text/javascript'>alert('Execute Error');</script>";
                $stmt->close();
                $conn->close();
                header("Refresh:0; URL=../HomepagePersonale.php");
            }

            $stmt->bind_result($userContact);
            while($stmt->fetch())
            {
                if(in_array($userContact, $arrayUsers))
                    echo "<a class=\"nav-link btn btn-primary\" href=\"FilePerChat/chat.php?userContact=".$userContact."\">".$userContact."<i class=\"fa fa-exclamation-circle\" style=\"font-size:24px;color:red\"></i></a>";
                else
                    echo "<a class=\"nav-link btn btn-primary\" href=\"FilePerChat/chat.php?userContact=".$userContact."\">".$userContact."</a>";
            }
            $stmt->close();

            $stmt = $conn->prepare("SELECT Utente1 FROM private_chat WHERE Utente2=?");
            $stmt->bind_param("s", $user);

            if(!$stmt->execute())
            {
                echo "<script type='text/javascript'>alert('Execute Error');</script>";
                $stmt->close();
                $conn->close();
                header("Refresh:0; URL=../HomepagePersonale.php");
            }

            $stmt->bind_result($userContact);
            while($stmt->fetch())
            {
                if(in_array($userContact, $arrayUsers))
                    echo "<a class=\"nav-link btn btn-primary\" href=\"FilePerChat/chat.php?userContact=".$userContact."\">".$userContact."<i class=\"fa fa-exclamation-circle\" style=\"font-size:24px;color:red\"></i></a>";
                else
                    echo "<a class=\"nav-link btn btn-primary\" href=\"FilePerChat/chat.php?userContact=".$userContact."\">".$userContact."</a>";
            }
            $stmt->close();
        }
    }

?>