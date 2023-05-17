<?php

namespace App\Controller;

use App\Form\UserType;
use DateTimeImmutable;
use App\Entity\Adresse;
use App\Entity\Annonce;
use App\Form\AdresseType;
use App\Form\AnnonceType;
use App\Repository\AdresseRepository;
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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request, AdresseRepository $adresseRepository, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        // dd($user);
        $profile_form_user = $this->createForm(UserType::class, $user, ['user' => true]);

        $profile_form_user->handleRequest($request);

        if ($profile_form_user->isSubmitted() && $profile_form_user->isValid()) {
            // dd($request->request->all(), $user->getTelephone());
            $user->setNom($request->request->all()['user']['nom']);
            $user->setPrenom($request->request->all()['user']['prenom']);
            $user->setPseudo($request->request->all()['user']['pseudo']);
            $user->setTelephone($user->getTelephone());
            $entityManager->flush();
            $this->addFlash("success", "Vos informations ont bien été mises à jour.");
            // On redirige vers la même page
            return new RedirectResponse($this->generateUrl('profile'));
        }
        $profile_form_telephone = $this->createForm(UserType::class, $user, ['telephone' => true]);

        $profile_form_telephone->handleRequest($request);
        if ($profile_form_telephone->isSubmitted() && $profile_form_telephone->isValid()) {
            // dd($request->request->all());
            $user->setTelephone($request->request->all()['user']['telephone']);
            $user->setNom($user->getNom());
            $user->setPrenom($user->getPrenom());
            $user->setPseudo($user->getPseudo());
            $user->setEmail($user->getEmail());
            $entityManager->flush();
            $this->addFlash("success", "Vos informations ont bien été mises à jour.");
            // On redirige vers la même page
            return new RedirectResponse($this->generateUrl('profile'));
        }

        $profile_form_password = $this->createForm(UserType::class, $user, ['password' => true]);

        $profile_form_password->handleRequest($request);

        if ($profile_form_password->isSubmitted() && $profile_form_password->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $profile_form_password->get('plainPassword')->getData()
                )
            );
            $entityManager->flush();
            $this->addFlash("success", "Vos informations ont bien été mises à jour.");
            // On redirige vers la même page
            return new RedirectResponse($this->generateUrl('profile'));
        }

        // ------------------------- Adresses Creation -------------------------------------
        $adresse = new Adresse();

        $profile_form_adresse = $this->createForm(AdresseType::class, $adresse);

        $profile_form_adresse->handleRequest($request);

        if ($profile_form_adresse->isSubmitted() && $profile_form_adresse->isValid()) {
            $adresse->setUser($user);
            if (count($user->getAdresse()) == 0) {
                
            $adresse->setPrincipale(true);
            }
            $adresse->setPrincipale(false);
            $entityManager->persist($adresse);
            $entityManager->flush();
            $this->addFlash("success", "Vos informations ont bien été mises à jour.");
            // On redirige vers la même page
            return new RedirectResponse($this->generateUrl('profile'));
        }

        // ------------------------- Adresses Ajoute -------------------------------------
        // dd(count($user->getAdresse()));
        if (count($user->getAdresse()) >= 1) {
            $adresse = $adresseRepository->findBy(['principale' => true, 'user' => $user]);
            $adresse = $adresse[0];
        }
        $profile_form_adresse_true = $this->createForm(AdresseType::class, $adresse);

        $profile_form_adresse_true->handleRequest($request);


        if ($profile_form_adresse_true->isSubmitted() && $profile_form_adresse_true->isValid()) {
            $adresse->setUser($user);
            if ($request->request->all()['adresse']['principale']) {
                $adresse->setPrincipale(true);
                // foreach ($user->getAdresse() as $adresse) {
                //     $adresse->setPrincipale(false);
                // }
            } else {
                // if (count($user->getAdresse()) >= 1) {
                //     $adresse->setPrincipale(false);
                //     $adresse = $adresseRepository->findOneBy(['user' => $user]);
                //     $adresse->setPrincipale(true);
                // } else {
                    $adresse->setPrincipale(true);
                // }
            }
            $entityManager->persist($adresse);
            $entityManager->flush();
            $this->addFlash("success", "Vos informations ont bien été mises à jour.");
            // On redirige vers la même page
            return new RedirectResponse($this->generateUrl('profile'));
        }

        return $this->render('user/profile.html.twig', [
            'formUser' => $profile_form_user->createView(),
            'formTelephone' => $profile_form_telephone->createView(),
            'formPassword' => $profile_form_password->createView(),
            'formAdresse' => $profile_form_adresse->createView(),
            'formAdresseTrue' => $profile_form_adresse_true->createView(),
            'user' => $user,
        ]);
    }
    /**
     * @Route("/profile/getSousCategorie", methods={"POST"})
     * @Route("/profile/annonce-edit/getSousCategorie", methods={"POST"})
     */
    public function getSousCategorie(Request $request, SousCategorieRepository $SousCategorieRepository): Response
    {
        $cat = $request->request->get('cat');
        $sous = $SousCategorieRepository->findByCategorie($cat);
        $options = "<option selected value='{{null}}'></option>";
        foreach ($sous as $s) {
            $options .= '<option value="' . $s->getId() . '">' . $s->getTitre() . '</option>';
        }
        return new Response($options);
    }
    /**
     * @Route("/profile/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, SousCategorieRepository $sousCategorieRepository, EntityManagerInterface $entityManager): Response
    {
        $ann = new Annonce();

        $form = $this->createForm(AnnonceType::class, $ann);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ann->setCreatedAt(new DateTimeImmutable);
            $ann->setIsValid(false);
            $sous_id = $request->request->get('sous');
            $sous = $sousCategorieRepository->findOneById($sous_id);
            $ann->setSousCategorie($sous);
            $ann->setUser($this->getUser());
            $entityManager->flush();
            $this->addFlash("success", "Vos informations ont bien été mises à jour.");
            $entityManager->persist($ann);
            $entityManager->flush();

            return $this->redirectToRoute('profile', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('user/new-annonce.html.twig', [
            'form' => $form->createView(),
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
    public function setIsActive(Request $request, AnnonceRepository $annonceRepository,AdresseRepository $adresseRepository, EntityManagerInterface $entityManager): Response
    {

        $id = $request->request->get('id');
        $name = $request->request->get('name');
        if($name == 'annonce'){
            dd('annonce');
            $ann = $annonceRepository->findOneById($id);
            $ann->setIsActive(true);
        }else if($name == 'adresse'){
            $ad = $adresseRepository->findOneById($id);
            $ad_false = $adresseRepository->findById(['id' => $id]);
            $ad->setPrincipale(true);
        }
        $entityManager->flush();

        return new Response('checked');
    }
    /**
     * @Route("/unSetIsActive", methods={"POST"})
     */
    public function unSetIsActive(Request $request, AnnonceRepository $annonceRepository,AdresseRepository $adresseRepository, EntityManagerInterface $entityManager): Response
    {

        $id = $request->request->get('id');
        $name = $request->request->get('name');
        if($name == 'annonce'){
        $ann = $annonceRepository->findOneById($id);
        $ann->setIsActive(false);
    }else if($name == 'adresse'){
        $ad = $adresseRepository->findOneById($id);
        $ad->setPrincipale(false);
    }
        $entityManager->flush();

        return new Response('checked');
    }
}
