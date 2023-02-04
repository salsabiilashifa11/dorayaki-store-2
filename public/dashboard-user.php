<?php 

session_start();

require_once '../app/handlers/logout.php';
require_once '../app/handlers/dashboard-user.php';

$nav = file_get_contents('./html/template/navbar-user.html');

$body = file_get_contents('./html/dashboard.html');
$body = str_replace('{navbar_component}', $nav, $body);

echo $body;

?>