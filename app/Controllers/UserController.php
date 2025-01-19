<?php
class UserController
{
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    // Afficher la liste des utilisateurs
    public function listUsers()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = "Accès refusé : vous devez être administrateur pour accéder à cette page.";
            header('Location: /');
            exit;
        }

        $users = $this->userModel->all();
        require 'views/users/list.php';
    }

    // Mettre à jour le rôle d'un utilisateur
    public function updateRole()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = "Accès refusé : vous devez être administrateur pour effectuer cette action.";
            header('Location: /');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $newRole = $_POST['role'];

            if ($this->userModel->updateRole($userId, $newRole)) {
                $_SESSION['success'] = "Le rôle de l'utilisateur a été mis à jour avec succès.";
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour du rôle.";
            }

            header('Location: /?route=list_users');
            exit;
        }
    }
}
