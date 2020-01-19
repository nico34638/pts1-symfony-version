<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
      * @return Article[] Returns an array of Article objects
      */

    public function findByTitle($value) : QueryBuilder
    {
          return $this->createQueryBuilder('a')
              ->andWhere('a.title = :val')
              ->setParameter('val', $value)
              ->getQuery();
    }


    /**
      * @return Article[] Returns an array of Article objects
      */
    public function fintLatest(): array
    {
        return $this->createQueryBuilder('a')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    /**
      * @return Article[] Returns an array of Article objects
      */
    public function findAllArticle():array
    {
        return $this->createQueryBuilder('a')
                    ->getQuery()
                    ->getResult();
    }

    /**
      * @return Article[] Returns an array of Article objects
      */
    public function findTrois(): array
    {
        return $this->createQueryBuilder('a')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Article
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
