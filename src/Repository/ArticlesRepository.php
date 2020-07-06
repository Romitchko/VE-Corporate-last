<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }


    /**
     *  @return Query
     */
    public function findAllVisibleQuery(): Query
    {
        return $this->createQueryBuilder('c')
        ->orderBy('c.id', 'DESC')
            ->getQuery();
    }
   
    /**
     * @return Articles[]
     */
    public function FindLatest(): array 
    {
        return $this->createQueryBuilder('a')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Articles[] Returns an array of Articles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Articles
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
