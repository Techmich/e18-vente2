<?php

namespace App\Controller;

use App\Entity\CustomerTicket;
use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\Types\Integer;
use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Show;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use App\Repository\ShowRepository;


class ShowController extends Controller
{
    /**
     * @param $id
     * @return Integer
     */
    public function __invoke($id)
    {
        $show = $this->getDoctrine()
            ->getRepository(Show::class)
            ->getCountTicketSold($id);

        return $show;
    }
}
