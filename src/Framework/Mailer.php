<?php

namespace App\Framework;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mailer
{
    /**
     * @param string $subject
     * @param string $mailFrom
     * @param string $nameFrom
     * @param array $to
     * @param string $body
     * @return int
     */
    public static function send(
        string $subject,
        string $mailFrom,
        string $nameFrom,
        array $to,
        string $body
    ): int
    {
        $transport = new Swift_SmtpTransport(
            getenv('MAIL_HOST'), getenv('MAIL_PORT')
        );
        $transport->setUsername(getenv('MAIL_USERNAME'));
        $transport->setPassword(getenv('MAIL_PASSWORD'));
        $transport->setEncryption(getenv('MAIL_ENCRYPTION'));

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message($subject))
            ->setFrom([$mailFrom => $nameFrom])
            ->setTo($to)
            ->setBody($body);

        return $mailer->send($message);
    }
}
