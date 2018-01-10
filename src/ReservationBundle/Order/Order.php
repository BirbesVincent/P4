<?php

namespace ReservationBundle\Order;

use Doctrine\ORM\EntityManager;


class Order {
    protected $em;


    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


}