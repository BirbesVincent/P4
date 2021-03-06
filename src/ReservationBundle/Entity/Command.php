<?php

namespace ReservationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use ReservationBundle\Entity\Ticket;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Command
 *
 * @ORM\Table(name="command")
 * @ORM\Entity(repositoryClass="ReservationBundle\Repository\CommandRepository")
 */
class Command
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     * @Assert\DateTime()
     * @Assert\GreaterThanOrEqual(
     *     value = "today",
     *     message = "Cette valeur doit être plus grand ou équivalent à {{ compared_value }}"
     * )
     *
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(
     *     type="bool",
     *     message="La valeur {{ value }} n'est pas du type {{ type }}."
     * )
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message="L'adresse email n'est pas valide"
     * )
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="ReservationBundle\Entity\Ticket", mappedBy="Command", cascade={"persist"})
     */
    private $tickets;

    public function getTotalPrice()
    {
        $totalPrice = 0;
        $tickets = $this->getTickets();
        foreach ($tickets as $ticket){
            $totalPrice += $ticket->getPrice();
        }
        return $totalPrice * 100;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Command
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    /**
     * Add ticket
     *
     * @param Ticket $ticket
     *
     * @return Command
     */
    public function addTicket(Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param Ticket $ticket
     */
    public function removeTicket(Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set type
     *
     * @param boolean $type
     *
     * @return Command
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Command
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

}
