<?php

namespace App\Services;

use App\Src\PHPMailer;

define('EMAIL_HOST', getenv('EMAIL_HOST'));
define('EMAIL_USERNAME', getenv('EMAIL_USERNAME'));
define('EMAIL_PASSWORD', getenv('EMAIL_PASSWORD'));
define('EMAIL_PORT', getenv('EMAIL_PORT'));
define('EMAIL_FROM', 'Hyper Computer');

class Email {
    private $mailer;
    private $message = '';

    public function __construct() {
        $this->mailer = new PHPMailer(true);
        // Configurações do servidor
        $this->mailer->isSMTP();
        $this->mailer->Host = EMAIL_HOST; // Defina o servidor SMTP para enviar através dele
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = EMAIL_USERNAME; // SMTP username
        $this->mailer->Password = EMAIL_PASSWORD; // SMTP password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Ative a criptografia TLS
        $this->mailer->Port = EMAIL_PORT; // TCP port para conexão
        $this->mailer->SMTPDebug  = 0;
    }

    public function sendEmail(
        $to,
        $subject,
        array $attachments = [],
        $body = "",
        $from = EMAIL_USERNAME,
        $fromName = EMAIL_FROM
    ) {
        try {
            // Configurações do remetente
            $this->mailer->setFrom($from, $fromName);
            // Adicionar destinatário
            $this->mailer->addAddress($to);
            // Conteúdo do e-mail
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            if($body === "") $body = $this->message;
            $this->mailer->Body    = $body;
            $this->mailer->CharSet = "UTF-8";

            // Anexar arquivos
            foreach ($attachments as $attachment) {
                $this->mailer->addAttachment(dirname(__DIR__) . $attachment);
            }

            // Enviar e-mail
            return $this->mailer->send() ? true : false;
        } catch (\Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    public function loadTemplateMessage($templateFile, $data = [])
    {
        $template = "";

        try {
            $template = file_get_contents($templateFile);
        } catch (\Exception $e) {
            echo "Erro ao tentar carregar template da mensagem!";
            throw $e;
        }

        if(!empty($data) && $template) {
            foreach ($data as $key => $value) {
                $template = str_replace('{' . $key . '}', $value, $template);
            }
        }
        $this->message = $template;
    }
}