<?php

namespace App\Repository;

use App\Entity\HistoryBuyTickets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HistoryBuyTickets|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoryBuyTickets|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoryBuyTickets[]    findAll()
 * @method HistoryBuyTickets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoryBuyTicketsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HistoryBuyTickets::class);
    }

//    /**
//     * @return HistoryBuyTickets[] Returns an array of HistoryBuyTickets objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HistoryBuyTickets
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
