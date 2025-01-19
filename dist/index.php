<?php
session_start();
require 'config/database.php';

// Initialisation des modèles
require 'app/Models/Emprunt.php';
$empruntModel = new Emprunt($pdo);

// Initialisation des contrôleurs
require 'app/Controllers/AuthController.php';
require 'app/Controllers/LivreController.php';
require 'app/Controllers/EmpruntController.php';

$authController = new AuthController($userModel);
$livreController = new LivreController($livreModel);
$empruntController = new EmpruntController($empruntModel, $livreModel);

// Routing basique
$route = $_GET['route'] ?? 'home';

switch ($route) {
    // Routes d'authentification
  case 'login':
    $authController->login();
    break;
  case 'logout':
    $authController->logout();
    break;
  case 'register':
    $authController->register();
    break;
  case 'forgot_password':
    $authController->forgotPassword();
    break;
  case 'reset_password':
    $authController->resetPassword();
    break;
  case 'profile':
    $authController->profile();
    break;
  case 'change_password':
    $authController->changePassword();
    break;

    // Routes des livres
  case 'create':
    $livreController->create();
    break;
  case 'edit':
    $livreController->edit($_GET['id']);
    break;
  case 'delete':
    $livreController->delete($_GET['id']);
    break;

    // Routes des emprunts
  case 'emprunter':
    $empruntController->emprunter($_GET['id']);
    break;
  case 'mes-emprunts':
    $empruntController->mesEmprunts();
    break;

    // Route par défaut
  default:
    $livreController->index();
}
