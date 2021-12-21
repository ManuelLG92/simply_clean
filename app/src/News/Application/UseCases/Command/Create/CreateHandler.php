<?php

namespace App\News\Application\UseCases\Command\Create;

use App\News\Domain\ValueObjects\NewContent;
use App\News\Domain\ValueObjects\NewTitle;
use App\Shared\Domain\Exception\InvalidAttributeException;

class CreateHandler
{
    public function __construct(private CreateUseCase $createUseCase)
    {
    }

    /**
     * @throws InvalidAttributeException
     */
    public function __invoke(CreateCommand $command): bool
    {
        return $this->createUseCase->__invoke(
            new NewTitle($command->title),
            new NewContent($command->content)
        );
    }

}