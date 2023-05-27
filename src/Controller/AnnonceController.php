<?php

namespace App\Controller;

use App\Entity\Relative;
use App\Repository\AnnonceRepository;
use App\Repository\RelativeRepository;
use App\Repository\CategorieRepository;
use App\Repository\SousCategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce/Categorie/{titre}", name="parCategory")
     */
    public function parCategory($titre, CategorieRepository $categorieRepository): Response
    {
        $cat = $categorieRepository->findOneByTitre($titre);
        return $this->render('annonce/par-categorie.html.twig', [
            'cat' => $cat,
        ]);
    }
    /**
     * @Route("/annonce/SousCategorie/{titre}", name="parSousCategory")
     */
    public function parSousCategory($titre, SousCategorieRepository $sousCategorieRepository): Response
    {
        $sous = $sousCategorieRepository->findOneByTitre($titre);

        return $this->render('annonce/par-sousCategorie.html.twig', [
            'sous' => $sous,
        ]);
    }
    /**
     * @Route("/annonce/detail/{id}", name="annonceDetail")
     */
    public function annonceDetail($id, AnnonceRepository $annonceRepository, RelativeRepository $relativeRepository): Response
    {
        $ann = $annonceRepository->findOneById($id);
        $ann_id = $ann->getId();
        $rel1 = $relativeRepository->findByCle1($ann_id);
        $rel2 = $relativeRepository->findByCle2($ann_id);
        $relatives = [];
        foreach ($rel1 as $r1) {
            $relatives[] = [
                'id' => $r1->getCle2()->getId(),
                'titre' => $r1->getCle2()->getTitre(),
                'imageName' => $r1->getCle2()->getImageName()
            ];
        }
        foreach ($rel2 as $r2) {
            $relatives[] = [
                'id' => $r2->getCle1()->getId(),
                'titre' => $r2->getCle1()->getTitre(),
                'imageName' => $r2->getCle1()->getImageName()
            ];
        }
        return $this->render('annonce/details.html.twig', [
            'ann' => $ann,
            'relatives' => $relatives,
        ]);
    }
    /**
     * @Route("/search", methods={"POST"})
     */
    public function search(Request $request, AnnonceRepository $annonceRepository): Response
    {
        $value = $request->request->all()['value'];
        $name = $request->request->all()['name'];
        if($name == 'searchId'){
            $annonces = $annonceRepository->getSearchId($value);
        }elseif($name == 'searchTitre'){
            $annonces = $annonceRepository->getSearchTitre($value);
        }elseif($name == 'searchDate'){
            $annonces = $annonceRepository->getSearchDate($value);
        }
        if (!$annonces) {
            $response = "L'annonce n'existe pas";
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
}
