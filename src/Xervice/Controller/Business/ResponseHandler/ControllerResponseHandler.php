<?php
declare(strict_types=1);


namespace Xervice\Controller\Business\ResponseHandler;


use Xervice\Controller\Business\Exception\ControllerException;
use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\Web\Business\Executor\ResponseHandler\ResponseHandlerInterface;

/**
 * @method \Xervice\Controller\ControllerFactory getFactory()
 */
class ControllerResponseHandler extends AbstractWithLocator implements ResponseHandlerInterface
{
    /**
     * @param mixed $response
     *
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Xervice\Controller\Business\Exception\ControllerException
     */
    public function handleResponse($response): void
    {
        $controllerName = $response['_controller'];
        $action = $response['_action'];

        $this->validateController($controllerName);

        $controller = new $controllerName();
        if (method_exists($controller, 'setKernel')) {
            $controller->setKernel($this->getFactory()->createKernelBridge());
        }

        $this->validateAction($controller, $action, $controllerName);

        $response = $this->cleanResponse($response);

        $this->getFactory()->createOutputProcessor()->processOutput(
            $controller->$action(
                $this->getFactory()->createSymfonyRequest(),
                ...array_values($response)
            )
        );
    }

    /**
     * @param array $response
     *
     * @return array
     */
    private function cleanResponse(array $response): array
    {
        return array_filter(
            $response,
            function ($value) {
                return $value{0} !== '_';
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * @param $controllerName
     *
     * @throws \Xervice\Controller\Business\Exception\ControllerException
     */
    private function validateController($controllerName): void
    {
        if (!class_exists($controllerName)) {
            throw new ControllerException(
                sprintf(
                    'Controller %s was not found',
                    $controllerName
                )
            );
        }
    }

    /**
     * @param $controller
     * @param $action
     * @param $controllerName
     *
     * @throws \Xervice\Controller\Business\Exception\ControllerException
     */
    private function validateAction($controller, $action, $controllerName): void
    {
        if (!method_exists($controller, $action)) {
            throw new ControllerException(
                sprintf(
                    'Method %s not found in controller %s',
                    $action,
                    $controllerName
                )
            );
        }
    }

}