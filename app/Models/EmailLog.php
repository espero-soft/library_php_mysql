<?php
class EmailLog
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function log($user_id, $email, $subject, $message, $data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO email_logs 
            (user_id, email, subject, message, data) 
            VALUES 
            (:user_id, :email, :subject, :message, :data)
        ");
        return $stmt->execute([
            'user_id' => $user_id,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'data' => json_encode($data)
        ]);
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM email_logs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByUserId($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM email_logs WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM email_logs WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM email_logs WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
