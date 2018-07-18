<?php

namespace Xervice\Controller\Business\Output;

use Symfony\Component\HttpFoundation\Response;

interface OutputProcessorInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    public function processOutput(Response $response): void;
}