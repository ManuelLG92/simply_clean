<?php

namespace App\Shared\Infrastructure\Service\Validator;

use App\Shared\Domain\Bus\Event\InvalidDomainEventException;
use App\Shared\Domain\Exception\BadRequestException;

class ArrayValidator
{
    /**
     * @throws BadRequestException
     */
    static function associativeHasNotEmptyFields(array $associativeArray){
        foreach ($associativeArray as $key => $item) {
            !empty($item) ?: throw BadRequestException::body($key);
        }

    }
}