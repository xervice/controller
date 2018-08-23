<?php
declare(strict_types=1);


namespace Xervice\Controller\Communication\Controller;


use Symfony\Component\HttpFoundation\Response;
use Xervice\Controller\Business\Model\Provider\KernelBridgeInterface;
use Xervice\Core\Plugin\AbstractCommunicationPlugin;
use Xervice\Kernel\Business\Plugin\ClearServiceInterface;

abstract class AbstractController extends AbstractCommunicationPlugin
{
    /**
     * @var \Xervice\Controller\Business\Model\Provider\KernelBridgeInterface
     */
    private $kernel;

    /**
     * @param \Xervice\Controller\Business\Model\Provider\KernelBridgeInterface $kernel
     */
    public function setKernel(KernelBridgeInterface $kernel): void
    {
        $this->kernel = $kernel;
    }

    /**
     * @param string $serviceName
     *
     * @return \Xervice\Kernel\Business\Plugin\ClearServiceInterface|null
     */
    protected function getService(string $serviceName): ?ClearServiceInterface
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