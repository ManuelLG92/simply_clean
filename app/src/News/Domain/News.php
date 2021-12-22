<?php

namespace App\News\Domain;

use App\News\Domain\ValueObjects\NewContent;
use App\News\Domain\ValueObjects\NewCreatedAt;
use App\News\Domain\ValueObjects\NewId;
use App\News\Domain\ValueObjects\NewTitle;
use App\News\Domain\ValueObjects\NewUpdatedAt;
use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\Exception\InvalidAttributeException;

class News extends AggregateRoot
{
    public function __construct(
        public readonly NewId $id,
        public readonly NewTitle $title,
        public readonly NewContent $content,
        public readonly NewCreatedAt $createdAt,
        public readonly NewUpdatedAt $updatedAt,
    )
    {
    }

    /**
     * @throws InvalidAttributeException
     */
    public static function create(
        NewTitle $newTitle,
        NewContent $newContent,
    ): self
    {
        return new self(
            NewId::generate(),
            $newTitle,
            $newContent,
            NewCreatedAt::byDefault(),
            NewUpdatedAt::byDefault(),
        );
    }

    public static function update(
        self $news,
        NewTitle $newTitle,
        NewContent $newContent,
    ): self
    {
        return new self(
            $news->id,
            $newTitle,
            $newContent,
            $news->createdAt,
            NewUpdatedAt::byDefault(),
        );
    }





}