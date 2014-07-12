<?php


namespace AgentSIB\JsonRpcBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class NamespacesCompilerPass implements CompilerPassInterface {

    public function process (ContainerBuilder $container)
    {

        $definition = $container->getDefinition('agentsib_jsonrpc.server');

        foreach ($container->findTaggedServiceIds('jsonrpc.namespace') as $id => $attributes) {
            $class = $container->getDefinition($id)->getClass();

            $attributes = reset($attributes);
            if (empty($attributes['resource'])) {
                throw new \Exception('Empty resource');
            }

            $resource = $attributes['resource'];
            $version = isset($attributes['version'])?$attributes['version']:'v1';

            if (!preg_match('/^v[0-9]+$/', $version)) {
                $version = 'v1';
            }

            $namespace = isset($attributes['namespace'])?$attributes['namespace']:'';

            $definition->addMethodCall('addToRouting', array($resource, $namespace, $class));

        }
    }
}