<?php
//$_SESSION = array();
session_destroy();

//var_dump($_SESSION['alerts']);

header('Location: index.php');
exit;
?>