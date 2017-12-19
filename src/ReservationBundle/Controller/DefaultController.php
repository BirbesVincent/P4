<?php

namespace ReservationBundle\Controller;

use ReservationBundle\Entity\Ticket;
use ReservationBundle\Entity\Command;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ReservationBundle\Form\TicketType;
use ReservationBundle\Form\CommandType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $command = new Command();
        $em = $this->getDoctrine()->getManager();
        $form = $this->get('form.factory')->create(CommandType::class, $command);

        return $this->render('ReservationBundle:Default:index.html.twig', array(
            'form' => $form->createView()
        ));


    }
}
