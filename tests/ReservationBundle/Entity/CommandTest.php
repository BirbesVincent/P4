<?php

namespace Tests\ReservationBundle\Entity;

use PHPUnit\Framework\TestCase;
use ReservationBundle\Entity\Command;
use DateTime;

class CommandTest extends TestCase
{
    /**
     * Test des getters et setters
     */
    public function testGettersAndSetters()
    {
        // Creation d'une commande
        $command = new Command();
        $command->setDate(new \DateTime());
        $command->setType(false);
        $command->setEmail('EXEMPLE@TLD.COM');

        // Email identique à celui injecter par le setter
        $this->assertInstanceOf(DateTime::class, $command->getDate());
        // Identique à celui injecter par le setter
        $this->assertEquals(false, $command->getType());
        // On vérifie qu'on récupére bien une instance de datetime
        $this->assertEquals('EXEMPLE@TLD.COM', $command->getEmail());
    }
}