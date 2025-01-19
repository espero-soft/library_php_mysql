<?php
class LivreController
{
  private $livreModel;

  public function __construct($livreModel)
  {
    $this->livreModel = $livreModel;
  }

  public function index()
  {
    $livres = $this->livreModel->getAll();
    require 'views/livres/index.php';
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->livreModel->create($_POST);
      header('Location: /');
      exit;
    }
    require 'views/livres/create.php';
  }

  public function edit($id)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->livreModel->update($id, $_POST);
      header('Location: /');
      exit;
    }
    // Récupérer le livre à éditer
    require 'views/livres/edit.php';
  }

  public function delete($id)
  {
    $this->livreModel->delete($id);
    header('Location: /');
    exit;
  }
}
