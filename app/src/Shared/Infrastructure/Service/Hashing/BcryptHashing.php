<?php

namespace App\Shared\Infrastructure\Service\Hashing;

use App\Shared\Domain\ValueObjects\HashedPassword;

final class BcryptHashing implements HashingInterface
{
    public function hash(string $password): HashedPassword
    {
        if (empty($password)) {
            return '';
        }

        return HashedPassword::fromString(password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]));
    }
}
