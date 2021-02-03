<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
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
            'player' => $player
        ]);
    }
}
