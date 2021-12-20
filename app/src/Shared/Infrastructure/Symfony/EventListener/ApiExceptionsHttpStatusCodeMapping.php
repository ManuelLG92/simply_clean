<?php

declare(strict_types=1);


namespace App\Shared\Infrastructure\Symfony\EventListener;

use App\Shared\Domain\Exception\BadRequestException;
use App\Shared\Infrastructure\Bus\Command\Middleware\Exception\ResourceAlreadyExistsException;
use App\Shared\Infrastructure\Symfony\Validator\ValidationCommandException;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ApiExceptionsHttpStatusCodeMapping
{
    private const DEFAULT_STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;
    private array $exceptions = [
        InvalidArgumentException::class => Response::HTTP_BAD_REQUEST,
        NotFoundHttpException::class    => Response::HTTP_NOT_FOUND,
        ResourceAlreadyExistsException::class => Response::HTTP_BAD_REQUEST,
        BadRequestException::class => Response::HTTP_BAD_REQUEST,
        ValidationCommandException::class => Response::HTTP_UNPROCESSABLE_ENTITY
    ];

    public function register(string $exceptionClass, int $statusCode): void
    {
        $this->exceptions[$exceptionClass] = $statusCode;
    }

    public function statusCodeFor(string $exceptionClass): int
    {
        $statusCode = self::DEFAULT_STATUS_CODE;

        if(isset($this->exceptions[$exceptionClass]))
        {
            $statusCode = $this->exceptions[$exceptionClass];
        }


        return $statusCode;
    }
}
