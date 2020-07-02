<?php

declare(strict_types=1);

namespace Velhron\DadataBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dadata');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('token')->end()
                ->scalarNode('secret')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
