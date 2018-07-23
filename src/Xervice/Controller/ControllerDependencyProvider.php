<?php


namespace Xervice\Controller;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

class ControllerDependencyProvider extends AbstractProvider
{
    public const KERNEL_FACADE = 'kernel.facade';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::KERNEL_FACADE] = function (DependencyProviderInterface $dependencyProvider) {
            return $dependencyProvider->getLocator()->kernel()->facade();
        };
    }

}