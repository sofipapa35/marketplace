<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\SousCategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce/{titre}", name="annonce")
     */
    public function index(Request $request, SousCategorieRepository $sousCategorieRepository): Response
    {
        $url = explode('/', $request->getUri());
        $sous = $url[count($url) - 1 ];
        $sous = $sousCategorieRepository->findByTitre($sous);
        return $this->render('annonce/par-sousCategorie.html.twig', [
            'sousCategorie' => $sous,
        ]);
    }
}
