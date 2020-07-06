<?php

namespace App\Controller;


use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    
    /**
     * @Route("/", name="Accueil")
     * param PropertyRepository $repository
     * @return Response
     */
    public function index(ArticlesRepository $repository) : Response
    {
        return $this->render('pages/home.html.twig', [
            'menu_actif3' => 'Accueil'
        ]);  
    }

}