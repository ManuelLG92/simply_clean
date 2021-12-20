<?php

declare(strict_types=1);


namespace App\Shared\Infrastructure\Symfony\EventListener;

use App\Shared\Domain\Exception\Exception;
use App\Shared\Domain\Helper\Inflector;
use App\Shared\Domain\Helper\Reflection;
use App\Shared\Infrastructure\Symfony\Validator\ValidationCommandException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Throwable;

final class ApiExceptionListener
{
    public function __construct(private ApiExceptionsHttpStatusCodeMapping $exceptionHandler)
    {
    }

    public function onException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $arrayResponse = [
            'code'    => $this->exceptionCodeFor($exception),
            'message' => $exception->getMessage(),
        ];

        if($exception instanceof ValidationCommandException)
        {
            $arrayResponse['violations'] = $exception->getMessages();
        }

        $event->setResponse(
            new JsonResponse(
                $arrayResponse,
                $this->exceptionHandler->statusCodeFor(get_class($exception))
            )
        );
    }

    private function exceptionCodeFor(Throwable $error): string
    {
        $domainErrorClass = Exception::class;

        return $error instanceof $domainErrorClass
            ? (string) $error->getCode()
            : Inflector::fromCamelCaseToSnakeCase(Reflection::className(get_class($error)));
    }

}