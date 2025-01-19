<?php
class AuthController
{
  private $userModel;

  public function __construct($userModel)
  {
    $this->userModel = $userModel;
  }

  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $user = $this->userModel->login($username, $password);
      if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header('Location: /');
        exit;
      } else {
        $_SESSION['error'] = "Identifiants incorrects";
      }
    }
    require 'views/auth/login.php';
  }

  public function logout()
  {
    session_destroy();
    header('Location: /?route=login');
    exit;
  }

  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if ($_POST['password'] !== $_POST['confirm_password']) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas";
        return;
      }

      $data = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'role' => 'user'
      ];

      if ($this->userModel->register($data)) {
        $_SESSION['success'] = "Inscription réussie !";
        header('Location: /?route=login');
        exit;
      } else {
        $_SESSION['error'] = "Erreur lors de l'inscription";
      }
    }
    require 'views/auth/register.php';
  }

  public function forgotPassword()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];

      // Générer un token de réinitialisation
      $token = bin2hex(random_bytes(32));
      $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

      // Enregistrer le token dans la base de données
      $this->userModel->storeResetToken($_POST['email'], $token, $expires);

      // Envoyer l'email (simulé ici)
      $resetLink = "http://localhost/?route=reset_password&token=$token";
      $_SESSION['success'] = "Un email de réinitialisation a été envoyé";
      header('Location: /?route=login');
      exit;
    }
    require 'views/auth/forgot_password.php';
  }

  public function resetPassword()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if ($_POST['password'] !== $_POST['confirm_password']) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas";
        return;
      }

      $token = $_POST['token'];
      $password = $_POST['password'];

      if ($this->userModel->resetPassword($token, $password)) {
        $_SESSION['success'] = "Mot de passe réinitialisé avec succès";
        header('Location: /?route=login');
        exit;
      } else {
        $_SESSION['error'] = "Token invalide ou expiré";
      }
    }
    require 'views/auth/reset_password.php';
  }

  public function profile()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /?route=login');
      exit;
    }

    $user = $this->userModel->getUserById($_SESSION['user_id']);
    require 'views/auth/profile.php';
  }

  public function changePassword()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /?route=login');
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $currentPassword = $_POST['current_password'];
      $newPassword = $_POST['new_password'];
      $confirmPassword = $_POST['confirm_new_password'];

      if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "Les nouveaux mots de passe ne correspondent pas";
        return;
      }

      if ($this->userModel->changePassword(
        $_SESSION['user_id'],
        $currentPassword,
        $newPassword
      )) {
        $_SESSION['success'] = "Mot de passe changé avec succès";
        header('Location: /?route=profile');
        exit;
      } else {
        $_SESSION['error'] = "Mot de passe actuel incorrect";
      }
    }
    require 'views/auth/change_password.php';
  }

  public function checkAuth()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /?route=login');
      exit;
    }
  }
}
