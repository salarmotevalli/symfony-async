<?php

namespace App\MessageHandler;

use App\Entity\Order;
use App\Message\OrderReport;
use Doctrine\ORM\EntityManagerInterface;
use Mpdf\Mpdf;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Kernel;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;
use Twig\Environment;

#[AsMessageHandler]
final class OrderReportHandler
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $environment,
        private EntityManagerInterface $manager,
    ) {
    }

    private function getRecords(): array
    {
        return $this->manager->getRepository(Order::class)->findAll();
    }

    private function makeHTMLTemplate(array $data): string
    {

        return $this->environment-> render('email/order_report.html.twig', ['orders' => $data]);
    }

    private function createPdf(string $template)
    {
        $pdfMaker = new Mpdf();
        $pdfMaker->Bookmark('Daily report');
        $pdfMaker->WriteHTML($template);
        return $pdfMaker->Output('', 'S');
    }

    private function makeMail(string $name, string $email, $pdf)
    {
        return (new Email())
            ->from('hello@example.com')
            ->to($email)
            ->subject('Report')
            ->html('<h1>Report pdf</h1> <h3>Hello' . $name . '</h3> <p>this email contains the orders report pdf file</p>')
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

        $email = $this->makeMail($message->getName(), $message->getEmail(), $pdf);

        $this->mailer->send($email);
    }
}
