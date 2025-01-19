<?php
require_once  'app/Controllers/MailController.php';


class Emprunt
{
  private $pdo;
  private $mailController;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
    $this->mailController = new MailController($pdo);
  }



  public function getEmpruntsUtilisateur($userId)
  {
    $stmt = $this->pdo->prepare("
          SELECT livres.*, emprunts.date_emprunt, emprunts.date_retour 
          FROM emprunts
          JOIN livres ON emprunts.livre_id = livres.id
          WHERE emprunts.user_id = :user_id
        ");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function verifierDisponibilite($livreId)
  {
    $stmt = $this->pdo->prepare("
          SELECT COUNT(*) as count 
          FROM emprunts 
          WHERE livre_id = :livre_id AND date_retour > NOW()
        ");
    $stmt->execute(['livre_id' => $livreId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] == 0;
  }



  public function emprunterLivre($livreId, $userId)
  {
    $dateEmprunt = date('Y-m-d');
    $dateRetour = date('Y-m-d', strtotime('+15 days'));

    $stmt = $this->pdo->prepare("
      INSERT INTO emprunts (livre_id, user_id, date_emprunt, date_retour)
      VALUES (:livre_id, :user_id, :date_emprunt, :date_retour)
    ");

    $success = $stmt->execute([
      'livre_id' => $livreId,
      'user_id' => $userId,
      'date_emprunt' => $dateEmprunt,
      'date_retour' => $dateRetour
    ]);

    if ($success) {
      $this->mailController->sendEmpruntNotification($userId, $livreId);
    }

    return $success;
  }



  private function getLivreById($livreId)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM livres WHERE id = :id");
    $stmt->execute(['id' => $livreId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  private function getUserById($userId)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  private function createEmailContent($livre, $user)
  {
    $content = "Bonjour " . $user['givenName'] . " " . $user['familyName'] . ",\n\n";
    $content .= "Vous avez emprunté le livre suivant :\n\n";
    $content .= "Titre : " . $livre['titre'] . "\n";
    $content .= "Auteur : " . $livre['auteur'] . "\n";
    $content .= "Date de retour prévue : " . date('d/m/Y', strtotime('+15 days')) . "\n\n";
    $content .= "Merci de votre confiance.\n\n";
    $content .= "Cordialement,\nLa bibliothèque";

    return $content;
  }

  private function getEmailHeaders()
  {
    $headers = "From: bibliotheque@example.com\r\n";
    $headers .= "Reply-To: bibliotheque@example.com\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    return $headers;
  }
}
