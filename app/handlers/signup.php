<?php 

require_once __DIR__ . "/../utils/cookies.php";
require_once __DIR__ . "/../utils/session.php";
require_once __DIR__ . "/../models/User.php";

// Dont permit user that already login go here.
$id = validateAuthCookie($_COOKIE);
if (validateLoginSession() && $id) {
  $user = new User();
  $role = $user->getRoleById($id);

  if ($role === 'user') {
    header('Location: dashboard-user.php');
  } else if ($role === 'admin') {
    header('Location: dashboard-admin.php');
  }
  exit;
}

if (isset($_POST["signup"])) {
  $data = array(
    "username"=>$_POST["username"],
    "email"=>$_POST["email"],
    "password"=>$_POST["password"]
  );

  $user = new User();
  $res = $user->registerUser($data);

  if ($res) {
    issueAuthCookie($res);
    issueLoginSession();
    
    $role = $user->getRoleById($res);
    if ($role === 'user') {
      header('Location: dashboard-user.php');
    } else if ($role === 'admin') {
      header('Location: dashboard-admin.php');
    }

  } else {
    $message = "Cannot register the user";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
}

?>