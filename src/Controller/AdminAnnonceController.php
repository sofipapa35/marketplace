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
     * @Route("/findNonValid")
     */
    public function findNonValid(Request $request, AnnonceRepository $annonceRepository): Response
    {
            $annonces = $annonceRepository->findByIsValid(false);
            if (!$annonces) {
                $response = "Il n'y a pas des annonces pas validées";
            } else {
                $response = '';
                foreach ($annonces as $a) {
                    $response .= '<tr><th scope="row">' . $a->getId() . '</th>
                <td class="col-md-2"><img src="/../img/image/' . $a->getImageName() . '" alt=' .  $a->getImageName() . ' class="img-fluid"></td>
                <td>' . $a->getTitre() . '</td>
                <td>' . $a->getCreatedAt()->format('d-m-Y') . '</td><td></td></tr>';
                };
            };
        return new Response($response);
    }
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
