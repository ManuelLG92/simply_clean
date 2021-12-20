<?php


namespace App\News\Infrastructure\Persistence\Doctrine;

use App\News\Domain\NewRepositoryInterface;
use App\News\Domain\News;
use App\Shared\Domain\Criteria\CriteriaBuilder;
use App\Shared\Domain\Criteria\CriteriaBuilderException;
use App\Shared\Domain\ValueObjects\DateValueObject;
use App\Shared\Domain\ValueObjects\Identifier;
use App\Shared\Domain\ValueObjects\StringValueObject;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

final class MySqlNewRepository extends DoctrineRepository implements NewRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    public function get(Identifier $id): ?News
    {
        return parent::get($id);
    }

    /**
     * @throws CriteriaBuilderException
     */
    public function getByDate(DateValueObject $date): array
    {
        $criteria = CriteriaBuilder::create()->where(
            'new.createdAt',
            StringValueObject::fromDate($date->value()))->build();
        return $this->findByCriteria( $criteria);
    }
}