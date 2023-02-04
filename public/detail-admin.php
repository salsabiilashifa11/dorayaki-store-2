<?php 

session_start();

require_once __DIR__ . '/../app/handlers/logout.php';
require_once __DIR__ . '/../app/handlers/detail-admin.php';
require_once __DIR__ . '/../app/models/Item.php';

$nav = file_get_contents('./html/template/navbar-admin.html');

$item_db = new Item();

$item_id = 1;
if (isset($_GET['item_id'])) {
  $item_id = $_GET['item_id'];
}


// Query to DB
$item = $item_db->getItemById($item_id);

$body = file_get_contents('./html/detail-admin.html');
$body = str_replace('{product-img}', $item['img'], $body);
$body = str_replace('{product-name}', $item['name'], $body);
$body = str_replace('{items-sold}', $item['sold_qty'], $body);
$body = str_replace('{product-price}', $item['price'], $body);
$body = str_replace('{item-stock}', $item['available_qty'], $body);

$availability = '';
if ($item['available_qty'] > 0) {
  $availability = 'Available';
} else {
  $availability = 'Out of Stock';
}

$body = str_replace('{product-availability}', $availability, $body);
$body = str_replace('{product-id}', $item['id'], $body);
$body = str_replace('{product-desc}', $item['description'], $body);


$body = str_replace('{navbar_component}', $nav, $body);

echo $body;

?>