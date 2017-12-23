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
        $reservationForm = $this->get('form.factory')->create(CommandType::class, $command);

        //if form is submitted
        if($request->isMethod('POST') && $reservationForm->handleRequest($request)->isValid()){






        }

        return $this->render('ReservationBundle:Default:index.html.twig', array(
            'form' => $reservationForm->createView()
        ));


    }
}
