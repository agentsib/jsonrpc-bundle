<?php

namespace AgentSIB\JsonRpcBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class JsonRpcExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (array_key_exists('servers', $config)) {
            foreach ($config['servers'] AS $id => $server) {

                $container->setParameter('json_rpc.serializer.class', $server['serializer']);

                $definition = $container->findDefinition('json_rpc.server');
                foreach ($server['methods'] AS $method) {
                    $definition->addMethodCall('addService', array(
                        $method['namespace'],
                        $method['class']
                    ));
                }
            }
        }

    }

}
