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
        'givenName' => $_POST['givenName'],
        'familyName' => $_POST['familyName'],
        'email' => $_POST['email'],
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



  public function editProfile()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /?route=login');
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = [
        'givenName' => $_POST['givenName'],
        'familyName' => $_POST['familyName'],
        'picture' => $_POST['picture'],
        'email' => $_POST['email']
      ];

      if ($this->userModel->updateProfile($_SESSION['user_id'], $data)) {
        $_SESSION['success'] = "Profil mis à jour avec succès";
        header('Location: /?route=profile');
        exit;
      } else {
        $_SESSION['error'] = "Erreur lors de la mise à jour du profil";
      }
    }

    $user = $this->userModel->getUserById($_SESSION['user_id']);
    require 'views/auth/edit_profile.php';
  }



  public function resetPassword()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $token = $_POST['token'];
      $password = $_POST['password'];

      // Vérifier le token
      $user = $this->userModel->findByResetToken($token);
      if (!$user) {
        $_SESSION['error'] = "Token invalide ou expiré";
        return;
      }

      // Mettre à jour le mot de passe
      if ($this->userModel->updatePassword($user['id'], $password)) {
        // Effacer le token
        $this->userModel->clearResetToken($user['id']);

        $_SESSION['success'] = "Mot de passe réinitialisé avec succès";
        header('Location: /?route=login');
        exit;
      } else {
        $_SESSION['error'] = "Erreur lors de la réinitialisation du mot de passe";
      }
    }
    require 'views/auth/reset_password.php';
  }
}
