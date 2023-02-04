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

?>