<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
                    $response .= '<tr style="background : rgba(255, 76, 48, 0.3)"><th scope="row">' . $a->getId() . '</th>
                <td class="col-md-2"><img src="/../img/image/' . $a->getImageName() . '" alt=' .  $a->getImageName() . ' class="img-fluid"></td>
                <td>' . $a->getTitre() . '</td>
                <td>' . $a->getCreatedAt()->format('d-m-Y') . '</td><td></td></tr>';
                };
            };
        return new Response($response);
    }
    /**
     * @Route("/setValid", methods={"POST"})
     */
    public function setValid(Request $request, AnnonceRepository $annonceRepository, EntityManagerInterface $entityManager): Response
    {
        dd($request->request);
        $id = $request->request->get('id');
          
        return new Response($id);
    }
    
    /**
     * @Route("/unSetValid", methods={"POST"})
     */
    public function unSetValid(Request $request, AnnonceRepository $annonceRepository): Response
    {
        $id = $request->request->get('id');
          dd($id);
          
        
          return new RedirectResponse($this->generateUrl('referer'));
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
    /**
     * @Route("/admin-annonce-detail/{id}", name="admin-annonce-detail")
     */
    public function adminAnnonceDetail(AnnonceRepository $annonceRepository, $id): Response
    {
        $annonce = $annonceRepository -> findOneById($id);
        return $this->render('admin_annonce/admin-ann-detail.html.twig', [
            'ann' => $annonce,
        ]);
    }
}
