<?php
namespace Example\Application\Resource;

use Zend_Application_Resource_ResourceAbstract,
	Doctrine\ORM\EntityManager,
	Doctrine\ORM\Tools\Setup,
	Pimple;

class Container extends Zend_Application_Resource_ResourceAbstract
{
	public $_explicitType = 'container';

	protected $container;

	public function __construct($options = null, $container = null)
	{
		parent::__construct($options);

		$this->container = $container;
	}

	public function init() 
	{
		$options = $this->getBootstrap()->getOptions();
		$db = $options['db'];

		$this->container['entityManager'] = $this->container->share(function ($c) use ($db) {
			$isDevMode = APPLICATION_ENV == 'development';

			$config = Setup::createAnnotationMetadataConfiguration(array(APPLICATION_PATH . '/models'), $isDevMode);

			return EntityManager::create($db, $config);
		});
			
		return $this->container;
	}
}
