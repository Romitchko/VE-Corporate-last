<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController{

    public function __construct(\Swift_Mailer $mailer, Environment $renderer) /* Environment permet de générer le mail au format HTML*/
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    

    /**
     * @Route("/contact", name="contact.index")
     * @return Response
     */
    public function index(Request $request, ContactNotification $notification): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', 'Votre message à bien été envoyé.');
            return $this->redirectToRoute('contact.index');
        }
        return $this->render('pages/contact.html.twig', [
            'menu_actif4' => 'contact',
            'form' => $form->createView()
        ]);
    }

}

?>