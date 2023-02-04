<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../../config/constants.php';

$db = new Database();

$db->query(
  "CREATE TABLE IF NOT EXISTS " . DB_TABLE_USERS .
  "(id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT NOT NULL,
  email TEXT NOT NULL,
  password TEXT NOT NULL,
  role TEXT NOT NULL DEFAULT 'user')"
);

$db->execute();
?>
