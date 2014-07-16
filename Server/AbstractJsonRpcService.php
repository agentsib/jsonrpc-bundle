<?php
/**
 * Created by PhpStorm.
 * User: ikovalenko
 * Date: 16.07.14
 * Time: 15:01
 */

namespace AgentSIB\JsonRpcBundle\Server;


use AgentSIB\JsonRpc\JsonRpcServiceInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AbstractJsonRpcService implements JsonRpcServiceInterface, ContainerAwareInterface {

    /** @var  ContainerInterface */
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Shortcut to return the Doctrine Registry service.
     *
     * @return Registry
     *
     * @throws \LogicException If DoctrineBundle is not available
     */
    public function getDoctrine()
    {
        if (!$this->container->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application.');
        }

        return $this->container->get('doctrine');
    }
}