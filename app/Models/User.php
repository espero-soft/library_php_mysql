<?php
class User
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function register($data)
  {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt = $this->pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
    return $stmt->execute($data);
  }

  public function login($username, $password)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }
    return false;
  }

  public function isAdmin($userId)
  {
    $stmt = $this->pdo->prepare("SELECT role FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user['role'] === 'admin';
  }

  public function changePassword($userId, $password)
  {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
    return $stmt->execute(['id' => $userId, 'password' => $password]);
  }

  // getUserById
  public function getUserById($userId)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function findById($userId)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update($userId, $data)
  {
    $stmt = $this->pdo->prepare("UPDATE users SET username = :username WHERE id = :id");
    return $stmt->execute(['id' => $userId, 'username' => $data['username']]);
  }

  public function delete($userId)
  {
    $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
    return $stmt->execute(['id' => $userId]);
  }

  public function all()
  {
    $stmt = $this->pdo->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
