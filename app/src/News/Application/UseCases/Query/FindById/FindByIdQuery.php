<?php

namespace App\News\Application\UseCases\Query\FindById;

class FindByIdQuery
{
    public function __construct(public readonly string $id)
    {
    }
}