
<?php

    include "mysql_credentials.php";
    $con = mysqli_connect($mysql_server, $mysql_user, $mysql_pass, $mysql_db) or die ("Errore Connessione al Database");
    $query = "INSERT INTO `Users` (`Username`, `Name`, `Surname`, `Password`) VALUES
    ('zio', 'Carlini', 'rossi', 'a810368ec47867e1c68e2d02a9293a2c04cd314c'),
    ('pio', 'aldo', 'papu', 'a810368ec47867e1c68e2d02a9293a2c04cd314c'),
    ('kaio', 'jhony', 'Mirabelli', 'a810368ec47867e1c68e2d02a9293a2c04cd314c'),
    ('pluto', 'rostico', 'abram', 'a810368ec47867e1c68e2d02a9293a2c04cd314c'),
    ('mistico', 'informelli', 'clinton', 'a810368ec47867e1c68e2d02a9293a2c04cd314c'),
    ('kaput', 'cof', 'Tok', 'a810368ec47867e1c68e2d02a9293a2c04cd314c'),
    ('papu', 'scotti', 'Raul', 'a810368ec47867e1c68e2d02a9293a2c04cd314c'),
    ('cyborg', 'riso', 'nando', 'a810368ec47867e1c68e2d02a9293a2c04cd314c'),
    ('clin', 'marianno', 'Ultrom', 'a810368ec47867e1c68e2d02a9293a2c04cd314c'),
    ('xavier', 'pischello', 'Banfi', 'a810368ec47867e1c68e2d02a9293a2c04cd314c');";

    if(!$con->query($query))
        echo("Errore inserimento dati nel database Users</br>");
    else
        echo("Dati inseriti con successo nella tabella Users</br>");

    mysqli_close($con);

    /****** POPOLAMENTO SERIO DEL DB ****/
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        $conn->close();
        echo "<script type='text/javascript'>alert('connection error');</script>";
        header("Refresh:0; URL=Homepage.html");
    }
    else
    {
        $stmt = $conn->prepare("INSERT INTO `Users` (`Username`, `Name`, `Surname`, `Password`) VALUES(?,?,?,?)");
        $var_array = array();
        $var_fp_tags = fopen("UserDeploy/tags.txt", "r") or die("Unable to open file names!");

        $var_password = "a810368ec47867e1c68e2d02a9293a2c04cd314c";
        $var_fp_names = fopen("UserDeploy/nomi.txt", "r") or die("Unable to open file names!");
        $var_fp_surnames = fopen("UserDeploy/cognomi.txt", "r") or die("Unable to open file surnames!");
        $i =0;
        $stmt->bind_param("ssss",$var_username,$var_name,$var_surname,$var_password);
        while(!feof($var_fp_names)) 
        {
            $var_name = trim(fgets($var_fp_names));
            if(feof($var_fp_surnames))
            {
                fclose($var_fp_surnames);
                $var_fp_surnames = fopen("UserDeploy/cognomi.txt", "r") or die("Unable to open file surnames!");
            }
            $var_surname = trim( fgets($var_fp_surnames));
            $var_username = $var_name.$i;
            
            if(!$stmt->execute())
            {
                echo "<script type='text/javascript'>alert('Execute Error');</script>";
                $stmt->close();
                $conn->close();
                header("Refresh:0; URL=Homepage.html");
            }
            $i++;
            if($i == 10)//ne metto solo 60 per velocizzare i tempi.
                break;
        }
        fclose($var_fp_names);
        fclose($var_fp_surnames);
        echo "sono stati inseriti tutti gli utenti dei files ->".$i."<br>";
        $stmt->close();
        $conn->close();
        
    }
?>