<?php

namespace App\Repository;

use App\Entity\CustomerTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomerTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerTicket[]    findAll()
 * @method CustomerTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerTicketRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomerTicket::class);
    }

//    /**
//     * @return CustomerTicket[] Returns an array of CustomerTicket objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CustomerTicket
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
