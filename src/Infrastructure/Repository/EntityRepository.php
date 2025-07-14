<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\RepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * @template TEntity of object
 *
 * @template-extends ServiceEntityRepository<TEntity>
 *
 * @implements RepositoryInterface<TEntity>
 */
abstract class EntityRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function get(mixed $id, ?int $lockMode = null, ?int $lockVersion = null): object
    {
        $entity = $this->find($id, $lockMode, $lockVersion);
        if (null === $entity) {
            throw new NoResultException();
        }

        return $entity;
    }

    public function getOneBy(array $criteria, ?array $orderBy = null): object
    {
        $entity = $this->findOneBy($criteria, $orderBy);
        if (null === $entity) {
            throw new NoResultException();
        }

        return $entity;
    }

    public function save(object $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
