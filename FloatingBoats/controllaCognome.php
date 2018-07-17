<?php
    $surname = $_REQUEST["surname"];

    if($surname === "")
        $returnName = "";
    else if (preg_match('@[^\w]@', $surname))
        $returnName = "KO";
    else
        $returnName = "OK";

    echo $returnName;
?>