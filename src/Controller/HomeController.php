<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @param PlayerRepository $playerRepository
     * @return Response
     */
    public function index(PlayerRepository $playerRepository): Response
    {

        return $this->render('home.html.twig', [
                'playerGoals' => $playerRepository->countGoal(10),
                'playerKeyPass' => $playerRepository->countKeyPass(10)
            ]
        );
    }
}
