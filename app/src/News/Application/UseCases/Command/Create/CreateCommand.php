<?php

namespace App\News\Application\UseCases\Command\Create;

class CreateCommand
{
    public function __construct(
        public readonly string $title,
        public readonly string $content)
    {
    }

}