<?php

namespace App\Shared\Domain\Criteria;

use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\ValueObjects\StringValueObject;

final class FilterValue extends StringValueObject
{
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw InvalidAttributeException::fromEmpty('Filter value');
        }

        $this->value = $value;
    }
}
