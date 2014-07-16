<?php

namespace AgentSIB\JsonRpcBundle;

use AgentSIB\JsonRpcBundle\DependencyInjection\Compiler\NamespacesCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class JsonRpcBundle extends Bundle
{
    public function build (ContainerBuilder $container)
    {
        $container->addCompilerPass(new NamespacesCompilerPass());
    }


}
