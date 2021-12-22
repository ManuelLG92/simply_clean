<?php

namespace App\News\Infrastructure\Controller;

use App\News\Application\UseCases\Command\Create\CreateCommand;
use App\News\Application\UseCases\Command\Create\CreateHandler;
use App\News\Utils\NewsConstants;
use App\News\Utils\Normalize\NormalizeNewsBody;
use App\Shared\Domain\Exception\BadRequestException;
use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Infrastructure\Service\Validator\ArrayValidator;
use App\Shared\UI\HTTP\Rest\Controller\ApiRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateNewsController extends ApiRestController
{

    /**
     * @throws BadRequestException
     * @throws InvalidAttributeException
     */
    public function __invoke(
        CreateHandler $createHandler,
        Request       $request,
    ): JsonResponse
    {

        /* Validation and normalize params */
        ArrayValidator::associativeHasNotEmptyFields($request->request->all());

        $params = NormalizeNewsBody::get($request);
        /* Validation and normalize params */

        $command = new CreateCommand(
            $params[NewsConstants::TITLE->value],
            $params[NewsConstants::CONTENT->value]
        );

        $createHandler->__invoke($command);

        return new JsonResponse( [], 201);

    }
}