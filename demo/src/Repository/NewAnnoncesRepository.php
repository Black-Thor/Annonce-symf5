<?php

namespace App\Repository;

use App\Entity\NewAnnonces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewAnnonces|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewAnnonces|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewAnnonces[]    findAll()
 * @method NewAnnonces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewAnnoncesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewAnnonces::class);
    }
    
    /**
     * findVisible
     *
     * @return void
     */
    
    public function findVisible(){
        return $this -> createQueryBuilder('p')
                     ->where() 
                     ->getQuery()
                     ->getResult() ;  
    }

    // /**
    //  * @return NewAnnonces[] Returns an array of NewAnnonces objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewAnnonces
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
