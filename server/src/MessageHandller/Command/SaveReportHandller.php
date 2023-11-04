<?php

namespace App\MessageHandller\Command;

use App\Message\Command\SaveReport;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandller]
final class SaveReportHandller
{
    public function __invoke(SaveReport $saveReport)
    {

    }
}
