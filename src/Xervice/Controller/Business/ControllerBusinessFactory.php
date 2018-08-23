<?php
declare(strict_types=1);


namespace Xervice\Controller\Business;


use Symfony\Component\HttpFoundation\Request;
use Xervice\Controller\Business\Model\Output\OutputProcessor;
use Xervice\Controller\Business\Model\Output\OutputProcessorInterface;
use Xervice\Controller\Business\Model\Provider\KernelBridge;
use Xervice\Controller\Business\Model\Provider\KernelBridgeInterface;
use Xervice\Controller\ControllerDependencyProvider;
use Xervice\Core\Business\Model\Factory\AbstractBusinessFactory;
use Xervice\Kernel\Business\KernelFacade;

class ControllerBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Xervice\Controller\Business\Model\Output\OutputProcessorInterface
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
     * @return \Xervice\Controller\Business\Model\Provider\KernelBridgeInterface
     */
    public function createKernelBridge(): KernelBridgeInterface
    {
        return new KernelBridge(
            $this->getKernelFacade()
        );
    }

    /**
     * @return \Xervice\Kernel\Business\KernelFacade
     */
    public function getKernelFacade(): KernelFacade
    {
        return $this->getDependency(ControllerDependencyProvider::KERNEL_FACADE);
    }
}