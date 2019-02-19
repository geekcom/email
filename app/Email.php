<?php

declare(strict_types=1);

namespace EmailSandbox;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    private $PHPMailer;
    private $PHPMailerException;

    public function __construct(PHPMailer $PHPMailer, Exception $PHPMailerException)
    {
        $this->PHPMailer = $PHPMailer;
        $this->PHPMailerException = $PHPMailerException;
    }

    public function sendEmail(array $params)
    {
        try {
            $this->configureServerSettings($params);
            $this->configureRecipients($params);
            $this->configureContent($params);
            $this->configureAttachment($params);

            $this->PHPMailer->send();

            dump($this->PHPMailer);
            dump('Message has been sent');

        } catch (Exception $e) {
            dump('Message could not be sent. Mailer Error: ', $this->PHPMailer->ErrorInfo);
        }
    }

    private function configureServerSettings(array $params)
    {
        $this->PHPMailer->SMTPDebug = 2;
        $this->PHPMailer->isSMTP();
        $this->PHPMailer->Host = $params['host'];
        $this->PHPMailer->SMTPAuth = true;
        $this->PHPMailer->Username = $params['username'];
        $this->PHPMailer->Password = $params['password'];
        $this->PHPMailer->SMTPSecure = $params['secure'];
        $this->PHPMailer->Port = $params['port'];
        $this->PHPMailer->CharSet = $params['charset'];
    }

    private function configureRecipients(array $params)
    {
        $this->PHPMailer->setFrom($params['email_from_address'], $params['email_from_name']);
        $this->PHPMailer->addAddress($params['recipient_address'], $params['recipient_name']);
        $this->PHPMailer->addReplyTo(null, null);
        $this->PHPMailer->addCC(null);
        $this->PHPMailer->addBCC(null);
    }

    private function configureContent(array $params)
    {
        $this->PHPMailer->isHTML(true);
        $this->PHPMailer->Subject = $params['subject'];
        $this->PHPMailer->Body = $params['body'];
        $this->PHPMailer->AltBody = $params['alt_body'];
    }

    private function configureAttachment(array $params)
    {
        $this->PHPMailer->addAttachment($params['attachment_path'], $params['attachment_name']);
    }
}