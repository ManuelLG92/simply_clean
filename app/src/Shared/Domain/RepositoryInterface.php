<?php

namespace App\Shared\Domain;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\ValueObjects\Identifier;

interface RepositoryInterface
{
    public function add(AggregateRoot $user): void;

    public function get(Identifier $identifier): ?object;

    public function findByCriteria(Criteria $criteria): array;

    public function remove(AggregateRoot $user): void;

    public function flush(): void;
}
