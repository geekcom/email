<?php

require 'vendor/autoload.php';

use EmailSandbox\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$PHPMailer = new PHPMailer();
$PHPMailerException = new Exception();
$mail = new Email($PHPMailer, $PHPMailerException);

$params = [
    'host' => getenv('SMTP_HOST'),
    'username' => getenv('SMTP_USERNAME'),
    'password' => getenv('SMTP_PASSWORD'),
    'secure' => getenv('SMTP_SECURE'),
    'port' => getenv('SMTP_PORT'),
    'charset' => getenv('CHARSET'),
    'email_from_address' => 'email_from_address',
    'email_from_name' => 'email_from_name',
    'recipient_address' => 'recipient_address',
    'recipient_name' => 'recipient_name',
    'subject' => 'Here is the subject',
    'body' => 'This is the HTML message body <b>in bold!</b>',
    'alt_body' => 'This is the body in plain text for non-HTML mail clients',
    'attachment_path' => null,
    'attachment_name' => null
];

$mail->sendEmail($params);