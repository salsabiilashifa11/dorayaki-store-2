<?php

require_once __DIR__ . "/../../../app/models/Cart.php";
require_once __DIR__ . "/../../../app/utils/cookies.php";

if (isset($_POST['product-id-2']) && isset($_POST['order-amount'])) {
    $cart_db = new Cart();
    $user_id = validateAuthCookie($_COOKIE);
    $item_id = $_POST['product-id-2'];
    $item_qty = $_POST['order-amount'];

    $data = array('user_id'=>$user_id, 'item_id'=>$item_id , 'quantity'=>$item_qty);

    if ($cart_db->createCartItem($data)) {
        header("Location: ../../dashboard-user.php");
    }
    else {
        echo "false";
    }
} else {
  echo "Here";
  echo $_POST['product-id-2'];
  echo $_POST['order-amount'];
}

?>