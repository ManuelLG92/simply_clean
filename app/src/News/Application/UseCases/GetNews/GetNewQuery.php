<?php

namespace App\News\Application\UseCases\GetNews;

class GetNewQuery
{
    public function __construct(public readonly string $id)
    {
    }

}