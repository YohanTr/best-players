<?php

namespace App\Controller;

use App\Repository\ClubRepository;
use GuzzleHttp\Client;
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

    /**
     * @Route ("/teams", name="club_teams")
     */
    public function getTeams()
    {

        $client = new Client();

        $uri = 'https://api-football-v1.p.rapidapi.com/v2/teams/team/33';
        $header = array('headers' => array('api-football-v1.p.rapidapi.com' => 'b41532b8a4msh3ecbb82b0c9abedp1cf413jsn5e93690ad270'));
        $response = $client->get($uri, $header);
        $json = $response->json();
    }
}

