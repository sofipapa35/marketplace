<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\SousCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    public function getCategories(CategorieRepository $categorieRepository)
    {
        $cat = $categorieRepository->findAll();
        $li = "";

        foreach ($cat as $c) {

            if (count($c->getSousCategories()) > 0) {
                $li .= '<div class="ps-5"><button class="btn-nav"><a href="/annonce/Categorie/' . $c->getTitre() . '" id="' . $c->getTitre() . '">' . $c->getTitre() . '</a></button>
                            <div class="dropdown-nav">
                                <button class="btn-nav" style="border-left:1px solid #0d8bf2">
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <div class="dropdown-content-nav">';
                foreach ($c->getSousCategories() as $s) {
                    $li .= '<a href="/annonce/SousCategorie/' . $s->getTitre() . '">' . $s->getTitre() . '</a>';
                }
                $li .= '</div></div>';
            }else{
                $li .= '<div class="mx-5"><button class="btn-nav"><a href="/annonce/Categorie/' . $c->getTitre() . '" id="' . $c->getTitre() . '">' . $c->getTitre() . '</a></button></div>';
            }
            $li .= '</div>';
        }
        return new Response($li);
    }
}
