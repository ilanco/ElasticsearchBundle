<?php

namespace IC\ElasticsearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ic_elasticsearch');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('hosts')
                    ->prototype('scalar')->end()
                    ->defaultValue(array(
                        "localhost:9200"
                    ))
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
