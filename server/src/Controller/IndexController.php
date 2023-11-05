<?php

namespace App\Controller;

use App\Message\ReportNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index', methods: ['GET'])]
    /**
     * Main logic of app
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->json(
            [
                'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/IndexController.php',
            ]
        );
    }


    /**
     * Create a pdf from database table and email it to user
     *
     * @return JsonResponse
     */
    #[Route('report', name: 'recieve_report', methods: ['POST', 'GET'])]
    public function reports(Request $request, MessageBusInterface $bus): JsonResponse
    {
        $body = (object) json_decode($request->getContent());

        // dispatch report notif
        $bus->dispatch(new ReportNotification($body->email, $body->name));

        return $this->json(
            [
                'message' => 'report sent to ' . $body->name .' email: '. $body->email,
            ]
        );

    }
}