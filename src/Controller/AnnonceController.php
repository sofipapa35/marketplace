<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\CategorieRepository;
use App\Repository\RelativeRepository;
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
        $sous = urldecode($sous);
        $sous = $sousCategorieRepository->findByTitre($sous);
        return $this->render('annonce/par-sousCategorie.html.twig', [
            'sousCategorie' => $sous,
        ]);
    }    
    /**
    * @Route("/annonce/details/{id}", name="annonce-detail")
    */
   public function annonceDetais(AnnonceRepository $annonceRepository, RelativeRepository $relativeRepository, int $id): Response
   {
    $ann = $annonceRepository -> findOneBy(['id' => $id]);
    $annId = $ann->getId();
    $rel1 = $relativeRepository ->findBy(['cle1' => $annId]);
    $rel2 = $relativeRepository ->findBy(['cle2' => $annId]);
    // dd($rel1, $rel2);
    $relatives = [];
    if($rel1 != null){
        foreach($rel1 as $r1){
            $relatives[] = $r1 -> getCle2();
        }
    }
    if($rel2 != null){
        foreach($rel2 as $r2){
            $relatives[] = $r2 -> getCle1();
        }
    }
    
       return $this->render('annonce/details.html.twig', [
           'annonce' => $ann,
           'relatives' => $relatives,
       ]);
   }
}
