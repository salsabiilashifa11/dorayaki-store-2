<?php

session_start();

require_once __DIR__ . '/../app/handlers/logout.php';
require_once __DIR__ . '/../app/handlers/cart.php';
require_once __DIR__ . '/../app/models/Cart.php';

$nav = file_get_contents('./html/template/navbar-user.html');

$body = file_get_contents('./html/cart.html');

$body = str_replace('{navbar_component}', $nav, $body);

$body = str_replace('{js_file}', './js/cart.js', $body);

echo $body;
?>