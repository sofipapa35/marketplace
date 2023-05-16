<?php

namespace App\Controller;

use App\Entity\Relative;
use App\Repository\AnnonceRepository;
use App\Repository\CategorieRepository;
use App\Repository\RelativeRepository;
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
}
