<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../../config/constants.php';

$db = new Database();

$db->query(
  "CREATE TABLE IF NOT EXISTS " . DB_TABLE_CARTS .
  "(id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER NOT NULL,
  item_id INTEGER NOT NULL,
  quantity INTEGER NOT NULL,
  is_checkout INTEGER NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users (id) on DELETE CASCADE,
  FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE
  )"
);

$db->execute();
?>
