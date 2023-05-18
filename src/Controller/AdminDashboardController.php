<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     * @Route("/dashboard", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin_dashboard/index.html.twig', [
        ]);
    }
}
