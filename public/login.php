<?php 

session_start();

require_once '../app/handlers/login.php';

$body = file_get_contents('./html/login.html');

echo $body;

?>