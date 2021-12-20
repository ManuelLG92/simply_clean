<?php

namespace App\News\Infrastructure\Controller;

use App\News\Application\UseCases\Create\CreateNewsCommand;
use App\News\Application\UseCases\Create\CreateNewsHandler;
use App\News\Utils\NewsConstants;
use App\News\Utils\Normalize\NormalizeNewsBody;
use App\Shared\Domain\Exception\BadRequestException;
use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Infrastructure\Service\Validator\ArrayValidator;
use App\Shared\UI\HTTP\Rest\Controller\ApiRestController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateNewsController extends ApiRestController
{

    /**
     * @throws BadRequestException
     * @throws InvalidAttributeException
     */
    public function __invoke(
        CreateNewsHandler $createNewsHandler,
        Request $request,
        EntityManagerInterface $entityManager,
    ): JsonResponse
    {

        ArrayValidator::associativeHasNotEmptyFields($request->request->all());

        $params = NormalizeNewsBody::get($request);

        $command = new CreateNewsCommand(
            $params[NewsConstants::TITLE->value],
            $params[NewsConstants::CONTENT->value]
        );

        $news = $createNewsHandler->__invoke($command);

        $entityManager->flush();

        return new JsonResponse( ['data' => $news], 201);

    }
}