
<?php

    include "mysql_credentials.php";
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        echo "<script type='text/javascript'>alert('connection error');</script>";
        header("Refresh:0; URL=Homepage.html");
    }
    $stmt = $conn->prepare("INSERT INTO `Tags` (`Name`) VALUES (?)");
    $var_fp_tags = fopen("UserDeploy/tags.txt", "r") or die("Unable to open file names!");
    $stmt->bind_param("s",$var_tmp_tag);
    while(!feof($var_fp_tags)) 
    {
        $var_tmp_tag = trim(fgets($var_fp_tags));
        
        if(!$stmt->execute())
        {
            echo "<script type='text/javascript'>alert('Execute error');</script>";
            header("Refresh:0; URL=Homepage.html");
        }
    }
    fclose($var_fp_tags);
    $stmt->close();
    $conn->close();

?>