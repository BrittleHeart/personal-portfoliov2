<?php

namespace App\Repository;

use App\Entity\Theme;
use App\Exception\NotImplementedException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Theme>
 *
 * @method Theme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Theme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Theme[]    findAll()
 * @method Theme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Theme::class);
    }

    public function save(Theme $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Theme $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function addThumbnail(): void
    {
        // TODO: Implement class for image manipulation with Imagine, to be able to create a thumbnail with background and logo
        throw new NotImplementedException(__METHOD__);
    }

    /**
     * @param Theme $entity
     * @param string $editablePart
     */
    public function addEditableParts(Theme $entity, string $editablePart): void
    {
        $currentEditableParts = $entity->getEditableParts();
        $currentEditableParts[] = $editablePart;

        $entity->setEditableParts($currentEditableParts);
        $this->save($entity, true);
    }
}
