<?php
require_once 'app/Models/Mail.php';

class MailController
{
    private $pdo;
    private $emailLogModel;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->emailLogModel = new EmailLog($this->pdo);
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
                $data,
                $this->emailLogModel,

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
                $data,
                $this->emailLogModel
            );

            return $mail->send();
        }

        return false;
    }

    // reset password mail
    public function sendResetPasswordMail($email, $token)
    {
        $appUrl = getenv('APP_URL')  ?? 'http://localhost';
        $data = [
            'resetLink' => "$appUrl/?route=reset_password&token=$token"
        ];

        $mail = new Mail(
            $email,
            "Réinitialisation de votre mot de passe",
            'reset_password',
            $data,
            $this->emailLogModel
        );

        return $mail->send();
    }
}
