<?php

namespace App\Entities;

use App\Entities\Traits\HasTimestamps;
use App\Entities\Traits\Identifiable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Table;

#[Entity, HasLifecycleCallbacks]
#[Table("emails")]
class Email
{
    use Identifiable, HasTimestamps;

    public function __construct(
        #[Column(name: "`to`", type: "string", columnDefinition: "VARCHAR(255) NOT NULL")]
        private string $to,
        #[Column(name: "`subject`", type: "string", columnDefinition: "VARCHAR(255) NOT NULL")]
        private string $subject,
        #[Column(name: "`body`", type: "string", columnDefinition: "VARCHAR(255) NOT NULL")]
        private string $body,
    ) {}

    public function getId(): int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     */
    public function setTo(string $to): void
    {
        $this->to = $to;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }
}