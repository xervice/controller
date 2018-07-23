<?php
declare(strict_types=1);


namespace Xervice\Controller\Business\Controller;


use Symfony\Component\HttpFoundation\Response;
use Xervice\Controller\Business\Provider\KernelBridgeInterface;
use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\Kernel\Business\Service\ServiceInterface;

abstract class AbstractController extends AbstractWithLocator
{
    /**
     * @var \Xervice\Controller\Business\Provider\KernelBridgeInterface
     */
    private $kernel;

    /**
     * @param \Xervice\Controller\Business\Provider\KernelBridgeInterface $kernel
     */
    public function setKernel(KernelBridgeInterface $kernel): void
    {
        $this->kernel = $kernel;
    }

    /**
     * @param string $serviceName
     *
     * @return \Xervice\Kernel\Business\Service\ServiceInterface
     */
    protected function getService(string $serviceName): ServiceInterface
    {
        return $this->kernel->getService($serviceName);
    }

    /**
     * @param string $content
     * @param int $status
     * @param array $header
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \InvalidArgumentException
     */
    protected function sendResponse(
        string $content,
        int $status = 200,
        array $header = []
    ): Response
    {
        return new Response(
            $content,
            $status,
            $header
        );
    }
}