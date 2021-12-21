<?php

namespace App\News\Domain;

use App\News\Domain\ValueObjects\NewId;
use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\ValueObjects\DateValueObject;

interface NewRepositoryInterface
{
    public function add(News $new): void;
    public function flush(): void;
    public function get(NewId $newId): ?News;
    public function findByCriteria(Criteria $criteria): array;
    public function remove(News $news): void;
    public function getByDate(DateValueObject $dateValueObject);

}