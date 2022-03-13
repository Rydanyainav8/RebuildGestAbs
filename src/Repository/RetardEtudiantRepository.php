<?php

namespace App\Repository;

use App\Entity\RetardEtudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RetardEtudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method RetardEtudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method RetardEtudiant[]    findAll()
 * @method RetardEtudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RetardEtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RetardEtudiant::class);
    }

    /**
     * @return RetardEtudiant[]
     */
    public function JanRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 01')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @return RetardEtudiant[]
     */
    public function FevRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 02')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
    /**
     * @return RetardEtudiant[]
     */
    public function MarRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 03')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }    
    
    /**
     * @return RetardEtudiant[]
     */
    public function AvrRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 04')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @return RetardEtudiant[]
     */
    public function MaiRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 05')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @return RetardEtudiant[]
     */
    public function JunRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 06')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

   /**
     * @return RetardEtudiant[]
     */
    public function JulRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 07')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }   
    
    /**
     * @return RetardEtudiant[]
     */
    public function AouRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 08')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }    
    
    /**
     * @return RetardEtudiant[]
     */
    public function SepRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 09')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @return RetardEtudiant[]
     */
    public function OctRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 10')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }    

    /**
     * @return RetardEtudiant[]
     */
    public function NovRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 11')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }  
    
    /**
     * @return RetardEtudiant[]
     */
    public function DecRet($id)
    {
        $year = date('Y');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = 12')
            ->setParameter('year', $year)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

   ///////////By Week//////////////

    /**
     * @return RetardEtudiant[]
     */
    public function MonRet($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = :month')
            ->andWhere('week(r.createdAt) = :week')
            ->andWhere('dayofweek(r.createdAt) = 2')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }  

    /**
     * @return RetardEtudiant[]
     */
    public function TueRet($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = :month')
            ->andWhere('week(r.createdAt) = :week')
            ->andWhere('dayofweek(r.createdAt) = 3')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }      
    
    /**
     * @return RetardEtudiant[]
     */
    public function WedRet($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = :month')
            ->andWhere('week(r.createdAt) = :week')
            ->andWhere('dayofweek(r.createdAt) = 4')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }      
    
    /**
     * @return RetardEtudiant[]
     */
    public function ThuRet($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = :month')
            ->andWhere('week(r.createdAt) = :week')
            ->andWhere('dayofweek(r.createdAt) = 5')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }  

    /**
     * @return RetardEtudiant[]
     */
    public function FriRet($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = :month')
            ->andWhere('week(r.createdAt) = :week')
            ->andWhere('dayofweek(r.createdAt) = 6')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }  

    /**
     * @return RetardEtudiant[]
     */
    public function SatRet($id)
    {
        $year = date('Y');
        $month = date('m');
        $week = date('W');
        return $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->innerJoin('r.etudiant', 'e')
            ->where('r.etudiant = :id')
            ->andWhere('YEAR(r.createdAt) = :year')
            ->andWhere('MONTH(r.createdAt) = :month')
            ->andWhere('week(r.createdAt) = :week')
            ->andWhere('dayofweek(r.createdAt) = 0')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('week', $week)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }      


    // /**
    //  * @return RetardEtudiant[] Returns an array of RetardEtudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RetardEtudiant
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
