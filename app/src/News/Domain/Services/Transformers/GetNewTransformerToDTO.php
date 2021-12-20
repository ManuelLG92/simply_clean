<?php

namespace App\News\Domain\Services\Transformers;

use App\News\Domain\DTO\GetNewDTO;
use App\News\Domain\News;
use App\Shared\Domain\ValueObjects\StringValueObject;

class GetNewTransformerToDTO
{
    public static function fromNewEntity(News $news): GetNewDTO
    {
        return new GetNewDTO(
            $news->id->value(),
            $news->title->value(),
            $news->content->value(),
            StringValueObject::fromDate($news->createdAt->value()),
            StringValueObject::fromDate($news->updatedAt->value()),
        );
    }

}