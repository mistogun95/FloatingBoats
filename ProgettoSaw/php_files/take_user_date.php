<?php
    function take_user_date($username, $conn, $var_directory)
    {
        $arrayDate = array();
        $stmt = $conn->prepare("SELECT FlagFoto, Citta, AboutMe, LinkWebSite, Facebook, Instagram, Twitter, Name, Surname, Interessi FROM Users WHERE Username=?");
        $stmt->bind_param("s",$username);
        
        if(!$stmt->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=Homepage.html");
        }
        
        $stmt->bind_result($var_FlagFoto, $var_Citta, $var_AboutMe, $var_LinkWebSite, $var_Facebook, $var_Instagram, $var_Twitter, $var_Name, $var_Surname, $var_interessi);
        $stmt->fetch();
        $arrayDate[] = $var_FlagFoto;
        $arrayDate[] = $var_Citta;
        $arrayDate[] = $var_AboutMe;
        $arrayDate[] = $var_LinkWebSite;
        $arrayDate[] = $var_Facebook;
        $arrayDate[] = $var_Instagram;
        $arrayDate[] = $var_Twitter;
        $arrayDate[] = $var_Name;
        $arrayDate[] = $var_Surname;
        $arrayDate[] = $var_interessi;
        
        if(isset($var_Name) && isset($var_Surname) )
        {
            if($var_FlagFoto == 1)
            {
                $var_tipo_immagine = array("png", "jpg", "jpeg");

                for ($i = 0; $i < 3; $i++) 
                {
                    $var_complete_path_new_image = $var_directory.$username.".".$var_tipo_immagine[$i];
                    if(file_exists($var_complete_path_new_image))
                    {
                        break;
                    }

                }
                
            }
            else//carico la foto di deafult
            {
                $var_complete_path_new_image = $var_directory."default.png";
            }

        }
        else 
        {
            echo "<script type='text/javascript'>alert('Il fetch è andato male...(take_user_date.php)');</script>";
        }
        $arrayDate[] = $var_complete_path_new_image;
        
        $stmt->close();
        return $arrayDate;
    }
?>