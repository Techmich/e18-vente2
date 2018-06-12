<?php
/**
 * Created by PhpStorm.
 * User: willkoua
 * Date: 18-06-10
 * Time: 18:51
 */

namespace App\Service;


use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Ticket;
use Doctrine\ORM\EntityManagerInterface;

class TicketService
{
    private $doctrine;

    public function __construct(RegistryInterface $doctrine, EntityManagerInterface $manager)
    {
        $this->doctrine = $doctrine;
        $this->manager = $manager;
    }

    public function reserved ($id) : Ticket
    {
        $ticket = $this->doctrine->getRepository(Ticket::class)
            ->findOneBy([
                'show_id' => $id,
                'status' => Ticket::NONE
            ]);

        if (!$ticket) {
            return null;
        }

        $ticket->setStatus(Ticket::RESERVED);
        $this->manager->persist($ticket);
        $this->manager->flush();

        return $ticket;
    }
}