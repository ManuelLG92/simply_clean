<?php

namespace App\News\Infrastructure\Controller;

use App\News\Application\UseCases\Create\CreateNewsCommand;
use App\News\Application\UseCases\Create\CreateNewsHandler;
use App\News\Application\UseCases\GetNews\GetNewHandler;
use App\News\Application\UseCases\GetNews\GetNewQuery;
use App\News\Utils\NewsConstants;
use App\News\Utils\Normalize\NormalizeNewsBody;
use App\Shared\Domain\Exception\BadRequestException;
use App\Shared\Domain\Exception\InvalidAttributeException;
use App\Shared\Domain\Exception\ResourceNotFoundException;
use App\Shared\Domain\ValueObjects\Identifier;
use App\Shared\Infrastructure\Service\Validator\ArrayValidator;
use App\Shared\UI\HTTP\Rest\Controller\ApiRestController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetNewsController extends ApiRestController
{

    /**
     * @throws BadRequestException|InvalidAttributeException
     * @throws ResourceNotFoundException
     */
    public function __invoke(
        string                 $id,
        GetNewHandler          $getNewHandler,
        Request                $request,
        EntityManagerInterface $entityManager,
    ): JsonResponse
    {
        if (!Identifier::is($id)){
            throw new BadRequestException('Check new\'s id');
        }

        $new = $getNewHandler->__invoke(new GetNewQuery($id));

        return new JsonResponse( ['data' => $new], 201);

    }
}