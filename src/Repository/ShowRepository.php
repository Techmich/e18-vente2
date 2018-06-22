<?php

namespace App\Repository;

use App\Entity\Show;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\customerTicket;
use App\Entity\Ticket;

/**
 * @method Show|null find($id, $lockMode = null, $lockVersion = null)
 * @method Show|null findOneBy(array $criteria, array $orderBy = null)
 * @method Show[]    findAll()
 * @method Show[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShowRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Show::class);
    }

//    /**
//     * @return Show[] Returns an array of Show objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Show
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getCountTicketSold($showId)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '  SELECT count(t.id)
                    FROM tickets t
                    INNER JOIN customers_tickets t2 ON t.id = t2.ticket_id
                    WHERE t.show_id = :show AND t2.sold_at IS NOT NULL';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['show' => $showId]);

        // returns an array of Product objects
        return $stmt->fetch();
    }
}
