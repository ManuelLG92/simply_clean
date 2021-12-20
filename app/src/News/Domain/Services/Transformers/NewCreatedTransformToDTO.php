<?php

namespace App\News\Domain\Services\Transformers;

use App\News\Domain\DTO\NewCreatedDTO;
use App\News\Domain\News;
use App\Shared\Domain\ValueObjects\StringValueObject;

class NewCreatedTransformToDTO
{
    public static function fromNewEntity(News $news): NewCreatedDTO
    {
        return new NewCreatedDTO(
            $news->id->value(),
            $news->title->value(),
            $news->content->value(),
            StringValueObject::fromDate($news->createdAt->value()),
        );
    }

}