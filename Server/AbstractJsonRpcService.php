<?php
/**
 * Created by PhpStorm.
 * User: ikovalenko
 * Date: 16.07.14
 * Time: 15:01
 */

namespace AgentSIB\JsonRpcBundle\Server;


use AgentSIB\JsonRpc\JsonRpcServiceInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AbstractJsonRpcService implements JsonRpcServiceInterface, ContainerAwareInterface {

    /** @var  ContainerInterface */
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}