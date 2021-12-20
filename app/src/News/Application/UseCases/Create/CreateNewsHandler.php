<?php

namespace App\News\Application\UseCases\Create;

use App\News\Domain\DTO\NewCreatedDTO;
use App\News\Domain\NewRepositoryInterface;
use App\News\Domain\News;
use App\News\Domain\Services\Transformers\NewCreatedTransformToDTO;
use App\News\Domain\ValueObjects\NewContent;
use App\News\Domain\ValueObjects\NewTitle;
use App\Shared\Domain\Exception\BadRequestException;
use App\Shared\Domain\Exception\Exception;
use App\Shared\Domain\Exception\InvalidAttributeException;

final class CreateNewsHandler
{
    public function __construct(
        private NewRepositoryInterface $newRepository,
    )
    {
    }

    /**
     * @throws BadRequestException
     * @throws InvalidAttributeException
     */
    public function __invoke(CreateNewsCommand $command): NewCreatedDTO
    {

        $news = News::create(
            new NewTitle($command->title),
            new NewContent($command->content)
        );
        News::validate($news);
        $this->newRepository->add($news);

        return NewCreatedTransformToDTO::fromNewEntity($news);

    }



}