<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Etudiant) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    
    }

    /**
     * @return Etudiant[]
     */
    public function getPaginatedEtudiant($page, $limit)
    {
        $query = $this->createQueryBuilder('e')
            ->orderBy('e.id', 'DESC')
            ->setFirstResult(($page * $limit) - $limit)
            ->setMaxResults($limit);
        return $query->getQuery()->getResult();
    }    
    
    /**
     * @return Etudiant[]
     */
    public function getTotalEtudiant()
    {
        $query = $this->createQueryBuilder('e')
            ->select('COUNT(e)');
        return $query->getQuery()->getSingleScalarResult();
    }

    /**
     * @return Etudiant[]
     */
    public function SearchEtudiant($mots)
    {
        $query = $this->createQueryBuilder('e');
        
        if ($mots != null) 
        {
            $query->andWhere('e.email LIKE :mots OR e.lastname LIKE :mots')
                ->setParameter('mots', "%{$mots}%");
        }
        return $query->getQuery()->getResult();
    }
    // /**
    //  * @return Etudiant[] Returns an array of Etudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etudiant
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
