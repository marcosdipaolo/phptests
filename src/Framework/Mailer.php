<?php

namespace App\Framework;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mailer
{
    public static function send(string $subject, string $mailFrom, string $nameFrom, array $to, string $body): int
    {
        // Create the Transport
        $transport = new Swift_SmtpTransport(getenv('MAIL_HOST'), getenv('MAIL_PORT'));
        $transport->setUsername(getenv('MAIL_USERNAME'));
        $transport->setPassword(getenv('MAIL_PASSWORD'));
        $transport->setEncryption(getenv('MAIL_ENCRYPTION'));
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
        // Create a message
        $message = (new Swift_Message($subject))
            ->setFrom([$mailFrom => $nameFrom])
            ->setTo($to)
            ->setBody($body);
        // Send the message
        return $mailer->send($message);
    }
}
