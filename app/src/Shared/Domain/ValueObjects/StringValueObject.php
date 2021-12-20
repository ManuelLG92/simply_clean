<?php


namespace App\Shared\Domain\ValueObjects;


abstract class StringValueObject
{
    protected string $value;

    abstract protected function __construct(string $value);

    public function equals(self $stringValueObject)
    {
        return $this->value() === $stringValueObject->value();
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    static function fromDate(\DateTime $dateTime, string $format = DateValueObject::DATE_FORMAT_FULL_ES): string
    {
        return $dateTime->format($format);
    }
}