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
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
    public function getCategories(CategorieRepository $categorieRepository){
        $cat = $categorieRepository->findAll();
        $li = "";
        foreach($cat as $c){
            $li2 = "";
            foreach($c->getSousCategories() as $s){
                $li2 .= '<li><a class="dropdown-item" href="#">' . $s->getTitre() . '</a></li>
                <li class="nav-item dropdown">';
            }
            $li .= '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="text-transform: capitalize;" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $c-> getTitre() . '</a>
          <ul class="dropdown-menu" style="text-transform: capitalize;" aria-labelledby="navbarDropdownMenuLink">' . $li2 . '
          </ul>
        </li>'
        ;
        }

        return new Response($li);
    }
}
