<?php


namespace App\News\Domain\ValueObjects;


use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\ValueObjects\StringValueObject;

final class NewContent extends StringValueObject
{
    public const MIN_LENGTH = 3;
    public const MAX_LENGTH = 40;

    /**
     * @throws InvalidAttributeException
     */
    public function __construct(string $value)
    {
        if (strlen($value) < self::MIN_LENGTH) {
            throw InvalidAttributeException::fromMinLength('Content', self::MIN_LENGTH);
        }

        if (strlen($value) > self::MAX_LENGTH) {
            throw InvalidAttributeException::fromMaxLength('Content', self::MAX_LENGTH);
        }

        $this->value = $value;
    }
}