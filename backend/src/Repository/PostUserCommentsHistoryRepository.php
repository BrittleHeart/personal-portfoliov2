<?php

namespace App\Repository;

use App\Entity\PostUserCommentsHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PostUserCommentsHistory>
 *
 * @method PostUserCommentsHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostUserCommentsHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostUserCommentsHistory[]    findAll()
 * @method PostUserCommentsHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostUserCommentsHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostUserCommentsHistory::class);
    }

    public function save(PostUserCommentsHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PostUserCommentsHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PostUserCommentsHistory[] Returns an array of PostUserCommentsHistory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PostUserCommentsHistory
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
