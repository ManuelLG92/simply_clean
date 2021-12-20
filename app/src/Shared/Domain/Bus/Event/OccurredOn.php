<?php

namespace App\Shared\Domain\Bus\Event;

use App\Shared\Domain\ValueObjects\DateValueObject;

final class OccurredOn extends DateValueObject
{
    public function __construct(\DateTime $value)
    {
        $this->value = $value;
    }
}
