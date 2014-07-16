<?php
/**
 * Created by PhpStorm.
 * User: ikovalenko
 * Date: 16.07.14
 * Time: 14:53
 */

namespace AgentSIB\JsonRpcBundle\Server\Reflection;


use AgentSIB\JsonRpc\Reflection\BaseJsonRpcReflection;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class JsonRpcReflection extends BaseJsonRpcReflection{

    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function getClassInstance()
    {
        $class = parent::getClassInstance();
        if ($class instanceof ContainerAwareInterface) {

            $class->setContainer($this->container);
        }

        return $class;
    }


} 