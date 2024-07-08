<?php
require ($_SERVER['DOCUMENT_ROOT']."/DE/conn.php");
$_SESSION =[];
session_unset();
session_destroy();
header("Location:/DE/login/login.php");
?>