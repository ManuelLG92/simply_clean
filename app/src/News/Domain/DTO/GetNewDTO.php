<?php

namespace App\News\Domain\DTO;

final class GetNewDTO
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

}