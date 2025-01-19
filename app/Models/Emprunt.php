<?php
    class Emprunt {
      private $pdo;

      public function __construct($pdo) {
        $this->pdo = $pdo;
      }

      public function emprunterLivre($livreId, $userId) {
        $dateEmprunt = date('Y-m-d');
        $dateRetour = date('Y-m-d', strtotime('+15 days'));

        $stmt = $this->pdo->prepare("
          INSERT INTO emprunts (livre_id, user_id, date_emprunt, date_retour)
          VALUES (:livre_id, :user_id, :date_emprunt, :date_retour)
        ");

        return $stmt->execute([
          'livre_id' => $livreId,
          'user_id' => $userId,
          'date_emprunt' => $dateEmprunt,
          'date_retour' => $dateRetour
        ]);
      }

      public function getEmpruntsUtilisateur($userId) {
        $stmt = $this->pdo->prepare("
          SELECT livres.*, emprunts.date_emprunt, emprunts.date_retour 
          FROM emprunts
          JOIN livres ON emprunts.livre_id = livres.id
          WHERE emprunts.user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      public function verifierDisponibilite($livreId) {
        $stmt = $this->pdo->prepare("
          SELECT COUNT(*) as count 
          FROM emprunts 
          WHERE livre_id = :livre_id AND date_retour > NOW()
        ");
        $stmt->execute(['livre_id' => $livreId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] == 0;
      }
    }
