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
        $qb = $this->createQueryBuilder('u')
            ->setParameter('id', $id); 
    
        return $qb->getQuery()->getResult();
    }

    public function findByMultiple($genres, $instrus, $zipcode) {

        $qb = $this->createQueryBuilder('u');
        $qb->leftJoin("u.instruments", "i")
            ->leftJoin("u.genres", "g");{
            if(!empty($zipcode)){
                $qb->where("u.zipCode LIKE :zipcode")
                ->setParameter(':zipcode', '%'.$zipcode.'%');
            }
            if(!empty($instrus)){
                $qb->andWhere(
                    $qb->expr()->in('i.id', ':instrus')
                )
                ->setParameter(':instrus', $instrus);
            }
            if(!empty($genres)){
                $qb->andWhere(
                    $qb->expr()->in('g.id', ':genres')
                )
                ->setParameter(':genres', $genres);
            }
        
        return $qb->getQuery()->getResult();
        }
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