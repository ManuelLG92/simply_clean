<?php

namespace App\Shared\Domain\Exception;

class BadRequestException extends Exception
{
    public function __construct($text = 'Bad Requested', array $parameters = [], int $code = 400, \Throwable $previous = null)
    {
        parent::__construct($text, $parameters, $code, $previous);
    }
    public static function body(string $attribute): self
    {
        return new static('Bad Request. %attribute% must not be empty.', ['%attribute%' => $attribute]);
    }
}
