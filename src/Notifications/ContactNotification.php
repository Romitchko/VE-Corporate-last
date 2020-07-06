<?php 
namespace App\Notification;

use Swift_Message;
use Twig\Environment;
use App\Entity\Contact;
use App\Notification\ContactNotification;

 class ContactNotification {
    /**
     * @var \Swift_Mailer
     */
    private $mailer; /* Initialisation des paramètres pour appeller dans Notify */

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer) /* Environment permet de générer le mail au format HTML*/
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify (Contact $contact) { /* permet l'envoi d'email */
        $message = (new \Swift_Message('Message déstiné à Vitis Epicuria depuis Vitis Corporate')) /* new instance swift message */
        ->setFrom($contact->getEmail()) /* adresse de l'user */
        ->setTo('romainb33@outlook.Fr') /* destinataire de l'email */
        ->setReplyTo($contact->getEmail()) /* à qui on répond */
        ->setBody($this->renderer->render('emails/contact.html.twig', [ /* contenu de notre email */
            'contact' => $contact /* renderer twig - on envoie les infos au contact */
        ]), 'text/html');
        $this->mailer->send($message); /* on use le mailer à qui on passe le $message en paramètre */
    }
 }