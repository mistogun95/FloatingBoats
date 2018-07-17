<?php
    $name = $_REQUEST["name"];

    if($name === "")
        $returnName = "";
    else if (preg_match('@[^\w]@', $name))
        $returnName = "KO";
    else
        $returnName = "OK";

    echo $returnName;
?>