<?php

namespace App\Repository;

use App\Entity\Instrument;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Userl|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Level::class);
    }

    // /**
    //  * @return Userl[] Returns an array of User objects
    //  */

    public function findAllInstruments(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT i
            FROM App\Entity\Instrument i'
        );

        // returns an array of Instrument objects
        return $query->execute();
    }

    public function findById($id) {
        $qb = $this->entityManager->createQueryBuilder();
        $qb ->select('u')
            ->from('App\Entity\User', 'u')
            ->setParameter('id', $id);
    
        return $qb->getQuery()->getResult();
    }

    public function findAllOrdererByRegDate(): array
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb ->select('u')
            ->from('App\Entity\User', 'u')
            ->orderBy('registrationDate');
    
        return $qb->getQuery()->getResult();

        // to get just one result:
        // $product = $qb->setMaxResults(1)->getOneOrNullResult();
    }

    /*
    public function findOneBySomeField($value): ?Level
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}