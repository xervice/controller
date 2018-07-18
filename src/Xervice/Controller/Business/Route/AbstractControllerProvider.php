<?php


namespace Xervice\Controller\Business\Route;


use DataProvider\ControllerRouteDataProvider;
use DataProvider\RouteDataProvider;
use Xervice\Web\Business\Plugin\AbstractWebProviderPlugin;

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