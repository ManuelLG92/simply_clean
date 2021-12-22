<?php

namespace App\News\Infrastructure\Controller;


use App\Shared\UI\HTTP\Rest\Controller\ApiRestController;
use Symfony\Component\HttpFoundation\JsonResponse;

class Home extends ApiRestController
{


    public function __invoke(): JsonResponse
    {
        return new JsonResponse( ['data' => 'home'], 201);
    }
}