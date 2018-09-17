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

    public function __construct(ConnectionFactory $connectionFactory, TracerInterface $tracer)
    {
        $this->connectionFactory = $connectionFactory;
        $this->tracer = $tracer;
    }

    public function createConnection(
        array $params,
        Configuration $config = null,
        EventManager $eventManager = null,
        array $mappingTypes = []
    ) {
        return new JaegerConnectionDecorator(
            parent::createConnection(
                $params,
                $config,
                $eventManager,
                $mappingTypes
            ), $this->tracer
        );
    }
}
