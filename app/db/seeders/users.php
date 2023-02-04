<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../../config/constants.php';

$db = new Database();

$db->query("INSERT INTO " . DB_TABLE_USERS . " (username, email, password, role)
 VALUES (:username, :email, :password, :role)");

$db->bind(':username', 'admin');
$db->bind(':password', password_hash('admin', PASSWORD_DEFAULT));
$db->bind(':email', 'admin@gmail.com');
$db->bind(':role', 'admin');

$db->execute();

$db->bind(':username', 'user');
$db->bind(':password', password_hash('user', PASSWORD_DEFAULT));
$db->bind(':email', 'user@gmail.com');
$db->bind(':role', 'user');

$db->execute();

?>