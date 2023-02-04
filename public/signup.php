<?php 

session_start();

require_once '../app/handlers/signup.php';

$body = file_get_contents('./html/signup.html');

echo $body;

?>