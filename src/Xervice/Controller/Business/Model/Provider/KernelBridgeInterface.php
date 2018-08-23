<?php

namespace Xervice\Controller\Business\Model\Provider;

use Xervice\Kernel\Business\Plugin\ClearServiceInterface;

interface KernelBridgeInterface
{
    /**
     * @param string $serviceName
     *
     * @return \Xervice\Kernel\Business\Plugin\ClearServiceInterface|null
     */
    public function getService(string $serviceName): ?ClearServiceInterface;
}