<?php

namespace App\News\Domain;

use App\News\Domain\ValueObjects\NewContent;
use App\News\Domain\ValueObjects\NewCreatedAt;
use App\News\Domain\ValueObjects\NewId;
use App\News\Domain\ValueObjects\NewTitle;
use App\News\Domain\ValueObjects\NewUpdatedAt;
use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\Exception\BadRequestException;
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

    /**
     * @throws BadRequestException
     */
    public static function validate (self $news)
    {
        if (strlen($news->title->value()) < 1 || strlen($news->title->value()) > 40){
            throw new BadRequestException('Invalid title');
        }

        if (strlen($news->content->value()) < 1 || strlen($news->content->value()) > 255){
            throw new BadRequestException('Invalid Content');
        }

        if ($news->createdAt > new \DateTime('now') ){
            throw new BadRequestException('Creation date can\'t be greater than now.');
        }

        if ($news->updatedAt > new \DateTime('now') ){
            throw new BadRequestException('Updated date can\'t be greater than now.');
        }
    }




}