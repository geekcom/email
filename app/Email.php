<?php

declare(strict_types=1);

namespace EmailSandbox;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

final class Email
{
    private PHPMailer $PHPMailer;

    public function __construct(PHPMailer $PHPMailer)
    {
        $this->PHPMailer = $PHPMailer;
    }

    /**
     * @param array $params
     * @return void
     */
    public function sendEmail(array $params): void
    {
        try {
            $this->configureServerSettings($params);
            $this->configureRecipients($params);
            $this->configureContent($params);
            $this->configureAttachment($params);

            $this->PHPMailer->send();
        } catch (Exception) {
            throw new $this->PHPMailer->ErrorInfo();
        }
    }

    /**
     * @param array $params
     * @return void
     */
    private function configureServerSettings(array $params): void
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

    /**
     * @param array $params
     * @return void
     * @throws Exception
     */
    private function configureRecipients(array $params): void
    {
        $this->PHPMailer->setFrom($params['email_from_address'], $params['email_from_name']);
        $this->PHPMailer->addAddress($params['recipient_address'], $params['recipient_name']);
        $this->PHPMailer->addReplyTo(null, null);
        $this->PHPMailer->addCC(null);
        $this->PHPMailer->addBCC(null);
    }

    /**
     * @param array $params
     * @return void
     */
    private function configureContent(array $params): void
    {
        $this->PHPMailer->isHTML(true);
        $this->PHPMailer->Subject = $params['subject'];
        $this->PHPMailer->Body = $params['body'];

        if (isset($params['alt_body'])) {
            $this->PHPMailer->AltBody = $params['alt_body'];
        }
    }

    /**
     * @param array $params
     * @return void
     * @throws Exception
     */
    private function configureAttachment(array $params): void
    {
        if (isset($params['attachment_path']) && isset($params['attachment_name'])) {
            $this->PHPMailer->addAttachment(
                $params['attachment_path'],
                $params['attachment_name']
            );
        }
    }
}
