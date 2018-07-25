<?php


namespace Xervice\Controller\Business\Provider;


use Xervice\Kernel\Business\Service\ClearServiceInterface;

class KernelBridge implements KernelBridgeInterface
{
    /**
     * @var \Xervice\Kernel\KernelFacade
     */
    private $kernelFacade;

    /**
     * KernelBridge constructor.
     *
     * @param \Xervice\Kernel\KernelFacade $kernelFacade
     */
    public function __construct(\Xervice\Kernel\KernelFacade $kernelFacade)
    {
        $this->kernelFacade = $kernelFacade;
    }

    /**
     * @param string $serviceName
     *
     * @return \Xervice\Kernel\Business\Service\ClearServiceInterface
     */
    public function getService(string $serviceName): ClearServiceInterface
    {
        return $this->kernelFacade->getService($serviceName);
    }

}