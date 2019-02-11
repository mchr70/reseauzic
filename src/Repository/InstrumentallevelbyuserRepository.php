<?php

namespace App\Repository;

use App\Entity\Instrumentallevelbyuser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Instrumentallevelbyuser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Instrumentallevelbyuser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Instrumentallevelbyuser[]    findAll()
 * @method Instrumentallevelbyuser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstrumentallevelbyuserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Instrumentallevelbyuser::class);
    }

    // /**
    //  * @return Instrumentallevelbyuser[] Returns an array of Instrumentallevelbyuser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Instrumentallevelbyuser
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
