<?php

namespace App\MessageHandller;

use App\Message\ReportNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class ReportNotificationHandller
{
    public function __invoke(ReportNotification $message)
    {
        // get database record


        // convert to pdf
        // email it to user
    }
}
