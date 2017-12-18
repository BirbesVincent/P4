<?php

namespace ReservationBundle\Controller;

use ReservationBundle\Entity\Ticket;
use ReservationBundle\Entity\Command;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ReservationBundle\Form\TicketType;
use ReservationBundle\Form\CommandType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /*
        $ticket = new Ticket();
        $form = $this->get('form.factory')->create(TicketType::class, $ticket);
        return $this->render('ReservationBundle:Default:index.html.twig', array(
            'form' => $form->createView()
        ));
        */

        $command = new Command();
        $form = $this->get('form.factory')->create(CommandType::class, $command);
        return $this->render('ReservationBundle:Default:index.html.twig', array(
            'form' => $form->createView()
        ));


    }
}
