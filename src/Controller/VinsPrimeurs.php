<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VinsPrimeurs extends AbstractController{

    /**
     * @Route("/vinsprimeurs", name="vinsprimeurs.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('pages/vinsprimeurs.html.twig', [
            'menu_actif2' => 'VinsPrimeurs'
        ]);
    }

}

?>