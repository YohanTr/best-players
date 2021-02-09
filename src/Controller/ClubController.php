<?php

namespace App\Controller;

use App\Repository\ClubRepository;
use http\Client;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
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
        $client = new Client;
        $request = new Request;

        $request->setRequestUrl('https://v3.football.api-sports.io/teams');
        $request->setRequestMethod('GET');
        $request->setHeaders(array(
            'x-rapidapi-host' => 'v3.football.api-sports.io',
            'x-rapidapi-key' => 'd52d47c0b09da4de8adcdf1397935705'
        ));

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        echo $response->getBody();

    }
}
