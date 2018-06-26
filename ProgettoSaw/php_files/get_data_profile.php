<?php
    session_start();
    
    include "../db/mysql_credentials.php"; //non metto il ../db perchè viene lanciato da una pagina in root.
    //da fare con i dati di sessione o con il login
    /*$password = "Ciao";  
    $name = "zio";
    $surname = "zio";*/
    $username = $_SESSION['username'];//presumendo di aver già fatto il login e di aver settato bene le session
                      //prendo per buono lo username!!
    echo "<h3>PROFILOOO</h3>";
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        $message = "Conn ERORR!! <br/>";
        //die("Connection failed: " . mysqli_connect_error());
    }
    else
    {
        echo "<h3>DENTRO ELSE</h3><br>";
        $stmt = $conn->prepare("SELECT FlagFoto, Citta, AboutMe, LinkWebSite, Facebook, Instagram, Twitter, Name, Surname FROM Users WHERE Username=?");
        echo "<h3>DOPO PREPARE</h3><br>";
        $stmt->bind_param("s",$username);
        echo "<h3>DOPO LA BIND PARAM</h3><br>";
        if(!$stmt->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=Homepage.html");
        }
        echo "<h3>DOPO EXECUTE<br></h3>";
        $stmt->bind_result($var_FlagFoto, $var_Citta, $var_AboutMe, $var_LinkWebSite, $var_Facebook, $var_Instagram, $var_Twitter, $var_Name, $var_Surname);
        echo "DOPO BIND<br>";
        $stmt->fetch();
        echo "DOPO FETCH()<br>";
        
        if(isset($var_Name) && isset($var_Surname) )
        {
            echo "dentro isset <br>";
            
            echo"<br>--$var_FlagFoto--<br>";
            echo"<br>--$var_Citta--<br>";
            //echo"<br>--$var_FlagFoto--<br>";
            echo"<br>--$var_AboutMe--<br>";
            echo"<br>--$var_LinkWebSite--<br>";
            echo"<br>--$var_Instagram--<br>";
            echo"<br>--$var_Twitter--<br>";
            echo"<br>--$var_Name--<br>";
            echo"<br>--$var_Surname--<br>";
            if($var_FlagFoto == 1)
            {
                $var_tipo_immagine = array("png", "jpg", "ico");
                $var_directory = "ImmaginiCaricate/";
//                $var_directory.$username.".".$var_tipo_immagine
                for ($i = 0; $i < 3; $i++) 
                {
                    $var_complete_path_new_image = $var_directory.$username.".".$var_tipo_immagine[$i];
                    if(file_exists($var_complete_path_new_image))
                    {
                        //echo"<br>--IMMAGINEEEEEEEEEE--<br>";
                        echo '<img src="' . $var_complete_path_new_image . '">';
                        break;
                    }

                }
                
            }
            else//carico la foto di deafult
            {
                $var_complete_path_default_image = "Immagini/default.png";
                echo '<img src="' . $var_complete_path_default_image . '">';
            }
        }
        else 
        {
            echo "<script type='text/javascript'>alert('Il fetch è andato male...');</script>";
        }
        
        $stmt->close();
        $conn->close();
        
        //header("Refresh:0; URL=OK.html");
    }
    

    echo "<label class='userPresent'><b>$message</b></label><br>";
    header( "refresh:5;url=../HomepagePersonale.php" );
    echo "<a class='signIn' href='../HomepagePersonale.php'>Clicca qui per tornare alla homepage(se il tuo browser non supporta il reindirizzamento automatico)</a>";
?>
        
        
        
        