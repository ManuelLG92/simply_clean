<?php

namespace App\News\Infrastructure\Controller;


use App\News\Application\UseCases\Query\FindById\FindByIdHandler;
use App\News\Application\UseCases\Query\FindById\FindByIdQuery;
use App\Shared\Domain\Exception\ResourceNotFoundException;
use App\Shared\UI\HTTP\Rest\Controller\ApiRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetNewsController extends ApiRestController
{

    /**
     * @throws ResourceNotFoundException
     */
    public function __invoke(
        string                 $id,
        FindByIdHandler        $getNewHandler,
        Request                $request,
    ): JsonResponse
    {

        $new = $getNewHandler->__invoke(new FindByIdQuery($id));

        return new JsonResponse( ['data' => $new], 201);

    }
}