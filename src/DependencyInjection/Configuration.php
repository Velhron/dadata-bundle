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
                ->scalarNode('base_general_url')->defaultValue('https://dadata.ru/api/v2')->end()
                ->scalarNode('base_cleaner_url')->defaultValue('https://cleaner.dadata.ru/api/v1/clean')->end()
                ->scalarNode('base_suggestions_url')->defaultValue('https://suggestions.dadata.ru/suggestions/api/4_1/rs')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
