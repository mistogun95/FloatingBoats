<?php
    $name = $_REQUEST["name"];

    if($name === "")
        $returnName = "";
    else if (preg_match('@[^\w]@', $name) || preg_match('@[0-9]@', $name))
        $returnName = "KO";
    else
        $returnName = "OK";

    echo $returnName;
?>