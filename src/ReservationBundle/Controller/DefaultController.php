<?php

namespace ReservationBundle\Controller;

use ReservationBundle\Entity\Ticket;
use ReservationBundle\Entity\Command;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ReservationBundle\Form\TicketType;
use ReservationBundle\Form\CommandType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $command = new Command();
        $em = $this->getDoctrine()->getManager();
        $reservationForm = $this->get('form.factory')->create(CommandType::class, $command);

        //if form is submitted
        $reservationForm->handleRequest($request);

        if ($reservationForm->isSubmitted() && $reservationForm->isValid()) {
            $this->tickets = $command->getTickets();
            foreach($this->tickets as $ticket) {
                $ticket->setCommand($command);

                //détermination du prix et type
                if ($ticket->getReduced() === true){
                    $ticket->setPrice(10);
                    $ticket->setType("REDUIT");
                } else {
                    $age = $ticket->getAge();
                    if ($age < 4) {
                        $ticket->setPrice(0);
                        $ticket->setType("GRATUIT");
                    } elseif ($age >= 4 && $age < 12) {
                        $ticket->setPrice(8);
                        $ticket->setType("ENFANT");
                    } elseif ($age >= 60) {
                        $ticket->setPrice(12);
                        $ticket->setType("SENIOR");
                    } else {
                        $ticket->setPrice(16);
                        $ticket->setType("NORMAL");
                    }
                }
                $em->persist($ticket);
            }
            $em->persist($command);
            $request->getSession()->set('command', $command);
            return $this->redirectToRoute('reservation_payment');
        }

        return $this->render('ReservationBundle:Default:index.html.twig', array(
            'form' => $reservationForm->createView()
        ));
    }

    public function paymentAction(Request $request)
    {
        $session = $request->getSession();
        $command = $session->get('command');
        $capacity = $this->get('reservation_capacity');
        if ($capacity->checkMaxCapacity($request) === true)
        {
            $session = $request->getSession();
            $session->getFlashBag()->add('info', 'Nombre de tickets max atteint !');
            return $this->redirectToRoute('reservation_homepage');
        }



        return $this->render('ReservationBundle:Default:payment.html.twig', array(
            'command' => $command
        ));
    }

    public function validationAction(Request $request)
    {
        $command = $request->getSession()->get('command');
        $payment = $this->get('command_payment');
        $payment->sendingPayment($request, $command);


        if (true){
            $mailer = $this->get('send_mail');
            $mailer->send($request);
            $em = $this->getDoctrine()->getManager();
            $em->persist($command);
            $em->flush();


            return $this->render('ReservationBundle:Default:success.html.twig');

        } elseif (false) {
            $request->getSession()->getFlashBag()->add('info', 'Paiement refusé !');
            return $this->redirectToRoute('reservation_homepage');
        }

    }






}
