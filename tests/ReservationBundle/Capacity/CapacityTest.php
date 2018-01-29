<?php
/**
 * Created by PhpStorm.
 * User: Misthaly
 * Date: 29/01/2018
 * Time: 18:13
 */

namespace Tests\ReservationBundle\Capacity;

use DateTime;
use ReservationBundle\Entity\Command;
use ReservationBundle\Entity\Ticket;
use ReservationBundle\Capacity\Capacity;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class CapacityTest extends WebTestCase
{

    public function hundredTest(Request $request)
    {
        $capacity = $this->get('reservation_capacity');
        $command = new Command();
        $command->setDate(new DateTime());
        $ticket = new Ticket();
        $ticket->setCommand($command);
        $request->getSession()->set('command', $command);
        $res = $capacity->checkMaxCapacity($request);

        $this->assertTrue(false);
    }


}