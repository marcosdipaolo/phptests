<?php

namespace App\Models;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mailer
{
    public static function send(string $subject, string $mailFrom, string $nameFrom, array $to, string $body)
    {
        dump(getenv('MAIL_HOST'));
        dump(getenv('MAIL_PORT'));

        // Create the Transport
        $transport = new Swift_SmtpTransport(getenv('MAIL_HOST'), getenv('MAIL_PORT'));
        $transport->setUsername(getenv('MAIL_USERNAME'));
        $transport->setPassword(getenv('MAIL_PASSWORD'));

        dump($transport);
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
        dump($mailer);
        // Create a message
        $message = (new Swift_Message($subject))
            ->setFrom([$mailFrom => $nameFrom])
            ->setTo($to)
            ->setBody($body);
        dump($message);
        // Send the message
        return $mailer->send($message);
    }
}