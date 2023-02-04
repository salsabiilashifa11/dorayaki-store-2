<?php
require_once __DIR__ . "/../../../app/models/Cart.php";
require_once __DIR__ . "/../../../app/utils/cookies.php";

if (isset($_POST['checkout'])) {
  $cart_db = new Cart();
  $user_id = validateAuthCookie($_COOKIE);

  if ($cart_db->checkoutCartItems($user_id)) {
    header('Location: ../../cart.php');
  } else {
    echo "Error";
  }
}

?>