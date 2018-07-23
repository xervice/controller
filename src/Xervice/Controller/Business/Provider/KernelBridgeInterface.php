<?php

namespace Xervice\Controller\Business\Provider;

use Xervice\Kernel\Business\Service\ServiceInterface;

interface KernelBridgeInterface
{
    /**
     * @param string $serviceName
     *
     * @return \Xervice\Kernel\Business\Service\ServiceInterface
     */
    public function getService(string $serviceName): ServiceInterface;
}