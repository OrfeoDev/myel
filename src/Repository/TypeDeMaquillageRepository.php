<?php

namespace App\Repository;

use App\Entity\TypeDeMaquillage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeDeMaquillage>
 *
 * @method TypeDeMaquillage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDeMaquillage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDeMaquillage[]    findAll()
 * @method TypeDeMaquillage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDeMaquillageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeDeMaquillage::class);
    }

    public function add(TypeDeMaquillage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TypeDeMaquillage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TypeDeMaquillage[] Returns an array of TypeDeMaquillage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeDeMaquillage
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
