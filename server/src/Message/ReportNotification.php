<?php

namespace App\Message;

final class ReportNotification
{
    /**
     *  --
     *
     * @param string $email the email address
     * @param string $name  name of user
     *
     * @return void
     */
    public function __construct(
        private string $email,
        private string $name,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
