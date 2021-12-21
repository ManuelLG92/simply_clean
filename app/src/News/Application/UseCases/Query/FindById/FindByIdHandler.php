<?php

namespace App\News\Application\UseCases\Query\FindById;

use App\News\Domain\Services\Transformers\ResponseFindByIdDTO;
use App\Shared\Domain\Exception\ResourceNotFoundException;
use App\Shared\Domain\ValueObjects\Identifier;

class FindByIdHandler
{
    public function __construct(private FindByIdUseCase $findByIdUseCase)
    {
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function __invoke(FindByIdQuery $query): ResponseFindByIdDTO
    {
     return $this->findByIdUseCase->__invoke(Identifier::fromString($query->id));
    }
}