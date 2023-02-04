<?php

require_once __DIR__ . "/../../../app/models/Item.php";

if (isset($_GET['item_id'])) {
  echo getItemDetails($_GET['item_id']);
}


function getItemDetails($item_id) {
  $item_db = new Item();
  $item = $item_db->getItemById($item_id);

  $item['availability'] = '';
  if ($item['available_qty'] > 0) {
    $item['availability'] = 'Available';
  } else {
    $item['availability'] = 'Out of Stock';
  }

  return json_encode($item);
}

?>