<?php


namespace XerviceTest\Controller\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Xervice\Controller\Communication\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testAction(): Response
    {
        return $this->sendResponse('TestUnit');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testWithRequestAction(Request $request): Response
    {
        return $this->sendResponse(
            sprintf(
                'Test(%s)',
                $request->get('getparam')
            )
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $param
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testWithParamAction(Request $request, string $param): Response
    {
        return $this->sendResponse(
            sprintf(
                'Test(%s)',
                $param
            )
        );
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testWithStatusCodeAndHeaderAction(): Response
    {
        return $this->sendResponse(
            'test',
            501,
            [
                'TestHeader' => 'HeaderValue'
            ]
        );
    }
}