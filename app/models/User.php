<?php

namespace App\models;

use PDO;
use Stag\Auth\Auth;
use Stag\DB\Database;

class User
{
  protected Database $db;

  public function __construct(Database $database)
  {
    $this->db = $database;
  }

  public function createUser(array $user)
  {
    $createUser = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $bindings = [
      ':username' => $user["username"],
      ':email' => $user["email"],
      ':password' => Auth::bcrypt($user["password"]),
    ];

    return $this->db->executeQuery($createUser, $bindings);
  }

  public function getUserByEmail(string $email)
  {
    $getUser = "SELECT * FROM users WHERE email = :email";
    $bindings = [
      ':email' => $email,
    ];

    return $this->db->executeQuery($getUser, $bindings)->fetch(PDO::FETCH_ASSOC);
  }
}
