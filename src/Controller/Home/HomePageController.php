<?php

namespace App\Controller\Home;

use App\Entity\User;
use App\Mercure\CookieGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController {
    /**
     * @Route("/account", name="account")
     *
     * @param CookieGenerator $cookieGenerator
     */
    public function account(CookieGenerator $cookieGenerator) {
        $response = $this->render('security/account.html.twig');
        $response->headers->set('set-cookie', $cookieGenerator->generate($this->getUser()));
        return $response;
    }

    /**
     * @Route("/", name="home")
     *
     * @param CookieGenerator $cookieGenerator
     */
    public function home(CookieGenerator $cookieGenerator) {
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        $response = $this->render('home/index.html.twig', ['users' => $users]);
        $response->headers->set('set-cookie', $cookieGenerator->generate($this->getUser()));
        return $response;
    }

    /**
     * @Route("/ping/{user}", name="ping", methods={"POST"})
     *
     * @param Publisher $publisher
     * @param User      $user
     */
    public function ping(Publisher $publisher, User $user) {
        $topic = $_ENV['MERCURE_EXTERNAL_URL'].'/ping';
        $data = json_encode([]);
        $target = [$_ENV['MERCURE_EXTERNAL_URL'].'/user/'.$user->getId()];
        $update = new Update($topic, $data, $target ?? []);
        $publisher($update); // Sync
        return $this->redirectToRoute('home');
    }
}
