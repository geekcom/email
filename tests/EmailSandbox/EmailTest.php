<?php

declare(strict_types=1);

namespace EmailSandbox;

use EmailSandbox\Email as Email;
use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    private Email $emailSandBoxInstance;

    public function setUp(): void
    {
        $phpMailerInstance = new PHPMailer();
        $this->emailSandBoxInstance = new Email($phpMailerInstance);
    }

    /** @test */
    public function constructor()
    {
        $this->assertInstanceOf(Email::class, $this->emailSandBoxInstance);
    }
}
