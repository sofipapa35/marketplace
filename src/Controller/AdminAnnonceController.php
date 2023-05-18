<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    /**
     * @Route("/search", methods="POST")
     */
    public function search(Request $request, AnnonceRepository $annonceRepository): Response
    {
        $value = $request->request->all()['value'];
        $annonces = $annonceRepository -> getSearchValues($value);
        dd($annonces);

        $response = 'ok';
        
        return new Response($response);
    }
}
