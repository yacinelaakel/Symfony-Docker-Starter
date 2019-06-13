<?php

namespace App\Controller\Home;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomePageController.
 *
 * @package App\Controller\Home
 */
class HomePageController extends AbstractController {
    /**
     * @Route("/", name="home")
     *
     * @return Response
     */
    public function index(): Response {
        return $this->render('base.html.twig', []);
    }
}
