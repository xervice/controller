<?php
declare(strict_types=1);


namespace Xervice\Controller\Business\Model\Route;


use DataProvider\RouteDataProvider;
use Xervice\Web\Business\Dependency\Plugin\AbstractWebProviderPlugin;

abstract class AbstractControllerProvider extends AbstractWebProviderPlugin
{
    public function addController(
        string $path,
        string $controller,
        string $action,
        array $methods
    ): RouteDataProvider
    {
        $route = new RouteDataProvider();

        $route
            ->setName($controller . '::' . $action)
            ->setPath($path)
            ->setDefaults(
                [
                    '_controller' => $controller,
                    '_action' => $action
                ]
            )
            ->setMethods(
                $methods
            );

        return $route;
    }
}