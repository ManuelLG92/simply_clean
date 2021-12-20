<?php

namespace App\Shared\Domain\ValueObjects;

final class HashedPassword extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
