<?php


namespace Xervice\Controller\Business\Output;


use Symfony\Component\HttpFoundation\Response;

class OutputProcessor implements OutputProcessorInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    public function processOutput(Response $response): void
    {
        $response->send();
    }
}