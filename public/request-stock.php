<?php 

session_start();


require_once __DIR__ . '/../app/handlers/logout.php';
require_once __DIR__ . '/../app/handlers/request-stock.php';

$nav = file_get_contents('./html/template/navbar-admin.html');

$body = file_get_contents('./html/request-stock.html');

$body = str_replace('{navbar_component}', $nav, $body);

echo $body;

?>