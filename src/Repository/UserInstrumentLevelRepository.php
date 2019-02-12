<?php

namespace App\Repository;

use App\Entity\UserInstrumentLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserInstrumentLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserInstrumentLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserInstrumentLevel[]    findAll()
 * @method UserInstrumentLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserInstrumentLevelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserInstrumentLevel::class);
    }

    // /**
    //  * @return UserInstrumentLevel[] Returns an array of UserInstrumentLevel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserInstrumentLevel
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
