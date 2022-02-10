<?php
declare(strict_types=1);

namespace Doctrine\DBAL\Jaeger\Decorator;

use Doctrine\Bundle\DoctrineBundle\ConnectionFactory;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Jaeger\Tracer\TracerInterface;

class JaegerConnectionFactoryDecorator extends ConnectionFactory
{
    private $connectionFactory;

    private $tracer;

    /**
     * @var int|null
     */
    private $maxSqlLength;

    public function __construct(ConnectionFactory $connectionFactory, TracerInterface $tracer, ?int $maxSqlLength = null)
    {
        $this->connectionFactory = $connectionFactory;
        $this->tracer = $tracer;
        $this->maxSqlLength = $maxSqlLength;

        parent::__construct([]);
    }

    public function createConnection(
        array $params,
        Configuration $config = null,
        EventManager $eventManager = null,
        array $mappingTypes = []
    ) {
        return new JaegerConnectionDecorator(
            $this->connectionFactory->createConnection(
                $params,
                $config,
                $eventManager,
                $mappingTypes
            ),
            $this->tracer,
            $this->maxSqlLength
        );
    }
}
