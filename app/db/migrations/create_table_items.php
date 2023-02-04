<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../../config/constants.php';

$db = new Database();

$db->query(
  "CREATE TABLE IF NOT EXISTS " . DB_TABLE_ITEMS .
  "(id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  description TEXT NOT NULL,
  price INTEGER NOT NULL,
  available_qty INTEGER NOT NULL DEFAULT 0,
  sold_qty INTEGER NOT NULL DEFAULT 0,
  img TEXT NOT NULL)"
);

$db->execute();
?>
