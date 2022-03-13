<?php

namespace App\Repository;

use App\Entity\AbsEtudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AbsEtudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbsEtudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbsEtudiant[]    findAll()
 * @method AbsEtudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbsEtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AbsEtudiant::class);
    }
    
    /**
     * @return AbsEtudiant[]
     */
    public function getEtudiantByEmail($id)
    {
       $entityManager = $this->getEntityManager();
       $query = $entityManager->createQuery(
            // 'SELECT a, e
            // FROM App\Entity\Etudiant e
            // INNER JOIN e.AbsEtudiants a
            // WHERE e.id = :id'
            'SELECT e, a 
            FROM App\Entity\AbsEtudiant a 
            INNER JOIN a.etudiant e 
            WHERE a.etudiant = :id'
       )
       ->setParameter('id', $id);
       return $query->getResult();
    }    
    /**
     * @return AbsEtudiant[]
     */
    public function CurrentMonthCountAbs($id)
    {
        $month = date('m');
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = :month')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }   

     ///////////By Month//////////////
    
    /**
     * @return AbsEtudiant[]
     */
    public function JanAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 01')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }   

    /**
     * @return AbsEtudiant[]
     */
    public function FebAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 02')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }   

    /**
     * @return AbsEtudiant[]
     */
    public function MarAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 03')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }   

    /**
     * @return AbsEtudiant[]
     */
    public function AvrAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 04')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }   

    /**
     * @return AbsEtudiant[]
     */
    public function MaiAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 05')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }   

    /**
     * @return AbsEtudiant[]
     */
    public function JunAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 06')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @return AbsEtudiant[]
     */
    public function JulAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 07')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @return AbsEtudiant[]
     */
    public function AouAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 08')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }    

    /**
     * @return AbsEtudiant[]
     */
    public function SepAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 09')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }    

    /**
     * @return AbsEtudiant[]
     */
    public function OctAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 10')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @return AbsEtudiant[]
     */
    public function NovAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 11')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @return AbsEtudiant[]
     */
    public function DecAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = 12')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    ///////////By Week//////////////

    /**
     * @return AbsEtudiant[]
     */
    public function MonAbs($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = :month')
            ->andWhere('week(a.createdAt) = :week')
            ->andWhere('dayofweek(a.createdAt) = 2')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }   
    /**
     * @return AbsEtudiant[]
     */
    public function TueAbs($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = :month')
            ->andWhere('week(a.createdAt) = :week')
            ->andWhere('dayofweek(a.createdAt) = 3')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
    
    /**
     * @return AbsEtudiant[]
     */
    public function WedAbs($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = :month')
            ->andWhere('week(a.createdAt) = :week')
            ->andWhere('dayofweek(a.createdAt) = 4')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
    
    /**
     * @return AbsEtudiant[]
     */
    public function ThuAbs($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = :month')
            ->andWhere('week(a.createdAt) = :week')
            ->andWhere('dayofweek(a.createdAt) = 5')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @return AbsEtudiant[]
     */
    public function FriAbs($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = :month')
            ->andWhere('week(a.createdAt) = :week')
            ->andWhere('dayofweek(a.createdAt) = 6')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }   
    
    /**
     * @return AbsEtudiant[]
     */
    public function SatAbs($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->andWhere('MONTH(a.createdAt) = :month')
            ->andWhere('week(a.createdAt) = :week')
            ->andWhere('dayofweek(a.createdAt) = 0')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    // /**
    //  * @return AbsEtudiant[]
    //  */
    // public function SunAbs($id)
    // {
    //     $year = date('Y');
    //     $month = date('m');
    //     return $this->createQueryBuilder('a')
    //         ->select('COUNT(a)')
    //         ->innerJoin('a.etudiant', 'e')
    //         ->where('a.etudiant = :id')
    //         ->andWhere('YEAR(a.createdAt) = :year')
    //         ->andWhere('MONTH(a.createdAt) = :month')
    //         ->andWhere('dayofweek(a.createdAt) = 7')
    //         ->setParameter('month', $month)
    //         ->setParameter('year', $year)
    //         ->setParameter('id', $id)
    //         ->getQuery()
    //         ->getSingleScalarResult()
    //     ;
    // }




    
    /**
     * @return AbsEtudiant[]
     */
    public function YearCountAbs($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('a')
            ->select('COUNT(a)')
            ->innerJoin('a.etudiant', 'e')
            ->where('a.etudiant = :id')
            ->andWhere('YEAR(a.createdAt) = :year')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    // /**
    //  * @return AbsEtudiant[]
    //  */
    // public function CountAbs($id)
    // {
    //     // $em = $this->getDoctrine()->getManager();
    //     // $em = $this->getEntityManager();
    //     // $emConfig = $em->getConfiguration();
    //     // $emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
    //     // $emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
    //     // $emConfig->addCustomDatetimeFunction('DAY', 'DoctrineExtensions\Query\Mysql\Day');


    //    $entityManager = $this->getEntityManager();
    //    $query = $entityManager->createQuery(
    //         "SELECT COUNT('a') 
    //         FROM App\Entity\AbsEtudiant 
    //         WHERE 
    //             YEAR('a.created_at') = 2022 AND 
    //             MONTH('a.created_at') = 02;"
    //    );
    //     return $query->getResult();
    // }

    // /**
    //  * @return AbsEtudiant[] Returns an array of AbsEtudiant objects
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
    public function findOneBySomeField($value): ?AbsEtudiant
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
