<?php

namespace XerviceTest\Controller;

use Xervice\Core\Locator\Locator;
use Xervice\Routing\RoutingFacade;
use Xervice\Web\Business\Plugin\PluginCollection;
use Xervice\Web\Business\Provider\RouteProvider;
use Xervice\Web\WebFacade;
use XerviceTest\Controller\Routing\TestProvider;

class IntegrationTest extends \Codeception\Test\Unit
{
    /**
     * @var \XerviceTest\XerviceTester
     */
    protected $tester;

    protected function _before()
    {
        $pluginCollection = new PluginCollection(
            [
                new TestProvider()
            ]
        );

        $routeProvider = new RouteProvider(
            $pluginCollection,
            $this->getRoutingFacade()
        );

        $routeProvider->provideRoutings();
    }

    /**
     * @group Xervice
     * @group Controller
     * @group Integration
     * @throws \Xervice\Web\Business\Exception\WebExeption
     *
     * @expectedException \Xervice\Controller\Business\Exception\ControllerException
     */
    public function testNotExistingController()
    {
        $path = '/notExistController';

        $this->getWebFacade()->executeUrl($path);
    }

    /**
     * @group Xervice
     * @group Controller
     * @group Integration
     * @throws \Xervice\Web\Business\Exception\WebExeption
     *
     * @expectedException \Xervice\Controller\Business\Exception\ControllerException
     */
    public function testNotExistingAction()
    {
        $path = '/notExists';

        $this->getWebFacade()->executeUrl($path);
    }

    /**
     * @group Xervice
     * @group Controller
     * @group Integration
     * @throws \Xervice\Web\Business\Exception\WebExeption
     */
    public function testNormalRouting()
    {
        $path = '/test';

        $output = $this->executeUrl($path);

        $this->assertEquals(
            'TestUnit',
            $output
        );
    }

    /**
     * @group Xervice
     * @group Controller
     * @group Integration
     * @throws \Xervice\Web\Business\Exception\WebExeption
     */
    public function testWithRequest()
    {
        $path = '/testWithRequest';

        $_GET['getparam'] = 'Unit';
        $_REQUEST['getparam'] = 'Unit';
        $output = $this->executeUrl($path);

        $this->assertEquals(
            'Test(Unit)',
            $output
        );
    }

    /**
     * @group Xervice
     * @group Controller
     * @group Integration
     * @throws \Xervice\Web\Business\Exception\WebExeption
     */
    public function testWithParam()
    {
        $path = '/testWithParam/TestParam';

        $output = $this->executeUrl($path);

        $this->assertEquals(
            'Test(TestParam)',
            $output
        );
    }

    /**
     * @group Xervice
     * @group Controller
     * @group Integration
     * @throws \Xervice\Web\Business\Exception\WebExeption
     */
    public function testWithStatusCodeAndHeader()
    {
        $path = '/testWithStatusCodeAndHeader';

        $output = $this->executeUrl($path);

        $this->assertEquals(
            'test',
            $output
        );
    }

    /**
     * @return \Xervice\Web\WebFacade
     */
    private function getWebFacade(): WebFacade
    {
        return Locator::getInstance()->web()->facade();
    }

    /**
     * @return \Xervice\Routing\RoutingFacade
     */
    private function getRoutingFacade(): RoutingFacade
    {
        return Locator::getInstance()->routing()->facade();
    }

    /**
     * @param $path
     *
     * @return string
     * @throws \Xervice\Web\Business\Exception\WebExeption
     */
    private function executeUrl($path): string
    {
        ob_start();
        $this->getWebFacade()->executeUrl($path);
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}