<?php
session_start();
echo session_status();
if(!isset($_SESSION['name']) && !isset($_SESSION['surname']))
{
    header("Location: ./Login.html");
}
else
    header("Location: ./login.php");
?>
