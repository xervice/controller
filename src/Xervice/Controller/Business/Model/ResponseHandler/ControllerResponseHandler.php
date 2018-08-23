<?php
declare(strict_types=1);


namespace Xervice\Controller\Business\Model\ResponseHandler;
use Xervice\Controller\Business\Exception\ControllerException;
use Xervice\Core\Plugin\AbstractBusinessPlugin;
use Xervice\Web\Business\Model\Executor\ResponseHandler\ResponseHandlerInterface;


/**
 * @method \Xervice\Controller\Business\ControllerBusinessFactory getFactory()
 */
class ControllerResponseHandler extends AbstractBusinessPlugin implements ResponseHandlerInterface
{
    /**
     * @param mixed $response
     *
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
     * @param string $controllerName
     *
     * @throws \Xervice\Controller\Business\Exception\ControllerException
     */
    private function validateController(string $controllerName): void
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
     * @param mixed $controller
     * @param string $action
     * @param string $controllerName
     *
     * @throws \Xervice\Controller\Business\Exception\ControllerException
     */
    private function validateAction($controller, string $action, string $controllerName): void
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