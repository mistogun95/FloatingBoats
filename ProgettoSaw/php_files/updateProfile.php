<?php
    include "../db/mysql_credentials.php";
    session_start();
    if(!isset($_SESSION["username"]))
    {
        header("Location: ../error.php");
        exit;
    }

    function check_data_valid_and_redirect($validSimbol, $string_to_check, $empty=false, $flag_alpa=false)
    {
        $var_mmt = str_replace($validSimbol, '', $string_to_check);
        if($empty && empty($var_mmt))
            return;
        if($flag_alpa)
        {
            if(ctype_alpha($var_mmt))
                return;
        }
        if(ctype_alnum($var_mmt))
            return;
        header("Location: ../error.php");
        exit;
    }

    $username = $_SESSION['username'];
    $webSite = filter_var(htmlspecialchars(trim($_POST['webIn'])), FILTER_SANITIZE_STRING);
    $name = filter_var(htmlspecialchars(trim($_POST['nameIn'])), FILTER_SANITIZE_STRING);
    $surname = filter_var(htmlspecialchars(trim($_POST['surnameIn'])), FILTER_SANITIZE_STRING);
    $twitter = filter_var(htmlspecialchars(trim($_POST['twitterIn'])), FILTER_SANITIZE_STRING);
    $instagram = filter_var(htmlspecialchars(trim($_POST['instagramIn'])), FILTER_SANITIZE_STRING);
    $aboutMe = filter_var(htmlspecialchars(trim($_POST['descrizione'])), FILTER_SANITIZE_STRING);
    $città = filter_var(htmlspecialchars(trim($_POST['cittàIn'])), FILTER_SANITIZE_STRING);
    $facebook = filter_var(htmlspecialchars(trim($_POST['faceIn'])), FILTER_SANITIZE_STRING);

    $aValid = array(' ', '!','?',);
    check_data_valid_and_redirect($aValid, $aboutMe,true);
    $aValid = array(' ');
    check_data_valid_and_redirect($aValid, $name);
    check_data_valid_and_redirect($aValid, $surname);
    check_data_valid_and_redirect($aValid, $città,true);

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        $message1 = "KO";
    }
    else $message1 = "OK";
    
    $stmtCheck = $conn->prepare("SELECT Interessi FROM Users WHERE Username=?");
    $stmtCheck->bind_param("s", $username);
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

    /*if(preg_match('@[^\w]@', $surname) || preg_match('@[0-9]@', $surname))
        $message = $message.","."Attenzione hai inserito caratteri speciali nel Cognome<br/>";

    //controllo che il nome non contegna caratteri speciali
    if(preg_match('@[^\w]@', $name) || preg_match('@[0-9]@', $name))
        $message = $message.","."Attenzione hai inserito caratteri speciali o numeri nel Nome<br/>";*/

    // //controllo che l'username non contegna caratteri speciali1
    // if(preg_match('@[^\w]@', $username))
    //     $message = $message.","."Attenzione hai inserito caratteri speciali o numeri nel username<br/>";

    if ($message1 === "KO") 
        $message = $message.","."Errore connessione";

    //se tutti i controlli vengono passati allora posso inserire l'utente nel database
    if($message === "")
    {
        $stmtFoto = $conn->prepare("SELECT FlagFoto, NameImage FROM Users WHERE Username=?");
        $stmtFoto->bind_param("s", $username);
        $stmtFoto->execute();
        $stmtFoto->bind_result($var_flag_foto_query, $var_name_foto_to_remove);
        $stmtFoto->fetch();
        $stmtFoto->close();

        $var_directory = "../ImmaginiCaricate/";
        $var_name_file = basename($_FILES["fileDaCaricare"]["name"]);
        $var_tipo_immagine = strtolower(pathinfo($var_name_file, PATHINFO_EXTENSION));

        $nameImage = $var_name_foto_to_remove;
        
        $var_flag_foto = 0;
        if(strlen($var_name_file) > 0)
        {
            $var_flag_foto = 1; //flag che indica se il file caricato risulta cariacabile.
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
            if($var_flag_foto === 1)//se supero i controlli sull'immagine caricata
            {
                if($var_flag_foto_query===1)//mi chiedo se precedentemente c'era un immagine -> la elimino
                    removePhoto($var_name_file, $var_directory, $var_name_foto_to_remove);
                $nameImage = $username.".".$var_tipo_immagine;//il nome(+estensione) dell'immagine le aggiorno il base al username + estensione del file caricato.
            }
            else
                if($var_flag_foto_query === 0)//se precedentemente non c'era un immagine flagfoto e il nome della foto saranno rispettivamente 0 e null
                    $nameImage = null;
                else//se precedentemente la foto c'era, allora il nome della foto rimane uguale. e sul db il flag le tengo alto.
                {
                    $var_flag_foto = 1;
                    $var_flag_not_put = 1;//indico alla upload che c'è già un file e quindi di non fare l'upload del nuovo file.
                }
        }
        
        $query = "UPDATE Users SET Name=?, Surname=?, FlagFoto=?, NameImage=?, Citta=?, AboutMe=?, linkWebSite=?, Facebook=?, Instagram=?, Twitter=?, Interessi=? WHERE Username=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssisssssssss", $name, $surname, $var_flag_foto, $nameImage, $città, $aboutMe, $webSite, $facebook, $instagram, $twitter, $checkBox_to_insert, $username);
        if(!$stmt->execute())
        {
            //da TOGLIERE echo
            echo "EXECUTE!!\n";
            header("Location: ../error.php");
            exit;
        }
        $stmt->close();
        $conn->close();
        //se salta il db, non ho ancora caricato l'immagine, quindi partirà quella di default.
        //se invece arrivo qua posso finalmente salvare l'immagine.
        if(!isset($var_flag_not_put) && $var_flag_foto===1)
            uploadPhoto($var_name_file, $var_directory, $nameImage);
        $message = $message." Modifica andata a buon fine";
        
    }
    
    function removePhoto($var_name_file, $var_directory, $nameImage)
    {
        if(isset($var_name_file) && strlen($var_name_file)>0)
        {
            if(file_exists($var_directory.$nameImage)){
                unlink($var_directory.$nameImage);
            }
        }
    }

    function uploadPhoto($var_name_file, $var_directory, $nameImage)
    {
        if(strlen($var_name_file) > 0)
        {
            $var_complete_path_new_image = $var_directory.$nameImage;
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
    <title>Aggiornamento Dati</title>
	<meta name ="homepage" content ="homepage here" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../HomepageStyle.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg">
    
    <div class="Data_div">
    <?php
		echo "<label class='userPresent'><b>$message</b></label><br>";
        header( "refresh:5;url=../HomepagePersonale.php" );
        echo "<a class='signIn' href='../HomepagePersonale.php'>Clicca qui per tornare alla homepage(se il tuo browser non supporta il reindirizzamento automatico)</a>";
    ?>
	</div>
	
</body>
</html>

