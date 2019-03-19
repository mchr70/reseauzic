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

    public function findByGenreAndDepartement($depId, $genreId){

        $qb = $this->createQueryBuilder('u');

        $qb->leftJoin("u.departement", "d");
        $qb->where("d.id = :depId")
            ->setParameter(':depId', $depId);
        $qb->leftJoin("u.genres", "g");
        $qb->andWhere(
            $qb->expr()->in('g.id', ':genreId')
        );
        $qb->setParameter('genreId', $genreId);
        $qb->setMaxResults(4);

        return $qb->getQuery()->getResult();

    }

    public function findByMatchingGenres(User $user, $zipCode, $genresIds){

        $qb = $this->createQueryBuilder('u');

        $qb->where("u.zipCode LIKE :zipcode")
            ->setParameter(':zipcode', substr($zipCode, 0, 2) . '%');
        $qb->leftJoin("u.genres", "g");
        $qb->andWhere(
            $qb->expr()->in('g.id', ':ids')
        );
        $qb->setParameter('ids', $genresIds);

        return $qb->getQuery()->getResult();
    }

    public function findByMultiple($genres, $instrus, $zipcode) {

        $qb = $this->createQueryBuilder('u');
       
        if(!empty($zipcode)){
            $qb->where("u.zipCode LIKE :zipcode")
            ->setParameter(':zipcode', $zipcode.'%');
        }
        if($instrus != null AND $genres != null){
            $qb->leftJoin("u.instruments", "i");
            $qb->leftJoin("u.genres", "g");
            $qb->andWhere($qb->expr()->andX(
                $qb->expr()->in('i.id', ':instrus'),
                $qb->expr()->in('g.id', ':genres')
            ))
            ->setParameter(':instrus', $instrus)
            ->setParameter(':genres', $genres);
        }
        else{
            if($instrus != null){
                $qb->leftJoin("u.instruments", "i");
                $qb->andWhere(
                    $qb->expr()->in('i.id', ':instrus')
                )
                ->setParameter(':instrus', $instrus);
            }
            if($genres != null){
                $qb->leftJoin("u.genres", "g");
                $qb->andWhere(
                    $qb->expr()->in('g.id', ':genres')
                )
                ->setParameter(':genres', $genres);
            }
        }
        
        return $qb->getQuery()->getResult();
        
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