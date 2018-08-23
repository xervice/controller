<?php


namespace Xervice\Controller\Business\Model\Provider;


use Xervice\Kernel\Business\KernelFacade;
use Xervice\Kernel\Business\Plugin\ClearServiceInterface;

class KernelBridge implements KernelBridgeInterface
{
    /**
     * @var \Xervice\Kernel\Business\KernelFacade
     */
    private $kernelFacade;

    /**
     * KernelBridge constructor.
     *
     * @param \Xervice\Kernel\Business\KernelFacade $kernelFacade
     */
    public function __construct(KernelFacade $kernelFacade)
    {
        $this->kernelFacade = $kernelFacade;
    }

    /**
     * @param string $serviceName
     *
     * @return \Xervice\Kernel\Business\Plugin\ClearServiceInterface|null
     */
    public function getService(string $serviceName): ?ClearServiceInterface
    {
        return $this->kernelFacade->getService($serviceName);
    }

}