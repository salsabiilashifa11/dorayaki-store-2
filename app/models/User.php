<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/utils.php';
require_once __DIR__ . '/../config/constants.php';

class User {
  private $table = DB_TABLE_USERS;
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getUserById($id) {
    $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
    $this->db->bind(':id', $id);

    return $this->db->single();
  }

  public function getUserByUsername($username) {
    $this->db->query("SELECT * FROM {$this->table} WHERE username = :username");
    $this->db->bind(':username', $username);

    return $this->db->single();
  }

  public function registerUser($data) {
    if (!isset($data['username']) || !isset($data['email']) || !isset($data['password'])) {
      return false;
    }

    if (!$this->isUsernameValid($data['username'])) {
      return false;
    }


    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $this->db->query("INSERT INTO {$this->table} (username, email, password)
     VALUES (:username, :email, :password)");

    $this->db->bind(':username', $data['username']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);

    $id = $this->db->lastInsertId();

    if (!empty($id)) {
      return $id;
    }

    return false;
  }

  public function getRoleById($id) {
    $this->db->query("SELECT role FROM {$this->table} WHERE id = :id");
    $this->db->bind(':id', $id);

    $result = $this->db->single();
    return $result['role'];
  }

  public function isUsernameValid($username) {
    $regex = "/^[a-zA-Z0-9_]+$/";

    if (!preg_match($regex, $username)) {
      return false;
    }

    $this->db->query("SELECT * FROM {$this->table} WHERE username = :username");
    $this->db->bind(':username', $username);

    if ($this->db->single()) {
      return false;
    }

    return true;
   }

   public function isLoginValid($data) {
     if (!isset($data['username']) || !isset($data['password'])) {
       return false;
     }

     $user = $this->getUserByUsername($data['username']);

     if (!$user) {
       return false;
     }

     if (password_verify($data['password'], $user['password'])) {
       return $user['id'];
     }

     return false;
   }
}

?>