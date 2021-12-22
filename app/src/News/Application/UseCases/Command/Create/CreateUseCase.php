<?php

namespace App\News\Application\UseCases\Command\Create;

use App\News\Domain\NewRepositoryInterface;
use App\News\Domain\News;
use App\News\Domain\ValueObjects\NewContent;
use App\News\Domain\ValueObjects\NewTitle;
use App\Shared\Domain\Exception\InvalidAttributeException;

class CreateUseCase
{
    public function __construct(private NewRepositoryInterface $newRepository)
    {
    }

    /**
     * @throws InvalidAttributeException
     */
    public function __invoke(NewTitle $title, NewContent $content): bool
    {
        $news = News::create($title,$content);
        $this->newRepository->add($news);
        $this->newRepository->flush();

        //return something or ACK
        return true;
    }
}