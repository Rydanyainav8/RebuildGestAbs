<?php

namespace App\Repository;

use App\Entity\DepAntEtudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DepAntEtudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepAntEtudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepAntEtudiant[]    findAll()
 * @method DepAntEtudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepAntEtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepAntEtudiant::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(DepAntEtudiant $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(DepAntEtudiant $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return DepAntEtudiant[] Returns an array of DepAntEtudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DepAntEtudiant
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
