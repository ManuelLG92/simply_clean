<?php


namespace App\Shared\Infrastructure\Bus\Event\Consumer;


use App\Shared\Domain\Bus\Event\EventBusInterface;
use App\Shared\Infrastructure\Bus\Event\Serializer\GenericDomainEvent;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;

class DatabaseEventConsumer implements EventConsumerInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private EventBusInterface $eventBus
    ) {
    }

    /**
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws Exception
     */
    public function consume(): void
    {
        $connection = $this->entityManager->getConnection();

        $events = $this->getEventsFromDB($connection);

        $eventIds = $this->process($events);

        $this->deleteEventsFromIds($eventIds, $connection);

        $this->entityManager->clear();
    }

    /**
     * @throws Exception
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    private function getEventsFromDB(Connection $connection): array
    {
        return $connection
            ->executeQuery("SELECT * FROM domain_event ORDER BY occurred_on ASC LIMIT 10")
            ->fetchAllAssociative();
    }

    private function process(array $events): array
    {
        $ids = [];

        foreach ($events as $event) {
            try {
                $event['body'] = json_decode($event['body'], true);
                $event['body']['id'] = $event['aggregate_id'];
                $event = GenericDomainEvent::fromData($event);

                $this->eventBus->dispatch($event);

                $ids[] = $event->id();
            } catch (\Exception $exception) {}
        }

        return $ids;
    }

    /**
     * @throws Exception
     */
    private function deleteEventsFromIds(array $eventIds, Connection $connection): void
    {
        if (!empty($eventIds)) {
            $connection->executeQuery("DELETE FROM domain_event WHERE id IN (".$this->implode($eventIds).")");
        }
    }

    private function implode(array $eventIds): string
    {
        return implode(",", array_map(function($id) {
            return "'$id'";
        }, $eventIds));
    }
}