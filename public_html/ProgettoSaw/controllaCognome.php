<?php
    $surname = $_REQUEST["surname"];

    if($surname === "")
        $returnName = "";
    else if (preg_match('@[^\w]@', $surname) || preg_match('@[0-9]@', $surname))
        $returnName = "KO";
    else
        $returnName = "OK";

    echo $returnName;
?>