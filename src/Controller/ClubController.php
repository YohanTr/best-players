<?php

namespace App\Controller;

use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    /**
     * @Route("/club/{slug}", name="club_show")
     * @param $slug
     * @param ClubRepository $repo
     * @return Response
     */
    public function show($slug, ClubRepository $repo): Response
    {
        $club = $repo->findOneBySlug($slug);
        $clubGoals = $repo->bestScorerClub(10);
        return $this->render('club/show.html.twig', [
            'club' => $club,
            'clubGoals' => $clubGoals
        ]);
    }
}
