<?php

require_once __DIR__ . "/../../../app/models/Cart.php";
require_once __DIR__ . "/../../../app/models/User.php";
require_once __DIR__ . "/../../../app/utils/cookies.php";
require_once __DIR__ . "/../../../app/utils/utils.php";

if (isset($_POST['order_cart']) && isset($_POST['remove'])) {
  $cart_db = new Cart();
  $user_id = validateAuthCookie($_COOKIE);

  $cart_items = $cart_db->getCartItemsByUserId($user_id);
  $cart_id = $cart_items[$_POST['order_cart']]['id'];

  $result = $cart_db->deleteCartItem($cart_id);
  
  echo $result;
} 

?>