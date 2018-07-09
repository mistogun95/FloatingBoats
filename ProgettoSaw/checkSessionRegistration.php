<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("Location: /Homepage.html");
}
else
    header("Location: /HomepagePersonale.php");
?>