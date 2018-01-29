<?php

namespace ReservationBundle\SendMail;

use Swift_Mailer;
use Symfony\Component\HttpFoundation\Request;
use Twig_Environment;


class SendMail{

    private $mailer;
    private $twig;

    public function __construct (Swift_Mailer $mailer, Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function send(Request $request){
        $session = $request->getSession();
        $command = $session->get('command');
        $userEmail = $command->getEmail();


        $message = (new \Swift_Message('Mail de confirmation - Musée du Louvre'))
            ->setFrom('museedulouvre@gouv.fr')
            ->setTo($userEmail)
            ->setBody(
                $this->twig->render('validation.html.twig', array('command' => $command), 'text/html'));

        $this->mailer->send($message);
    }


}