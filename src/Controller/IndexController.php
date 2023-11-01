<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    #[Route('report', name: 'recieve_report', methods: ['POST'])]
    public function reports(): JsonResponse
    {

        return $this->json(
            [
            'message' => 'hello'
            ]
        );

    }
}
