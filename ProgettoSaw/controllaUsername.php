<?php
    include "db/mysql_credentials.php";
    $username = $_REQUEST["username"];
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
    $stmtUser = $conn->prepare("SELECT Username FROM Users WHERE Username=?");
    $stmtUser->bind_param("s", $username);
    $stmtUser->execute();
    $stmtUser->bind_result($userResult);
    $stmtUser->fetch();
   
    if($username === "")
        $returnName = "";
    else if (preg_match('@[^\w]@', $username))
        $returnName = "KO";
    else if(isset($userResult))
        $returnName = "UserPresente";
    else
        $returnName = "OK";

    echo $returnName;
?>