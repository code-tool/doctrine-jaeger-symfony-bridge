<?php
declare(strict_types=1);

namespace Doctrine\DBAL\Jaeger\Symfony\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class JaegerDbalExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('services.yaml');
        switch ($config['type']) {
            case 'wrapper':
                $container->removeDefinition('doctrine.dbal.connection_factory.decorator.jaeger');
                $container->setAlias(
                    'doctrine.dbal.connection_factory',
                    'doctrine.dbal.connection_factory.wrapper.jaeger'
                );
                break;
            case 'decorator':
                $container->removeDefinition('doctrine.dbal.connection_factory.wrapper.jaeger');
                break;
            default:
                break;
        }
    }
}
