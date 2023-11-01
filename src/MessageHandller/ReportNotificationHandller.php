<?php

namespace App\MessageHandler;

use App\Message\ReportNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class ReportNotificationHandler
{
    public function __invoke(ReportNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}
