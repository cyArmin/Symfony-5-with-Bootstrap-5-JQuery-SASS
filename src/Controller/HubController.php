<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HubController extends AbstractController
{
    /** php 7 | 8 is with '#'
     *   @[Route('/tester', name: 'app_hub')]
     */
    public function index(): Response
    {
        $debug = "DEBUG TEST MOIN";
        return $this->render('hub/hub.html.twig', [
            'debug' => $debug,
        ]);
    }
}
