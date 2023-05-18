<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/annonce")
 */

class AdminAnnonceController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_annonce")
     */
    public function index(AnnonceRepository $annonceRepository): Response
    {
        $annonces = $annonceRepository -> findAll();
        return $this->render('admin_annonce/admin_annonce.html.twig', [
            'annonces' => $annonces,
        ]);
    }
}
