<?php

namespace App\Controller;

use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{
    /**
     * @Route("/country/{slug}", name="country_show")
     * @param $slug
     * @param CountryRepository $repo
     * @return Response
     */
    public function show($slug, CountryRepository $repo): Response
    {
        $country = $repo->findOneBySlug($slug);
        return $this->render('country/show.html.twig', [
            'country' => $country,
        ]);
    }
}
