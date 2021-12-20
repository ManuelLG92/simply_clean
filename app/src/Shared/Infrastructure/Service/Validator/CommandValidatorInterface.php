<?php

declare(strict_types=1);


namespace App\Shared\Infrastructure\Service\Validator;

interface CommandValidatorInterface
{
    public function validate(array $data): void;
}