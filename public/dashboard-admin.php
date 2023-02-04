<?php 

session_start();

require_once '../app/handlers/logout.php';
require_once '../app/handlers/dashboard-admin.php';

$nav = file_get_contents('./html/template/navbar-admin.html');

$body = file_get_contents('./html/dashboard.html');
$body = str_replace('{navbar_component}', $nav, $body);

echo $body;

?>