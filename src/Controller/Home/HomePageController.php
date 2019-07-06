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
     */
    public function home(Publisher $publisher) {
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        return $this->render('home/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/ping/{user}", name="ping", methods={"POST"})
     *
     * @param Publisher $publisher
     * @param ?User     $user
     */
    public function ping(Publisher $publisher, ?User $user = null) {
        $topic = 'http://localhost:3000/ping';
        $data = json_encode([]);
        if (!is_null($user)) {
            $target = ['http://monsite.com/ping/user/'.$user->getId()];
        }
        $update = new Update($topic, $data, $target ?? []);
        $publisher($update); // Sync
        return $this->redirectToRoute('home');
    }
}
