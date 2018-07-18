<?php
declare(strict_types=1);


namespace Xervice\Controller\Business\Controller;


use Symfony\Component\HttpFoundation\Response;
use Xervice\Core\Locator\AbstractWithLocator;

abstract class AbstractController extends AbstractWithLocator
{
    /**
     * @param string $content
     * @param int $status
     * @param array $header
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \InvalidArgumentException
     */
    protected function sendResponse(
        string $content,
        int $status = 200,
        array $header = []
    ): Response
    {
        return new Response(
            $content,
            $status,
            $header
        );
    }
}