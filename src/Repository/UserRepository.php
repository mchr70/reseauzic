<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Instrument;
use App\Entity\UserSearch;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


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
        parent::__construct($registry, User::class);
    }

    public function findById($id) {
        $qb = $this->entityManager->createQueryBuilder();
        $qb ->select('u')
            ->from('App\Entity\User', 'u')
            ->setParameter('id', $id); 
    
        return $qb->getQuery()->getResult();
    }

    /**
     * @return query
     */
    public function findAllVisibleQuery(UserSearch $search){
        $query =  $this->findVisibleQuery();

        if($search->getZipCode){
            $query->$query->where('u.zipCode == :zipCode')
                          ->setParameter('zipCode', $search->getZipCode());
        }

        if($search->getCity){
            $query->$query->where('u.city == :city')
                          ->setParameter('city', $search->getCity());
        }

        return $query->getQuery();
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