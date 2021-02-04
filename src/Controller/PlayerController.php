<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class PlayerController extends AbstractController
{

    /**
     * @Route("/new", name="player_new")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @IsGranted("ROLE_CONTRIBUTOR")
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $manager) : Response
    {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($player);
            $manager->flush();
            $this->addFlash('success', 'Player added in the StatsDatabase');

        }
        return $this->render('player/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/player/{slug}", name="player_show")
     * @param $slug
     * @param PlayerRepository $repo
     * @return Response
     */
    public function show($slug, PlayerRepository $repo): Response
    {
        $player = $repo->findOneBySlug($slug);
        return $this->render('player/show.html.twig', [
            'player' => $player,
        ]);
    }
}
