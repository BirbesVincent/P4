<?php

namespace ReservationBundle\Capacity;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\ORM\EntityManager;

class Capacity
{
    private $em;
    private $maxCapacity;

    public function __construct(EntityManager $entityManager, $maxCapacity)
    {
        $this->em = $entityManager;
        $this->maxCapacity = (int) $maxCapacity;
    }

    public function checkMaxCapacity(Request $request)
    {
        $command = $request->getSession()->get("command");
        $dateCommand = $command->getDate();
        $nbCommandTickets = count($command->getTickets());

        //On récupère le nombre de billets déjà achetés
        $ticketsAlreadyOrdered = count($this->em->getRepository('ReservationBundle:Command')->findBy(array('date' => $dateCommand)));
        if ($ticketsAlreadyOrdered + $nbCommandTickets > $this->maxCapacity){
            return true;
        } elseif ($ticketsAlreadyOrdered + $nbCommandTickets < $this->maxCapacity) {
            return false;
        }
    }


}