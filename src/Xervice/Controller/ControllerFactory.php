<?php
declare(strict_types=1);


namespace Xervice\Controller;


use Symfony\Component\HttpFoundation\Request;
use Xervice\Controller\Business\Output\OutputProcessor;
use Xervice\Controller\Business\Output\OutputProcessorInterface;
use Xervice\Controller\Business\Provider\KernelBridge;
use Xervice\Controller\Business\Provider\KernelBridgeInterface;
use Xervice\Core\Factory\AbstractFactory;
use Xervice\Kernel\KernelFacade;

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

    /**
     * @return \Xervice\Controller\Business\Provider\KernelBridgeInterface
     */
    public function createKernelBridge(): KernelBridgeInterface
    {
        return new KernelBridge(
            $this->getKernelFacade()
        );
    }

    /**
     * @return \Xervice\Kernel\KernelFacade
     */
    public function getKernelFacade(): KernelFacade
    {
        return $this->getDependency(ControllerDependencyProvider::KERNEL_FACADE);
    }
}