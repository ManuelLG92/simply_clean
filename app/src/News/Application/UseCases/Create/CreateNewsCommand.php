<?php

namespace App\News\Application\UseCases\Create;

class CreateNewsCommand
{
    public function __construct(
        public readonly string $title,
        public readonly string $content)
    {

    }

}