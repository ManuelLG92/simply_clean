<?php

namespace App\Shared\Infrastructure\Service\Hashing;

use App\Shared\Domain\ValueObjects\HashedPassword;

interface HashingInterface
{
    public function hash(string $password): HashedPassword;
}
