<?php
declare(strict_types=1);

namespace Doctrine\DBAL\Jaeger\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dbal_jaeger');
        $treeBuilder
            ->getRootNode()
            ->children()
            ->scalarNode('type')->defaultValue('wrapper')->end()
            ->end();

        return $treeBuilder;
    }
}
