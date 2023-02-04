<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../../config/constants.php';

$db = new Database();

$db->query(
  "CREATE TABLE IF NOT EXISTS " . DB_TABLE_UNCONFIRMED_REQUESTS .
  "(request_id INTEGER PRIMARY KEY)"
);

$db->execute();
?>
