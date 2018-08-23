<?php
declare(strict_types=1);


namespace Xervice\Controller\Business\Model\Output;


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