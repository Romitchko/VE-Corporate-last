<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarteController extends AbstractController{

    /**
     * @Route("/carteinteractive", name="carteinteractive.index")
     * @return Response
     */
    public function index(): Response
    {
        
        return $this->render('pages/carteinteractive.html.twig', [
            'menu_actif' => 'carteinteractive'
        ]);
    }
}

?>