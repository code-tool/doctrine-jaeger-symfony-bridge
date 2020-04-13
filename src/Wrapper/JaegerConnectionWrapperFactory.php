<?php
declare(strict_types=1);

namespace Doctrine\DBAL\Jaeger\Wrapper;

use Doctrine\Bundle\DoctrineBundle\ConnectionFactory;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Jaeger\Tracer\TracerInterface;

class JaegerConnectionWrapperFactory extends ConnectionFactory
{
    private $tracer;

    public function __construct(array $typesConfig, TracerInterface $tracer)
    {
        $this->tracer = $tracer;

        parent::__construct($typesConfig);
    }

    public function createConnection(
        array $params,
        Configuration $config = null,
        EventManager $eventManager = null,
        array $mappingTypes = []
    ) {
        $connection = parent::createConnection(
            $params,
            $config,
            $eventManager,
            $mappingTypes
        );
        if (false === $connection instanceof JaegerConnectionWrapper) {
            return $connection;
        }

        /**
         * @var JaegerConnectionWrapper $connection
         */
        return $connection->setTracer($this->tracer);
    }
}
