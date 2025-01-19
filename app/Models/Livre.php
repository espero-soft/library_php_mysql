<?php
class Livre
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getAll()
  {
    $query = $this->pdo->query("SELECT * FROM livres");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getAvailableBooks()
  {
    $query = $this->pdo->query("
      SELECT * FROM livres 
      WHERE id NOT IN (SELECT livre_id FROM emprunts)
    ");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
  public function create($data)
  {
    $stmt = $this->pdo->prepare("INSERT INTO livres (titre, auteur, annee, isbn) VALUES (:titre, :auteur, :annee, :isbn)");
    return $stmt->execute($data);
  }

  public function update($id, $data)
  {
    $data['id'] = $id;
    $stmt = $this->pdo->prepare("UPDATE livres SET titre = :titre, auteur = :auteur, annee = :annee, isbn = :isbn WHERE id = :id");
    return $stmt->execute($data);
  }

  public function delete($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM livres WHERE id = :id");
    return $stmt->execute(['id' => $id]);
  }

  //getLivreById
  public function getLivreById($id)
  {
    $stmt = $this->pdo->prepare("
          SELECT * FROM livres WHERE id = :id
        ");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
