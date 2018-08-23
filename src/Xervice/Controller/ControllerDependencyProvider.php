<?php


namespace Xervice\Controller;


use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Core\Business\Model\Dependency\Provider\AbstractDependencyProvider;
use Xervice\Core\Business\Model\Dependency\Provider\DependencyProviderInterface;

class ControllerDependencyProvider extends AbstractDependencyProvider
{
    public const KERNEL_FACADE = 'kernel.facade';

    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    public function handleDependencies(DependencyContainerInterface $container): DependencyContainerInterface
    {
        $container = $this->addKernelFacade($container);

        return $container;
    }

    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    protected function addKernelFacade(
        DependencyContainerInterface $container
    ): DependencyContainerInterface {
        $container[self::KERNEL_FACADE] = function (DependencyContainerInterface $container) {
            return $container->getLocator()->kernel()->facade();
        };

        return $container;
    }
}
