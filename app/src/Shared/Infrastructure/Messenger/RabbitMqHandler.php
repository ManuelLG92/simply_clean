<?php

namespace App\Shared\Infrastructure\Messenger;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RabbitMqHandler implements MessageHandlerInterface
{
    public function __invoke(RabbitTest $rabbit)
    {
        //var_dump('message dispatched', $rabbit->getId());
        sleep(5);
        echo 'processing data.' . '\nClass # ' . $rabbit->getId() .'\n';
    }
}