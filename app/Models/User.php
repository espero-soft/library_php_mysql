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
    $stmt = $this->pdo->prepare("
      INSERT INTO users 
      (username, password, givenName, familyName, email, role) 
      VALUES 
      (:username, :password, :givenName, :familyName, :email, :role)
    ");
    return $stmt->execute($data);
  }

  public function updateRole($userId, $role)
  {
    $stmt = $this->pdo->prepare("UPDATE users SET role = :role WHERE id = :id");
    return $stmt->execute(['id' => $userId, 'role' => $role]);
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

  public function updateProfile($userId, $data)
  {
    $stmt = $this->pdo->prepare("
      UPDATE users SET
      givenName = :givenName,
      familyName = :familyName,
      picture = :picture,
      email = :email
      WHERE id = :id
    ");
    $data['id'] = $userId;
    return $stmt->execute($data);
  }


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


  public function storeResetToken($email, $token, $expires)
  {
    $stmt = $this->pdo->prepare("
      UPDATE users 
      SET reset_token = :token, 
          reset_token_expires = :expires 
      WHERE email = :email
    ");

    return $stmt->execute([
      'email' => $email,
      'token' => $token,
      'expires' => $expires
    ]);
  }

  public function findByResetToken($token)
  {
    $stmt = $this->pdo->prepare("
      SELECT * FROM users 
      WHERE reset_token = :token 
        AND reset_token_expires > NOW()
    ");
    $stmt->execute(['token' => $token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function clearResetToken($userId)
  {
    $stmt = $this->pdo->prepare("
      UPDATE users 
      SET reset_token = NULL, 
          reset_token_expires = NULL 
      WHERE id = :id
    ");
    return $stmt->execute(['id' => $userId]);
  }
}
