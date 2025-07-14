<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use Doctrine\DBAL\LockMode;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;

/**
 * @template T of object
 */
interface RepositoryInterface
{
    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed $id the identifier
     * @param int|null $lockMode one of the \Doctrine\DBAL\LockMode::* constants
     *                           or NULL if no specific lock mode should be used
     *                           during the search
     * @param int|null $lockVersion the lock version
     *
     * @psalm-param LockMode::*|null $lockMode
     *
     * @return T|null the entity instance or NULL if the entity can not be found
     *
     * @psalm-return ?T
     */
    public function find(mixed $id, LockMode|int|null $lockMode = null, ?int $lockVersion = null): ?object;

    /**
     * Finds an object by its primary key / identifier.
     * Throws an exception if the object cannot be found.
     *
     * @return T
     *
     * @throws NoResultException
     */
    public function get(mixed $id, ?int $lockMode = null, ?int $lockVersion = null): object;

    /**
     * Finds a single object by a set of criteria and cache the result for next calls.
     *
     * @param array<string, mixed> $criteria
     * @param array<string, string>|null $orderBy
     *
     * @return T
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getOneBy(array $criteria, ?array $orderBy = null): object;

    /**
     * Finds entities by a set of criteria.
     *
     * @param int|null $limit
     * @param int|null $offset
     *
     * @psalm-param array<string, mixed> $criteria
     * @psalm-param array<string, string>|null $orderBy
     *
     * @return T[] the objects
     *
     * @psalm-return list<T>
     */
    public function findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null);

    /**
     * Counts entities by a set of criteria.
     *
     * @phpstan-param array<string, mixed> $criteria
     *
     * @return int the cardinality of the objects that match the given criteria
     */
    public function count(array $criteria);

    /**
     * Finds a single entity by a set of criteria.
     *
     * @psalm-param array<string, mixed> $criteria
     * @psalm-param array<string, string>|null $orderBy
     *
     * @return T|null the entity instance or NULL if the entity can not be found
     *
     * @psalm-return ?T
     */
    public function findOneBy(array $criteria, ?array $orderBy = null);

    /**
     * Creates a new QueryBuilder instance that is prepopulated for this entity name.
     *
     * @param string $alias
     * @param string|null $indexBy the index for the from
     *
     * @return QueryBuilder
     */
    public function createQueryBuilder(string $alias, ?string $indexBy = null): QueryBuilder;

    /**
     * Persists an entity.
     *
     * @param T $entity The entity instance to save.
     * @param bool $flush Whether to flush immediately.
     */
    public function save(object $entity, bool $flush = false): void;
}
