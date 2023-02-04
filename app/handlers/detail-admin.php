<?php

require_once __DIR__ . '/../utils/cookies.php';
require_once __DIR__ . '/../utils/session.php';
require_once __DIR__ . '/../models/User.php';

// Validate login session
$id = validateAuthCookie($_COOKIE);
if (!validateLoginSession() && !$id) {
  header('Location: login.php');
  exit;
}

// Validate role
$user = new User();
$role = $user->getRoleById($id);

if ($role === 'user') {
  header('Location: dashboard-user.php');
}

if (isset($_POST['delete-btn'])) {
  header('Location: dashboard-admin.php');
}

$url_components = parse_url($_SERVER['REQUEST_URI']);

// Use parse_str() function to parse the
// string passed via URL
parse_str($url_components['query'], $params);

if (isset($_POST['edit-detail-btn'])) {
  header("Location: edit-variant.php?item_id=" . $params['item_id']);
}

if (isset($_POST['request-stock-btn'])) {
  header("Location: request-stock.php?item_id=" . $params['item_id']);
}
?>