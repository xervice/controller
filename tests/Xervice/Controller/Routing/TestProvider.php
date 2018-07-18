<?php


namespace XerviceTest\Controller\Routing;


use DataProvider\RouteCollectionDataProvider;
use Xervice\Controller\Business\Route\AbstractControllerProvider;
use XerviceTest\Controller\Controller\TestController;

class TestProvider extends AbstractControllerProvider
{
    /**
     * @param \DataProvider\RouteCollectionDataProvider $dataProvider
     *
     * @return \DataProvider\RouteCollectionDataProvider
     */
    public function handleRoutes(RouteCollectionDataProvider $dataProvider): RouteCollectionDataProvider
    {
        $dataProvider->addRoute(
            $this->addController(
                '/notExists',
                TestController::class,
                'notExist',
                [
                    'GET'
                ]
            )
        );

        $dataProvider->addRoute(
            $this->addController(
                '/notExistController',
                'notExistController',
                'notExist',
                [
                    'GET'
                ]
            )
        );

        $dataProvider->addRoute(
            $this->addController(
                '/test',
                TestController::class,
                'testAction',
                [
                    'GET'
                ]
            )
        );

        $dataProvider->addRoute(
            $this->addController(
                '/testWithRequest',
                TestController::class,
                'testWithRequestAction',
                [
                    'GET'
                ]
            )
        );

        $dataProvider->addRoute(
            $this->addController(
                '/testWithParam/{param}',
                TestController::class,
                'testWithParamAction',
                [
                    'GET'
                ]
            )
        );

        $dataProvider->addRoute(
            $this->addController(
                '/testWithStatusCodeAndHeader',
                TestController::class,
                'testWithStatusCodeAndHeaderAction',
                [
                    'GET'
                ]
            )
        );

        return $dataProvider;
    }
}