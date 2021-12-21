<?php

namespace App\News\Domain\Services\Transformers;

use App\News\Domain\News;
use App\Shared\Domain\ValueObjects\StringValueObject;

class ResponseFindByIdDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $content,
        public readonly string $createdAt,
        public readonly string $updatedAt,
    )
    {
    }
    public static function fromNewEntity(News $news): ResponseFindByIdDTO
    {
        return new self(
            $news->id->value(),
            $news->title->value(),
            $news->content->value(),
            StringValueObject::fromDate($news->createdAt->value()),
            StringValueObject::fromDate($news->updatedAt->value()),
        );
    }

}