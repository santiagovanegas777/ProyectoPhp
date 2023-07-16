<?php

namespace App\Repository;

use App\Entity\Created;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Created>
 *
 * @method Created|null find($id, $lockMode = null, $lockVersion = null)
 * @method Created|null findOneBy(array $criteria, array $orderBy = null)
 * @method Created[]    findAll()
 * @method Created[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Created::class);
    }

//    /**
//     * @return Created[] Returns an array of Created objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Created
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
