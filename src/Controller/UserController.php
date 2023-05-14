<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\AnnonceType;
use App\Repository\UserRepository;
use App\Repository\AnnonceRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SousCategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profile(UserRepository $userRepository): Response
    {
        return $this->render('user/profile.html.twig', [
            // 'user' => $user,
        ]);
    }
    /**
     * @Route("/profile/annonce-detail/{id}", name="profile-annonce-detail")
     */
    public function annonceDetail(AnnonceRepository $annonceRepository, $id): Response
    {
        $ann = $annonceRepository->findOneById($id);
        return $this->render('user/profil-ann-detail.html.twig', [
            'ann' => $ann,
        ]);
    }

    /**
     * @Route("/profile/annonce-edit/getSousCategorie", methods={"POST"})
     */
    public function getSousCategorie(Request $request, SousCategorieRepository $SousCategorieRepository): Response
    {
        $cat = $request->request->get('cat');
        $sous = $SousCategorieRepository->findByCategorie($cat);
        $options = "";
        foreach ($sous as $s) {
            $options .= '<option selected value="' . $s->getId() . '">' . $s->getTitre() . '</option>';
        }
        return new Response($options);
    }
    /**
     * @Route("/profile/annonce-edit/{id}", name="profile-annonce-edit")
     */
    public function annonceEdit(Request $request, SousCategorieRepository $sousCategorieRepository, Annonce $id, EntityManagerInterface $entityManager): Response
    {
        $cat = $id->getCategorie();
        $sous = $sousCategorieRepository->findByCategorie($cat);
        // dd($sous);
        $form = $this->createForm(AnnonceType::class, $id);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $data = $request->request;
            $sous_id = $request->request->get('sous');
            $sous = $sousCategorieRepository->findOneById($sous_id);
            $id->setSousCategorie($sous);
            $entityManager->flush();
            $this->addFlash("success", "Vos informations ont bien été mises à jour.");
            // On redirige vers la même page
            return new RedirectResponse($this->generateUrl('profile'));
        }

        return $this->render('user/profil-ann-edit.html.twig', [
            'form' => $form->createView(),
            'sous' => $sous,
            'ann' => $id,
        ]);
    }
    /**
     * @Route("/profile/annonce-delete/{id}", name="profile-annonce-delete")
     */
    public function annonceDelete(Request $request, SousCategorieRepository $sousCategorieRepository, Annonce $id, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($id);
        $entityManager->flush();
        $this->addFlash("success", "Vos informations ont bien été suprimées.");
        // On redirige vers la même page
        return new RedirectResponse($this->generateUrl('profile'));
    }
    /**
     * @Route("/setIsActive", methods={"POST"})
     */
    public function setIsActive(Request $request, AnnonceRepository $annonceRepository, EntityManagerInterface $entityManager): Response
    {

        $annId = $request->request->get('id');
        $ann = $annonceRepository->findOneById($annId);
        $ann->setIsActive(true);
        $entityManager->flush();
        
        return new Response('checked');
    }
    /**
     * @Route("/unSetIsActive", methods={"POST"})
     */
    public function unSetIsActive(Request $request, AnnonceRepository $annonceRepository, EntityManagerInterface $entityManager): Response
    {

        $annId = $request->request->get('id');
        $ann = $annonceRepository->findOneById($annId);
        $ann->setIsActive(false);
        $entityManager->flush();
        
        return new Response('checked');
    }
}
