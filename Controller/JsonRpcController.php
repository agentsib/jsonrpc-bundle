<?php


namespace AgentSIB\JsonRpcBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class JsonRpcController extends Controller{

    public function apiAction($resource, $version = 'v1') {
        /*if ($this->getRequest()->isMethod('GET')) {
            return new Response('docs '.$version);
        }*/
        return $this->container->get('agentsib_jsonrpc.server')->processResource($resource, $this->getRequest());
    }
} 