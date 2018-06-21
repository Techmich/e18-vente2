<?php

namespace App\Repository;

use App\Entity\TicketUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TicketUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketUser[]    findAll()
 * @method TicketUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TicketUser::class);
    }

//    /**
//     * @return TicketUser[] Returns an array of TicketUser objects
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
    public function findOneBySomeField($value): ?TicketUser
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
