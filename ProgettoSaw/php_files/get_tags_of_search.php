<?php
    session_start();
    $array = array("vela", "balneazione");//trim htmlspecialchar ecc da fare
    if(!isset($array))
    {
        //echo "array non definito<br>";
        echo "<script type='text/javascript'>alert('array non definito');</script>";
        header("Refresh:0; URL=Homepage.html");
    }
    $risultato = count($array);
    if($risultato==0)
    {
        //echo "array vuoto<br>";
        echo "<script type='text/javascript'>alert('array vuoto');</script>";
        header("Refresh:0; URL=Homepage.html");
    }
    include "db/mysql_credentials.php";
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    if ($conn->connect_error) {
        echo "<script type='text/javascript'>alert('connection error');</script>";
        header("Refresh:0; URL=Homepage.html");
    }
    else
    {
        $stmt = $conn->prepare("SELECT ID, Titolo FROM Posts WHERE Tag1=? or Tag2=?
                    or Tag3=? or Tag4=? or Tag5=?");
        $stmt->bind_param("sssss",$array[0],$array[0],$array[0],$array[0],$array[0]);
        if(!$stmt->execute())
        {
            echo "<script type='text/javascript'>alert('Execute Error');</script>";
            $stmt->close();
            $conn->close();
            header("Refresh:0; URL=Homepage.html");
        }
        $stmt->bind_result($var_ID, $var_Titolo);
        $stmt->fetch();
        if(isset($var_ID) && isset($var_Titolo) )
        {
            echo $var_ID."---".$var_Titolo;
        }
    }
?>
        
        
        
        