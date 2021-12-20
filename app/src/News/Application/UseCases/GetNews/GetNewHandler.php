<?php

namespace App\News\Application\UseCases\GetNews;

use App\News\Domain\DTO\GetNewDTO;
use App\News\Domain\NewRepositoryInterface;
use App\News\Domain\Services\Transformers\GetNewTransformerToDTO;
use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\Exception\ResourceNotFoundException;
use App\Shared\Domain\ValueObjects\Identifier;

class GetNewHandler
{
    public function __construct(private NewRepositoryInterface $newRepository)
    {
    }

    /**
     * @throws InvalidAttributeException
     * @throws ResourceNotFoundException
     */
    public function __invoke(
        GetNewQuery $getNewQuery): GetNewDTO
    {
        $new = $this->newRepository->get(new Identifier($getNewQuery->id));

        if (!$new){
            throw new ResourceNotFoundException('Not found.', [], 404);
        }

        return  GetNewTransformerToDTO::fromNewEntity($new);

    }
}