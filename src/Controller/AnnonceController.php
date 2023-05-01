<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce", name="annonce")
     */
    public function index(CategorieRepository $categorieRepository): Response
    {
        $cat = $categorieRepository -> findAll();

        return $this->render('annonce/par-categorie.html.twig', [
            'categories' => $cat,
        ]);
    }
}
