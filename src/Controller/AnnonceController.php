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
        dd($request->getUri());
        $sous = $sousCategorieRepository->findByTitle($title);
dd($sous);
        return $this->render('annonce/par-categorie.html.twig', [
            'categories' => $sous,
        ]);
    }
}
