<?php

namespace App\MessageHandler;

use App\Message\OrderReport;
use Mpdf\Mpdf;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class OrderReportHandler
{
    public function __construct(
        private MailerInterface $mailer
    ) {
    }

    private function getRecords(): array
    {

    }

    private function makeHTMLTemplate(array $data): string
    {
    }

    private function createPdf(string $template)
    {
        $pdfMaker = new Mpdf();
        $pdfMaker->Bookmark('Daily report');
        $pdfMaker->WriteHTML($template);
        return $pdfMaker->Output('', 'S');
    }

    private function getMail($pdf)
    {
        return (new Email())
            ->from('hello@example.com')
            ->to('salar.mo.ro@gmail.com')
            ->subject('Report')
            ->html('<h1>Report pdf</h1> <p>Download the attached file</p>')
            ->attach($pdf, 'report.pdf');
    }

    public function __invoke(OrderReport $message): void
    {
        // get database record
        $data = $this->getRecords();

        // prepair html template
        $template = $this->makeHTMLTemplate($data);

        // create pdf
        $pdf = $this->createPdf($template);

        // email it to user
        $email = $this->getMail($pdf);

        $this->mailer->send($email);
    }
}
