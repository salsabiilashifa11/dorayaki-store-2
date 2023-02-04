<?php

require_once __DIR__ . '/../../../app/models/Cart.php';
require_once __DIR__ . "/../../../app/models/User.php";
require_once __DIR__ . "/../../../app/utils/cookies.php";

echo getUserCart();

function getUserCart() {
  $cart_db = new Cart();
  $user_id = validateAuthCookie($_COOKIE);
  $cart_items = $cart_db->getCartItemsByUserId($user_id);

  $item_template = file_get_contents(__DIR__ . '/../../html/template/cart-component.html');
  $items = '';
  foreach ($cart_items as $item) {
    $qty = (int) $item['quantity'];
    $price = (int) $item['price'];
    $item_to_add = str_replace('{product-img}', $item['img'], $item_template);
    $item_to_add = str_replace('{product-name}', $item['name'], $item_to_add);
    $item_to_add = str_replace('{product-id}', $item['id'], $item_to_add);
    $item_to_add = str_replace('{product-stock}', $item['available_qty'], $item_to_add);
    $item_to_add = str_replace('{product-amount}', $qty, $item_to_add);
    $item_to_add = str_replace('{price}', $price, $item_to_add);
    $item_to_add = str_replace('{total}', ($qty * $price), $item_to_add);
    $items .= $item_to_add;
  }

  return json_encode([json_encode($cart_items), $items, $cart_items]);
}
?>