<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LocalesController extends AbstractController
{
    /**
     * @Route("/locales/{locale}", name="locales")
     */
    public function locales($locale, Request $request) /* récupère la langue de la session*/
    {
        // on stock la langue demandée dans la session
        $request->getSession()->set('_locale', $locale);

        // on revient sur la page précedente
        return $this->redirect($request->headers->get('referer'));
    }
}
