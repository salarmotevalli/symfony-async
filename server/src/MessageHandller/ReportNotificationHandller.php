<?php

namespace App\MessageHandller;

use App\Message\ReportNotification;
use Faker\Factory;
use Mpdf\Mpdf;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
final class ReportNotificationHandller
{
    public function __construct(
        private MailerInterface $mailer
    ) {
    }
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
        $pdfMaker->WriteHTML('<p>' . json_encode($data) . '</p>');
        $pdf = $pdfMaker->Output('', 'S');


        // email it to user
        $email = (new Email())
            ->from('hello@example.com')
            ->to('salar.mo.ro@gmail.com')
            ->subject('Report')
            ->html('<h1>Report pdf</h1> <p>Download the attached file</p>')
            ->attach($pdf, 'report.pdf');

        $this->mailer->send($email);
    }
}
