<?php

namespace App\News\Application\UseCases\Query\FindById;

use App\News\Domain\NewRepositoryInterface;
use App\News\Domain\Services\Transformers\ResponseFindByIdDTO;
use App\Shared\Domain\Exception\ResourceNotFoundException;
use App\Shared\Domain\ValueObjects\Identifier;

class FindByIdUseCase
{
    public function __construct(private NewRepositoryInterface $newRepository)
    {
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function __invoke(Identifier $id): ResponseFindByIdDTO
    {
        $new = $this->newRepository->get($id);

        if (!$new){
            throw new ResourceNotFoundException('Not found.', [], 404);
        }

        return ResponseFindByIdDTO::fromNewEntity($new);
    }
}