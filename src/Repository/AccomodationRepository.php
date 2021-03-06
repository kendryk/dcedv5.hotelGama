<?php

namespace App\Repository;

use App\Entity\Accomodation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Accomodation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accomodation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accomodation[]    findAll()
 * @method Accomodation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccomodationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accomodation::class);
    }


    public function findAccomodations()
    {
        $qb = $this->createQueryBuilder('a'); // requete SQL : SELECT * ROM Accomodation AS a
        $qb = $qb-> addSelect('type') // SELECT a.*,type.*
        -> addSelect('category') // SELECT a.*,category.*
        -> addSelect('amenity') // SELECT a.*,amenity.*

        ->innerJoin('a.type', 'type') // INNER JOIN type ON type.id = Accomodation.type_id
        ->innerJoin('a.category', 'category') // INNER JOIN type ON category.id = Accomodation.category_id
        ->innerJoin('a.amenity', 'amenity') // INNER JOIN type ON amenity.id = Accomodation.amenity_id
        ;

        return $qb
            ->getQuery()
            ->getResult();
    }

    //Récuperer la liste des logements avec la barre de recherche(homepage)
    public function findByPrice($type, $prixMin, $prixMax)
    {
        $qb = $this->createQueryBuilder('a');

        $qb = $qb-> addSelect('type')  // SELECT a.*,type.*

            -> innerJoin('a.type', 'type') // INNER JOIN type ON type.id = Accomodation.type_id
            -> andWhere('type.name = :type')
            -> setParameter('type', $type)

            -> andWhere('a.price BETWEEN :min AND :max')
            -> setParameter('min', $prixMin)
            -> setParameter('max', $prixMax) ;
            //->setMaxResults(10)

          return $qb
              ->getQuery()
              ->getResult()
        ;
    }

    //Récuperer les dates de réservation de la page show accomodation
    public function findBooking($date_start, $date_end)
    {
        $qb = $this->createQueryBuilder('a'); //accomodation

        $qb = $qb-> addSelect('type')  // SELECT a.*,type.*

        -> innerJoin('a.type', 'type') // INNER JOIN type ON type.id = Accomodation.type_id
        -> andWhere('type.name = :type')
            -> setParameter('type', $date_start)
            -> setParameter('min', $date_end)
            ->innerJoin('a.booking', 'booking') // INNER JOIN type ON category.id = Accomodation.category_id
            ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }








    // /**
    //  * @return Accomodation[] Returns an array of Accomodation objects
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
    public function findOneBySomeField($value): ?Accomodation
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
