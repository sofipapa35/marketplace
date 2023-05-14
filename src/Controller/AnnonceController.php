<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\CategorieRepository;
use App\Repository\SousCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce/Categorie/{titre}", name="parCategory")
     */
    public function parCategory($titre, CategorieRepository $categorieRepository): Response
    {
        $cat = $categorieRepository -> findOneByTitre($titre);
        return $this->render('annonce/par-categorie.html.twig', [
            'cat' => $cat,
        ]);
    }
    /**
     * @Route("/annonce/SousCategorie/{titre}", name="parSousCategory")
     */
    public function parSousCategory($titre, SousCategorieRepository $sousCategorieRepository): Response
    {
        $sous = $sousCategorieRepository -> findOneByTitre($titre);
        
        return $this->render('annonce/par-sousCategorie.html.twig', [
            'sous' => $sous,
        ]);
    }
    /**
     * @Route("/annonce/detail/{id}", name="annonceDetail")
     */
    public function annonceDetail($id, AnnonceRepository $annonceRepository): Response
    {
        $ann = $annonceRepository -> findOneById($id);
        dd($ann);
        
        return $this->render('annonce/details.html.twig', [
            'ann' => $ann,
        ]);
    }
}
