<?php 

session_start();


require_once __DIR__ . '/../app/handlers/logout.php';
require_once __DIR__ . '/../app/handlers/check-request.php';

$nav = file_get_contents('./html/template/navbar-admin.html');

$body = file_get_contents('./html/check-request.html');

$body = str_replace('{navbar_component}', $nav, $body);

echo $body;

?>