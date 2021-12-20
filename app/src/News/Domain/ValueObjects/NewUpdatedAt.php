<?php


namespace App\News\Domain\ValueObjects;


use App\Shared\Domain\ValueObjects\DateValueObject;

final class NewUpdatedAt extends DateValueObject
{
    public function __construct(\DateTime $value)
    {
        $this->value = $value;
    }
}