<?php


namespace App\Tests\IAM\Token\Domain;


use App\IAM\Token\Domain\Token;
use App\Shared\Domain\Exception\InvalidAttributeException;

final class TokenStub
{
    /**
     * @throws InvalidAttributeException
     */
    public static function fromValues(
        string $hash = null,
        string $userId = null
    ): Token
    {
        return Token::create(
            empty($hash) ? TokenHashStub::byDefault() : TokenHashStub::fromValue($hash),
            empty($userId) ? TokenUserIdStub::byDefault() : TokenUserIdStub::fromValue($userId),
        );
    }

    /**
     * @throws InvalidAttributeException
     */
    public static function byDefault(): Token
    {
        return Token::create(
            TokenHashStub::byDefault(),
            TokenUserIdStub::byDefault()
        );
    }
}