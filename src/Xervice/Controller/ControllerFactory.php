<?php
declare(strict_types=1);


namespace Xervice\Controller;


use Symfony\Component\HttpFoundation\Request;
use Xervice\Controller\Business\Output\OutputProcessor;
use Xervice\Controller\Business\Output\OutputProcessorInterface;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \Xervice\Controller\ControllerConfig getConfig()
 */
class ControllerFactory extends AbstractFactory
{
    /**
     * @return \Xervice\Controller\Business\Output\OutputProcessorInterface
     */
    public function createOutputProcessor(): OutputProcessorInterface
    {
        return new OutputProcessor();
    }
    
    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function createSymfonyRequest(): Request
    {
        return Request::createFromGlobals();
    }
}