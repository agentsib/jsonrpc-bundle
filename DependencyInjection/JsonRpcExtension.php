<?php

namespace AgentSIB\JsonRpcBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;
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
                $container->setParameter('json_rpc.reflection.class', $server['reflection']);


                $definition = new DefinitionDecorator('json_rpc.server');
                $definition->addTag('json_rpc.servers', array('resource' => $id));

                foreach ($server['services'] AS $service) {
                    $definition->addMethodCall('addService', array(
                        $service['namespace'],
                        $service['class']
                    ));
                }

                $container->setDefinition(sprintf('json_rpc.server.%s', $id), $definition);

                $definition = new DefinitionDecorator('json_rpc.transport.internal');
                $definition->addTag('json_rpc.transports');
                $definition->replaceArgument(0, new Reference(sprintf('json_rpc.server.%s', $id)));

                $container->setDefinition(sprintf('json_rpc.transport.internal.%s', $id), $definition);



                $definition = new DefinitionDecorator('json_rpc.client.internal');
                $definition->addTag('json_rpc.clients.internal');
                $definition->replaceArgument(0, new Reference(sprintf('json_rpc.transport.internal.%s', $id)));

                $container->setDefinition(sprintf('json_rpc.client.internal.%s', $id), $definition);
            }
        }

    }

}
