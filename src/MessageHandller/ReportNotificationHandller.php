<?php

namespace App\MessageHandller;

use App\Message\ReportNotification;
use Faker\Factory;
use Mpdf\Mpdf;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class ReportNotificationHandller
{
    public function __invoke(ReportNotification $message): void
    {
        // get database record
        $data = [];
        $faker = Factory::create();
        foreach (range(0, 9) as $i) {
            $data[] = [
                'name' => $faker->name(),
                'email' => $faker->email(),
                'bio' => $faker->text(255),
            ];
        }

        // convert to pdf
        $pdfMaker = new Mpdf();
        $pdfMaker->Bookmark('Daily report');
        $pdfMaker->WriteHTML('<h1>Report</h1> <p>you can download the pdf file that attached</p>');

        // email it to user
    }
}
