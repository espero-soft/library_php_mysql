<?php
class EmpruntController
{
  private $empruntModel;
  private $livreModel;

  public function __construct($empruntModel, $livreModel)
  {
    $this->empruntModel = $empruntModel;
    $this->livreModel = $livreModel;
  }

  public function emprunter($livreId)
  {
    if (!isset($_SESSION['user_id'])) {
      $_SESSION['error'] = "Vous devez être connecté pour emprunter un livre";
      header('Location: /?route=login');
      exit;
    }

    if ($this->empruntModel->verifierDisponibilite($livreId)) {
      if ($this->empruntModel->emprunterLivre($livreId, $_SESSION['user_id'])) {
        $_SESSION['success'] = "Livre emprunté avec succès pour 15 jours";
      } else {
        $_SESSION['error'] = "Erreur lors de l'emprunt";
      }
    } else {
      $_SESSION['error'] = "Ce livre n'est pas disponible actuellement";
    }

    header('Location: /');
    exit;
  }


  public function mesEmprunts()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /?route=login');
      exit;
    }

    $emprunts = $this->empruntModel->getEmpruntsUtilisateur($_SESSION['user_id']);
    require 'views/emprunts/mes_emprunts.php';
  }
}
