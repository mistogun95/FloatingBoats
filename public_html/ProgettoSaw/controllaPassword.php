<?php
    $password = $_REQUEST["password"];

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if($password === "")
        $returnName = "";
    else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)
        $returnName = "KO";
    else
        $returnName = "OK";

    echo $returnName;
?>