<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\SearchPlayerType;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @param PlayerRepository $playerRepository
     * @param Request $request
     * @return Response
     */
    public function index(PlayerRepository $playerRepository, Request $request): Response
    {

        $form = $this->createForm(SearchPlayerType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $playerSearch = $playerRepository->searchPlayer($search);
        }

        return $this->render('home.html.twig', [
                'playerGoals' => $playerRepository->countGoal(10),
                'playerKeyPass' => $playerRepository->countKeyPass(10),
                'form' => $form->createView(),
            ]
        );
    }
}
