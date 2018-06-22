<?php

namespace App\Controller;

use App\Entity\CustomerTicket;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class CustomerTicketController extends Controller
{
    /**
     * @param $customerTicket
     * @return CustomerTicket|object
     */
    public function __invoke(CustomerTicket $customerTicket) : CustomerTicket
    {
        $tickets = $this->getDoctrine()
            ->getRepository(CustomerTicket::class)
            ->findOneBy([
                "customer" => $customerTicket->getCustomer()
            ]);
        $count = 1;

        if(!isset($customerTicket)){
            throw new ResourceNotFoundException("Il n y a plus de ticket pour ce spectacle");
        }
        if(!isset($tickets)){
            throw new ResourceNotFoundException("Il n y a plus de ticket pour ce spectacle");
        }
        if(count($tickets) > count){
            throw new ResourceNotFoundException("Vous ne pouvez plus réserver des tickets. 
                Vous avez déjà $count de reserver");
        }
        throw new ResourceNotFoundException("Vous ne pouvez plus réserver des tickets. 
                Vous avez déjà $count de reserver");
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($customerTicket);
//        $entityManager->flush();
//
//        return $customerTicket;
        return $customerTicket;
    }
}
