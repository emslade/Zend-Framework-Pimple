<?php
namespace Example\Application\Resource;

use Zend_Application_Resource_ResourceAbstract,
	Pimple;

class Container extends Zend_Application_Resource_ResourceAbstract
{
	public $_explicitType = 'container';

	protected $container;

	public function __construct($options = null)
	{
		parent::__construct($options);

		$this->container = new Pimple;
	}

	public function init() 
	{
		return $this->container;
	}
}
