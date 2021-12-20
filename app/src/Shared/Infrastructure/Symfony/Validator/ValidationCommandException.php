<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Validator;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidationCommandException extends \Exception
{
    private const ERROR_CODE_NOT_EXPOSE = '7703c766-b5d5-4cef-ace7-ae0dd82304e9';

    private ConstraintViolationListInterface $violations;

    public function __construct(ConstraintViolationListInterface $violations)
    {
        $this->violations = $violations;
        parent::__construct('Validation failed', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function getMessages(): array
    {
        $messages = [];

        /** @var ConstraintViolation $constraint */
        foreach ($this->violations as $constraint) {

            if($constraint->getCode() === self::ERROR_CODE_NOT_EXPOSE)
            {
                continue;
            }

            $messages[] = [
                'propertyPath' =>  str_replace(['[',']'],[''],$constraint->getPropertyPath()),
                'message' => $constraint->getMessage()
            ];
        }

        return $messages;
    }
}