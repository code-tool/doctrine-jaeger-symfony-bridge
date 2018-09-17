<?php
declare(strict_types=1);

namespace Doctrine\DBAL\Jaeger\Symfony\DependencyInjection;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class JaegerDbalBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new JaegerDbalExtension();
    }
}
