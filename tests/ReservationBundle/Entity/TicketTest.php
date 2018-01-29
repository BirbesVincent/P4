<?php
/**
 * Created by PhpStorm.
 * User: Misthaly
 * Date: 29/01/2018
 * Time: 18:51
 */

namespace Tests\ReservationBundle\Entity;

use DateTime;
use PHPUnit\Framework\TestCase;
use ReservationBundle\Entity\Command;
use ReservationBundle\Entity\Ticket;

class TicketTest extends TestCase
{

    public function testGettersAndSetters()
    {
        //Création d'une commande
        $command = new Command();

        // Creation d'un ticket
        $ticket = new Ticket();
        $ticket->setFirstName('David');
        $ticket->setLastName('Gary');
        $ticket->setType('NORMAL');
        $ticket->setReduced(true);
        $ticket->setBirthday(new \DateTime());
        $ticket->setCountry('France');
        $ticket->setCommand($command);
        $ticket->setPrice(16);

        //Vérification
        $this->assertEquals('David', $ticket->getFirstName());
        $this->assertEquals('Gary', $ticket->getLastName());
        $this->assertEquals('NORMAL', $ticket->getType());
        $this->assertEquals(true, $ticket->getReduced());
        $this->assertInstanceOf(DateTime::class, $ticket->getBirthday());
        $this->assertEquals('France', $ticket->getCountry());
        $this->assertEquals($command, $ticket->getCommand());
        $this->assertEquals(16, $ticket->getPrice());
    }

}