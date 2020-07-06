<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VindexeptionController extends AbstractController{

    /**
     * @Route("/vindexeption", name="vindexeption.index")
     * @return Response
     */
    public function index(): Response
    {
        
        return $this->render('pages/vindexeption.html.twig', [
            'menu_actif' => 'vindexeption'
        ]);
    }

}

?>