<?php 

require_once __DIR__ . "/../utils/cookies.php";
require_once __DIR__ . "/../utils/session.php";
require_once __DIR__ . "/../models/User.php";

if (isset($_POST['logout'])) {
  removeCookie();
  session_destroy();
  header('Location: login.php');
}

?>