<?php
    include "db/mysql_credentials.php";
    $password = filter_var(htmlspecialchars(trim($_POST['password'])), FILTER_SANITIZE_STRING);
    $name = filter_var(htmlspecialchars(trim($_POST['name'])), FILTER_SANITIZE_STRING);
    $surname = filter_var(htmlspecialchars(trim($_POST['surname'])), FILTER_SANITIZE_STRING);
    $username = filter_var(htmlspecialchars(trim($_POST['username'])), FILTER_SANITIZE_STRING);

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connection_error) {
        $message1 = "KO";
        //die("Connection failed: " . mysqli_connect_error());
    }
    $stmtUser = $conn->prepare("SELECT Username FROM Users WHERE Username=?");
    $stmtUser->bind_param("s", $username);
    $stmtUser->execute();
    $stmtUser->bind_result($userResult);
    $stmtUser->fetch();

    //controllo della password
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)
        //echo("Password non corretta deve avere almeno 8 caratteri e contenere almeno una lettera maiuscola, una minuscola, un numero e un carattere speciale<br/>");
        $message= "Password non corretta deve avere almeno 8 caratteri e contenere almeno una lettera maiuscola, una minuscola, un numero e un carattere speciale<br/>";

    //controllo che il cognome non contenga caratteri speciali
    else if(preg_match('@[^\w]@', $surname))
        //echo("Attenzione hai inserito caratteri speciali nel Cognome<br/>");
        $message = "Attenzione hai inserito caratteri speciali nel Cognome<br/>";

    //controllo che il nome non contegna caratteri speciali
    else if(preg_match('@[^\w]@', $name))
        //echo("Attenzione hai inserito caratteri speciali nel Nome<br/>");
        $message = "Attenzione hai inserito caratteri speciali nel Nome<br/>";

    //controllo che l'username non contegna caratteri speciali
    else if(preg_match('@[^\w]@', $username))
        //echo("Attenzione hai inserito caratteri speciali nel Nome<br/>");
        $message = "Attenzione hai inserito caratteri speciali nel username<br/>";
    else if (isset($userResult))
        $message = "Attenzione username già presente nel database";

    //se tutti i controlli vengono passati allora posso inserire l'utente nel database
    //controllo immagine
    //$conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    else if (/*$conn->connection_error*/ $message1 === "KO") {
        $message = "Errore connessione!! <br/>";
        //die("Connection failed: " . mysqli_connect_error());
    }
    else
    {
        $var_directory = "ImmaginiCaricate/";
        $var_flag_foto = 0;
        $var_name_file = basename($_FILES["fileDaCaricare"]["name"]);
        $var_tipo_immagine = strtolower(pathinfo($var_name_file, PATHINFO_EXTENSION));
        
        if(strlen($var_name_file) > 0)
        {
            $var_flag_foto = 1;
            if($var_tipo_immagine != "jpg" && $var_tipo_immagine != "png" && $var_tipo_immagine != "jpeg")
            {
                echo "<h3>Tipo Sbagliato</h3>";
                $var_flag_image = 0;
            }
            if($_FILES["fileDaCaricare"]["size"] > 1000000)
            {
                echo "File troppo lungo!!";
                $var_flag_image = 0;
            }
        }

        
        $passwordSha1 = sha1($password);
        $stmt = $conn->prepare("INSERT INTO Users (Username, Name, Surname, Password, FlagFoto) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi",$username,$name, $surname, $passwordSha1, $var_flag_foto);
        if(!$stmt->execute())
            $message = "EXECUTE!!! <br/>";
        else
        {
            if(strlen($var_name_file) > 0)
            {
                $var_complete_path_new_image = $var_directory.$username.".".$var_tipo_immagine;
                if(file_exists($var_complete_path_new_image))
                {
                    echo "Error il file Esiste!!!!<br>";
                }
                else
                {
                    if(move_uploaded_file($_FILES["fileDaCaricare"]["tmp_name"], $var_complete_path_new_image))
                        echo "Il file".basename($_FILES["fileDaCaricare"]["name"])." è stato caricato con il nome $surname.$var_tipo_immagine nella cartella -> $var_directory.";
                    else
                        echo "Qualcosa è andato storto.";
                }
            }
            
        }
        //solo di test..
        $message = $message." --- ".$var_flag_foto." --- ".$var_tipo_immagine."La registrazione è andata a buon fine sarai reindirizzato alla homepage tra 5 secondi";

        $stmt->close();
        $conn->close();
    }
    

    echo "<label class='userPresent'><b>$message</b></label><br>";
    header( "refresh:5;url=Homepage.html" );
    echo "<a class='signIn' href='Homepage.html'>Clicca qui per tornare alla homepage(se il tuo browser non supporta il reindirizzamento automatico)</a>";
?>
        
        
        
        