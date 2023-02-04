<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/utils.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/Item.php';

class Cart {
  private $table = DB_TABLE_CARTS;
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getCartItemsByUserId($user_id) {
    $this->db->query("SELECT c.id, item_id, i.name, img, i.available_qty, quantity, price FROM {$this->table} c
    INNER JOIN users u ON (c.user_id = u.id)
    INNER JOIN items i ON (c.item_id = i.id) 
    WHERE c.user_id = :user_id AND c.is_checkout = 0");

    $this->db->bind(':user_id', (int) $user_id);

    return $this->db->resultSet();

  }

  public function getUserCartCount($user_id) {
    $this->db->query("SELECT * FROM {$this->table} 
    INNER JOIN users u ON (c.user_id = u.id)
    INNER JOIN items i ON (c.item_id = i.id)  
    WHERE user_id = :user_id AND is_checkout = 0");

    $this->db->bind(':user_id', $user_id);

    return $this->db->rowCount();
  }

  public function createCartItem($data) {
    if (empty($data) || !isset($data['user_id']) || !isset($data['item_id']) 
     || !isset($data['quantity'])) {
       return false;
     }

     $this->db->query("INSERT INTO {$this->table} (user_id, item_id, quantity, is_checkout)
      VALUES (:user_id, :item_id, :quantity, :is_checkout)");

      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':item_id', $data['item_id']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->bind(':is_checkout', false);

      $id = $this->db->lastInsertId();

      if (!empty($id)) {
        return $id;
      }
      
      return false;
  }

  public function updateCartItemQty($data) {
    if (empty($data) || !isset($data['id']) || !isset($data['new_qty'])) {
      return false;
    }

    $this->db->query("UPDATE {$this->table} SET quantity = :new_qty 
     WHERE id = :id");
    $this->db->bind(':new_qty', $data['new_qty']);
    $this->db->bind(':id', $data['id']);

    $result = $this->db->execute();
    return $result;
  }

  // public function checkoutCart($data) {
  //   if (empty($data)) {
  //     return false;
  //   }

  //   $in_query = join(",", $data);
  //   $this->db->query("UPDATE {$this->table} SET is_checkout = 1
  //    WHERE id in ($in_query)");

  //   $result = $this->db->execute();

  //   return $result;
  // }

  public function deleteCartItem($id) {
    $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
    $this->db->bind(':id', $id);

    $result = $this->db->execute();

    return $result;
  }

  public function checkoutCartItems($user_id) {
    if (!$user_id) {
      return false;
    }

    $cart_items = $this->getCartItemsByUserId($user_id);

    foreach ($cart_items as $item) {
      $this->db->query("UPDATE items SET sold_qty = sold_qty + :qty, 
        available_qty = available_qty - :qty WHERE id = :id");
      $this->db->bind(':id', $item['item_id']);
      $this->db->bind(':qty', $item['quantity']);
      $this->db->execute();
    }

    $this->db->query("UPDATE {$this->table} SET is_checkout = 1
     WHERE user_id = :id");
    $this->db->bind(':id', $user_id);

    $result = $this->db->execute();
    
    return $result;
  }

}

?>