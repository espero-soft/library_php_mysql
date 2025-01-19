<?php
session_start();
require 'config/database.php';
require 'config/controllers.php';



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
  case 'edit_profile':
    $authController->editProfile();
    break;

    // Nouvelle route pour afficher la liste des utilisateurs
  case 'list_users':
    $userController->listUsers();
    break;

    // Nouvelle route pour mettre à jour le rôle d'un utilisateur
  case 'update_role':
    $userController->updateRole();
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
