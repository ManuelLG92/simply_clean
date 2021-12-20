<?php


namespace App\Shared\UI\HTTP\Rest\Controller;


use App\Shared\Domain\Bus\Command\CommandBusInterface;
use App\Shared\Domain\Bus\Command\CommandInterface;
use App\Shared\Domain\Bus\Query\QueryBusInterface;
use App\Shared\Domain\Bus\Query\QueryInterface;
use App\Shared\Infrastructure\Service\JsonApi\JsonApiResponseConverterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiRestController extends AbstractController
{
    public function __construct(
        private CommandBusInterface $commandBus,
        private QueryBusInterface $queryBus,
        private JsonApiResponseConverterInterface $jsonApiResponseConverter
    ) {
    }

    protected function dispatch(CommandInterface $command): void
    {
        $this->commandBus->dispatch($command);
    }

    protected function ask(QueryInterface $query): JsonResponse
    {
        $response = $this->queryBus->ask($query);
        $jsonApiResponse = $this->jsonApiResponseConverter->convert($response);

        return new JsonResponse($jsonApiResponse, Response::HTTP_OK);
    }
}