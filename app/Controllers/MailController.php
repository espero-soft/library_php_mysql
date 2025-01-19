<?php
require_once 'app/Models/Mail.php';

class MailController
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function sendEmpruntNotification($userId, $livreId)
    {
        $userModel = new User($this->pdo);
        $livreModel = new Livre($this->pdo);

        $user = $userModel->getUserById($userId);
        $livre = $livreModel->getLivreById($livreId);

        if ($user && $livre) {
            $data = [
                'user' => $user,
                'livre' => $livre,
                'dateRetour' => date('d/m/Y', strtotime('+15 days'))
            ];



            $mail = new Mail(
                $user['email'],
                "Confirmation d'emprunt - " . $livre['titre'],
                'emprunt_confirmation',
                $data
            );

            return $mail->send();
        }

        return false;
    }

    // register mail 
    public function sendRegisterMail($userId)
    {
        $userModel = new User($this->pdo);
        $user = $userModel->getUserById($userId);

        if ($user) {
            $data = [
                'user' => $user
            ];

            $mail = new Mail(
                $user['email'],
                "Bienvenue sur notre site",
                'register_confirmation',
                $data
            );

            return $mail->send();
        }

        return false;
    }
}
