<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Enum\PostCommentStatusEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 *
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function save(Comment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Comment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param PostCommentStatusEnum $status
     * @return array<int, Comment>
     */
    public function getCommentsWithStatus(PostCommentStatusEnum $status): array
    {
        return $this->findBy(['status' => $status->value]);
    }

    /**
     * @param int $minutes
     * @return array<int, Comment>
     */
    public function getCommentsBetweenTime(int $minutes): array
    {
        $now = new \DateTime();
        $now->sub(new \DateInterval('PT' . $minutes . 'M'));

        return $this->createQueryBuilder('c')
            ->where('c.createdAt > :now')
            ->setParameter('now', $now)
            ->getQuery()
            ->getResult();
    }
}
