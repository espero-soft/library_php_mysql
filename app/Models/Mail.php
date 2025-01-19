<?php
class Mail
{
    private $to;
    private $subject;
    private $template;
    private $data;
    private $headers;

    public function __construct($to, $subject, $template, $data = [])
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->template = $template;
        $this->data = $data;
        $this->headers = $this->getDefaultHeaders();
    }

    public function send()
    {
        $message = $this->renderTemplate();
        $success = mail($this->to, $this->subject, $message, $this->headers);
        $this->logEmail($success, $message);
        return $success;
    }

    private function logEmail($success, $message)
    {
        $logMessage = date('Y-m-d H:i:s') . " - To: {$this->to}, Subject: {$this->subject}, Success: " . ($success ? 'Yes' : 'No') . "\n";
        $logMessage .= "Headers: {$this->headers}\n";
        $logMessage .= "Message: {$message}\n\n";
        file_put_contents('logs/mail.log', $logMessage, FILE_APPEND);
    }

    private function renderTemplate()
    {
        ob_start();
        extract($this->data);
        require "views/emails/{$this->template}.php";
        return ob_get_clean();
    }

    private function getDefaultHeaders()
    {
        $headers = "From: bibliotheque@example.com\r\n";
        $headers .= "Reply-To: bibliotheque@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        return $headers;
    }
}
