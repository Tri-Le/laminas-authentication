<?php
namespace TriLe\Authentication\Controller;


use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Model\ViewModel;
use TriLe\Authentication\Form\Login;

class LogOutController extends AbstractActionController {
	/**
	 * @var AuthenticationService
	 */
	protected $service;

	public function onDispatch(MvcEvent $e) {
		$this->service = $e->getApplication()->getServiceManager()->get(AuthenticationService::class);
		$this->layout('layout/log-in');
		return parent::onDispatch($e);
	}

	public function indexAction() {
		$this->service->clearIdentity();
		session_regenerate_id(true);
		return $this->redirect()->toRoute('home');
	}
}