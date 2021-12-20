<?php

namespace App\Shared\Infrastructure\Messenger;

class RabbitTest
{
    public function __construct(private string $id)
    {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

}