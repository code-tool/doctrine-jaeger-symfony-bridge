<?php
declare(strict_types=1);

namespace Doctrine\DBAL\Jaeger\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dbal_jaeger');
        $rootNode
            ->children()
            ->scalarNode('type')->defaultValue('wrapper')->end()
            ->end();

        return $treeBuilder;
    }
}
