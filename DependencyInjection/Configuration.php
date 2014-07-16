<?php

namespace AgentSIB\JsonRpcBundle\DependencyInjection;

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
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('json_rpc');

        $rootNode
            ->children()
                ->arrayNode('servers')->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('serializer')->cannotBeEmpty()->defaultValue('AgentSIB\\JsonRpcBundle\\Server\\Serializers\\JsonRpcSerializer')->end()
                            ->arrayNode('services')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('namespace')->defaultValue('')->end()
                                        ->scalarNode('class')->cannotBeEmpty()->isRequired()->end()
                                        ->integerNode('version')->defaultValue(1)->min(1)->end()
                                    ->end()
                                ->end()
                            ->end()

                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
