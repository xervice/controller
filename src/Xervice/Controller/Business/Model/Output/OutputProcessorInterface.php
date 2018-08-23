<?php
declare(strict_types=1);

namespace Xervice\Controller\Business\Model\Output;

use Symfony\Component\HttpFoundation\Response;

interface OutputProcessorInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    public function processOutput(Response $response): void;
}