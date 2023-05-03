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
    public function index(CategorieRepository $categorieRepository){
        $cat = $categorieRepository->findAll();
        $li = "";
        // foreach($cat as $c){
        //     $li2 = "";
        //     foreach($c->getSousCategories() as $s){
        //         dump($c, $s);
        //         $li2 .= '<li class="nav-item">
        //         <a class="nav-link" href="#">' . $s->getTitre() . '</a>
        //       </li>';
        //     }
        //     $li .= '<li class="nav-item dropdown">
        //     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">'
        //     . $c-> getTitre() . 
        //     '</a>
        //     <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        //       <li><a class="dropdown-item" href="#">' . $li2 . '</a></li>
        //     </ul>
        //   </li>';
        // }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
    public function getCategories(CategorieRepository $categorieRepository){
        $cat = $categorieRepository->findAll();
        $li = "";
        foreach($cat as $c){
        //    $li .= $c->getTitre();

        if(count($c->getSousCategories()) > 0){ 
            $li .= '<li class="nav-button nav-b"><a class="nav-link" href="#" id="' . $c->getTitre() . '">' . $c->getTitre() . ' <i class="fa-solid fa-caret-down"></i></a>
            <ul class="dropd-ul" id="dropd-ul-' . $c->getId() . '">';
           foreach($c->getSousCategories() as $s){
            $li .= '<li class="py-2"><a class="dropd-li" id="dropd-li-' . $c->getId() . '" href="/annonce/' . $s->getTitre() . '"), {id: ' . $s->getTitre() . ' }}}" id="' . $s->getTitre() . '">' . $s->getTitre() . '</a></li>';          
           }
           $li .= '</ul></li>';
           }else{
            $li .= '<li class="nav-item">
            <a class="nav-link nav-b" href="#" id="' . $c->getTitre() . '">' . $c->getTitre() . '</a>
        </li>';
           }
            
        };
        return new Response($li);
    }
}
