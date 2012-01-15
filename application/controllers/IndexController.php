<?php
class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
		$bootstrap = $this->getInvokeArg('bootstrap');
		$container = $bootstrap->getResource('container');

		$em = $container['entityManager'];

		$this->view->items = $em->getRepository('Application_Model_Item')->findAll();
    }
}
