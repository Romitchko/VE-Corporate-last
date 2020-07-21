<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController { 

    /**
     * @Route("/login", name="login")
     */
    public function login (AuthenticationUtils $authenticationUtils) { /* AuthentificationUtils récupère les erreurs possible d'authentif */
        $error = $authenticationUtils->getLastAuthenticationError(); 
        $lastUsername = $authenticationUtils->getLastUsername(); /* récupère le dernier nom d'user utilisé */
        return $this->render('security/login.html.twig', [ /* rendre page login */
            'last_username' => $lastUsername, /* injection dans la vue du dernier username utilisé */
            'error' => $error /* rendu a la vue des error */
        ]);
    }
}