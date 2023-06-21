<?php

require 'vendor/autoload.php';

use EmailSandbox\Email;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$PHPMailer = new PHPMailer();
$PHPMailerException = new Exception();
$mail = new Email($PHPMailer);

$params = [
    'host' => getenv('SMTP_HOST'),
    'username' => getenv('SMTP_USERNAME'),
    'password' => getenv('SMTP_PASSWORD'),
    'secure' => getenv('SMTP_SECURE'),
    'port' => getenv('SMTP_PORT'),
    'charset' => getenv('CHARSET'),
    'email_from_address' => 'danielrodrigues-ti@hotmail.com',
    'email_from_name' => 'Email pessoal',
    'recipient_address' => 'daniel.lima@infracommerce.com.br',
    'recipient_name' => 'Email do trabalho',
    'subject' => 'Teste de envio de email',
    'body' => 'Estou enviando este email a partir do meu <b>endereço pessoal</b>',
    'alt_body' => 'Estou enviando este email a partir do meu endereço pessoal',
    'attachment_path' => null,
    'attachment_name' => null
];

$mail->sendEmail($params);
