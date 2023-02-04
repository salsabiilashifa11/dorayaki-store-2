<?php 

require_once __DIR__ . "../../../../app/models/User.php";

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $user_db = new User();

    if ($user_db->isUsernameValid($username)) {
        echo "true";
    } 
    else {
        echo "false";
    }
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "true";
    } 
    else {
        echo "false";
    }
}

?>