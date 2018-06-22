<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\Types\Integer;
use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Show;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;


class ShowController extends Controller
{
    /**
     * @param $id
     * @return Ticket|object
     */
    public function __invoke($id)
    {
        $ticket = $this->getDoctrine()
            ->getRepository(Ticket::class)
            ->findOneBy([
                "show" => $id,
                "status" => Ticket::NONE
            ]);

        if(!$ticket){
            throw new ResourceNotFoundException("Il n y a plus de ticket pour ce spectacle");
        }

        $ticket->setStatus(Ticket::RESERVED);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ticket);
        $entityManager->flush();

        return $ticket;
    }
}
