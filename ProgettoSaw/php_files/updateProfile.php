<?php
    include "../db/mysql_credentials.php";
    ini_set('display_errors','On');
    error_reporting(E_ALL);
    session_start();
    if(!isset($_SESSION["username"]))
        header("Location: ../error.php");
    $oldUsername = $_SESSION['username'];
    $webSite = filter_var(htmlspecialchars(trim($_POST['webIn'])), FILTER_SANITIZE_STRING);
    $name = filter_var(htmlspecialchars(trim($_POST['nameIn'])), FILTER_SANITIZE_STRING);
    $surname = filter_var(htmlspecialchars(trim($_POST['surnameIn'])), FILTER_SANITIZE_STRING);
    $username = filter_var(htmlspecialchars(trim($_POST['usernameIn'])), FILTER_SANITIZE_STRING);
    $twitter = filter_var(htmlspecialchars(trim($_POST['twitterIn'])), FILTER_SANITIZE_STRING);
    $instagram = filter_var(htmlspecialchars(trim($_POST['instagramIn'])), FILTER_SANITIZE_STRING);
    $aboutMe = filter_var(htmlspecialchars(trim($_POST['descrizione'])), FILTER_SANITIZE_STRING);
    $città = filter_var(htmlspecialchars(trim($_POST['cittàIn'])), FILTER_SANITIZE_STRING);
    $facebook = filter_var(htmlspecialchars(trim($_POST['faceIn'])), FILTER_SANITIZE_STRING);
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        $message1 = "KO";
    }
    else $message1 = "OK";
    
    $stmtCheck = $conn->prepare("SELECT Interessi FROM Users WHERE Username=?");
    $stmtCheck->bind_param("s", $oldUsername);
    $stmtCheck->execute();
    $stmtCheck->bind_result($checkBox);
    $stmtCheck->fetch();
    $stmtCheck->close();
    $cont=1;
    $message = "";
    if(isset($_POST['check']))
    {
        include "get_in_array_data_strings.php";
        $var_name_attribute="Name";
        $var_name_table="Tags";
        $var_array_of_all_tags=get_in_array_data_strings($conn, $var_name_attribute, $var_name_table, false);//false per non fare la close su $conn
        if($var_array_of_all_tags)
        {
            $var_checks = $_POST['check'];
            $checkBox_to_insert="";
            foreach($var_checks as $value)
            {
                $var_tmp = filter_var(htmlspecialchars(trim($value)));
                if(in_array($var_tmp,$var_array_of_all_tags))//evito che qulacuno mi mandi valori non giusti.
                    $checkBox_to_insert =$checkBox_to_insert.$var_tmp.",";
            }
        }
        else
        {
            header("Location: ../error.php");
            exit;
        }
    }

    // $facebookRegex = "/(?:https?:\/\/)?(?:www\.)?facebook\.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-\.]*)/";
    // $twitterRegex = "/(?:http:\/\/)?(?:www\.)?twitter\.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-]*)/";
    // $instagramRegex = "/(https?:\/\/www\.)?instagram\.com(\/p\/\w+\/?)/";

    $stmtUser = $conn->prepare("SELECT Username FROM Users WHERE Username=?");
    $stmtUser->bind_param("s", $oldUsername);
    $stmtUser->execute();
    $stmtUser->bind_result($userResult);
    $stmtUser->fetch();
    $stmtUser->close();

    $stmtUser1 = $conn->prepare("SELECT Username FROM Users WHERE Username=?");
    $stmtUser1->bind_param("s", $username);
    $stmtUser1->execute();
    $stmtUser1->bind_result($userResult1);
    $stmtUser1->fetch();
    $stmtUser1->close();

    if(preg_match('@[^\w]@', $surname))
        $message = $message.","."Attenzione hai inserito caratteri speciali nel Cognome<br/>";

    //controllo che il nome non contegna caratteri speciali
    if(preg_match('@[^\w]@', $name) || preg_match('@[0-9]@', $name))
        $message = $message.","."Attenzione hai inserito caratteri speciali o numeri nel Nome<br/>";

    //controllo che l'username non contegna caratteri speciali1
    if(preg_match('@[^\w]@', $username) || preg_match('@[0-9]@', $surname))
        $message = $message.","."Attenzione hai inserito caratteri speciali o numeri nel username<br/>";
    
    if (isset($userResult1) && $userResult1 != $oldUsername)
        $message = $message.","."Attenzione username già presente nel database";

    if ($message1 === "KO") 
        $message = $message.","."Errore connessione";

    // if (!preg_match($facebookRegex, $facebook))
    //     $message = $message.","."Errore nell'inserimento del link di facebook";
    
    // if (!preg_match($twitterRegex, $twitter))
    //     $message = $message.","."Errore nell'inserimento del link di twitter";
    
    // if (!preg_match($instagramRegex, $instagram))
    //     $message = $message.","."Errore nell'inserimento del link di instagram";

    //se tutti i controlli vengono passati allora posso inserire l'utente nel database
    if($message === "")
    {
        $stmtFoto = $conn->prepare("SELECT FlagFoto FROM Users WHERE Username=?");
        $stmtFoto->bind_param("s", $username);
        $stmtFoto->execute();
        $stmtFoto->bind_result($var_flag_foto);
        $stmtFoto->fetch();
        $stmtFoto->close();

        $var_directory = "../ImmaginiCaricate/";
        $var_name_file = basename($_FILES["fileDaCaricare"]["name"]);
        $var_tipo_immagine = strtolower(pathinfo($var_name_file, PATHINFO_EXTENSION));

        removePhoto($var_flag_foto, $var_name_file, $var_directory, $oldUsername);

        if(strlen($var_name_file) > 0)
        {
            $var_flag_foto = 1;
            if($var_tipo_immagine != "jpg" && $var_tipo_immagine != "png" && $var_tipo_immagine != "jpeg")
            {
                $message = $message.","."<h3>Tipo Sbagliato</h3>";
                $var_flag_foto = 0;
            }
            if($_FILES["fileDaCaricare"]["size"] > 1000000)
            {
                $message = $message.","."File troppo grande!!";
                $var_flag_foto = 0;
            }
        }
        if($var_flag_foto === 1)
            uploadPhoto($var_name_file, $var_directory, $username, $var_tipo_immagine);

        if($oldUsername === $username)
        {
            $query = "UPDATE Users SET Name=?, Surname=?, FlagFoto=?, Citta=?, AboutMe=?, linkWebSite=?, Facebook=?, Instagram=?, Twitter=?, Interessi=? WHERE Username=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssissssssss", $name, $surname, $var_flag_foto, $città, $aboutMe, $webSite, $facebook, $instagram, $twitter, $checkBox_to_insert, $userResult);
            if(!$stmt->execute())
            {
                header("Location: ../error.php");
                exit;
            }
            $stmt->close();
            $conn->close();
            $message = $message." Modifica andata a buon fine"; 
        }
        else 
        {
            $query = "UPDATE Users SET Username=?, Name=?, Surname=?, FlagFoto=?, Citta=?, AboutMe=?, linkWebSite=?, Facebook=?, Instagram=?, Twitter=?, Interessi=? WHERE Username=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssissssssss",$username, $name, $surname, $var_flag_foto, $città, $aboutMe, $webSite, $facebook, $instagram, $twitter, $checkBox, $userResult);
            if ($var_name_file === "")
            {
                $arrayType = array("jpg", "png", "jpeg");
                for ($i=0; $i < 3; $i++)
                {
                    if(file_exists($var_directory.$oldUsername.".".$arrayType[$i]))
                    {
                        if(rename($var_directory.$oldUsername.".".$arrayType[$i], $var_directory.$username.".".$arrayType[$i]))
                        {
                            $var_flag_foto = 1;
                            $message = $message.","."Nome aggiornato con successo";
                        }
                    }
                }
            }
            if(!$stmt->execute())
            {
                header("Location: ../error.php");
                exit;
            }
            $_SESSION['username'] = $username;
            if ($var_name_file === "")
            {
                $arrayType = array("jpg", "png", "jpeg");
                for ($i=0; $i < 3; $i++)
                {
                    if(file_exists($var_directory.$oldUsername.".".$arrayType[$i]))
                    {
                        if(rename($var_directory.$oldUsername.".".$arrayType[$i], $var_directory.$username.".".$arrayType[$i]))
                        {
                            $message = $message.","."Nome aggiornato con successo";
                        }
                    }
                }
            }
            $stmt->close();
            $conn->close();
            $message = $message.","."Nome aggiornato con successo";
        }
    }
    
    function removePhoto($var_flag_foto, $var_name_file, $var_directory, $oldUsername)
    {
        if($var_flag_foto === 1 && isset($var_name_file) && strlen($var_name_file)>0)
        {
            $arrayType = array("jpg", "png", "jpeg");
            for ($i=0; $i < 3; $i++)
            {
                if(file_exists($var_directory.$oldUsername.".".$arrayType[$i])){
                    unlink($var_directory.$oldUsername.".".$arrayType[$i]);
                    break;
                }
            }
        }
    }

    function uploadPhoto($var_name_file, $var_directory, $username, $var_tipo_immagine)
    {
        if(strlen($var_name_file) > 0)
        {
            $var_complete_path_new_image = $var_directory.$username.".".$var_tipo_immagine;
            if(file_exists($var_complete_path_new_image))
            {
                if(unlink($var_complete_path_new_image))
                    echo "immagine rimossa con successo";
            }
            
            if(!move_uploaded_file($_FILES["fileDaCaricare"]["tmp_name"], $var_complete_path_new_image))
            {
                header("Location: ../error.php");
                exit;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <title></title>
	<meta name ="homepage" content ="homepage here" />
	<meta name ="" content ="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../HomepageStyle.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg2">
    
    <div class="Data_div">
    <?php
		echo "<label class='userPresent'><b>$message</b></label><br>";
        header( "refresh:5;url=../HomepagePersonale.php" );
        echo "<a class='signIn' href='../HomepagePersonale.php'>Clicca qui per tornare alla homepage(se il tuo browser non supporta il reindirizzamento automatico)</a>";
    ?>
	</div>
	
</body>
</html>

