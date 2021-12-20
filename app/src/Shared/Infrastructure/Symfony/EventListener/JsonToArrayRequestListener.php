<?php


namespace App\Shared\Infrastructure\Symfony\EventListener;

use App\Shared\Domain\Helper\Inflector;
use App\Shared\Infrastructure\Service\Serializer\SerializerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class JsonToArrayRequestListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest'
        ];
    }

    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->getMethod() === Request::METHOD_GET) {
            return;
        }

        $content = $request->getContent(false);

        if (!$this->isJson($content)) {
            return;
        }

        $content = new ParameterBag($this->deserialize($content));
        $request->request = $content;
    }

    public function onKernelRequests(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->getMethod() !== Request::METHOD_GET) {
            $content = $request->getContent(false);

            if ($this->isJson($content)) {
                $content = new ParameterBag($this->deserialize($content));
                $request->request = $content;
            }
        }
    }

    private function isJson($string): bool
    {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }

    private function deserialize(string $content): array
    {
        $data = $this->serializer->deserialize($content);

        return $this->decamelize($data);
    }

    private function decamelize(array $data): array
    {

        $newArray = [];

        foreach ($data as $index => $valueBody) {
            $value = $valueBody;

            if (is_array($valueBody)) {
                $value = self::decamelize($valueBody);
            }

            //$key = Inflector::fromCamelCaseToSnakeCase($index);
            $key = Inflector::fromSnakeCaseToCamelCase($index);

            $newArray[$key] = $value;
        }

        return $newArray;
    }
}