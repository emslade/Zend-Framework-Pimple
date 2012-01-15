<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
	protected $container;

    protected function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
		$this->container = new Pimple;
		$resource = new Example\Application\Resource\Container(null, $this->container);
		$this->bootstrap->getBootstrap()->registerPluginResource($resource);
        parent::setUp();
    }

    public function testIndexAction()
    {
		$items = array(
			$this->createItem('test1', 'test1value'),
			$this->createItem('test2', 'test2value'),
		);

		// mock the entity repository
		$repo = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
			->disableOriginalConstructor()
			->getMock();

		$repo->expects($this->once())
			->method('findAll')
			->will($this->returnValue($items));

		// mock the entity manager
		$em = $this->getMockBuilder('Doctrine\ORM\EntityManager')
			->disableOriginalConstructor()
			->getMock();

		$em->expects($this->once())
			->method('getRepository')
			->with($this->equalTo('Application_Model_Item'))
			->will($this->returnValue($repo));

		// replace the entity manager closure in the container
		$this->container['entityManager'] = $em;

        $this->dispatch('/');
        
        $this->assertQueryContentContains("h1", "Items");
		$this->assertQueryContentContains('ul li', 'test1: test1value');
		$this->assertQueryContentContains('ul li', 'test2: test2value');
    }

	protected function createItem($name, $value)
	{
		$item = new Application_Model_Item;
		$item->setName($name);
		$item->setValue($value);
		return $item;
	}
}
