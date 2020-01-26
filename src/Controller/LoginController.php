<?php
namespace TriLe\Authentication\Controller;


use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Model\ViewModel;
use TriLe\Authentication\Form\Login;

class LoginController extends AbstractActionController {
	/**
	 * @var AuthenticationService
	 */
	protected $service;

	public function onDispatch(MvcEvent $e) {
		$this->service = $e->getApplication()->getServiceManager()->get(AuthenticationService::class);
		$this->layout('layout/login');
		return parent::onDispatch($e);
	}

	public function indexAction() {
		$form = new Login('LoginForm');
		$form->init();

		if($this->getRequest()->isPost()) {
			if ($form->setData($_POST)->isValid()) {
				$data = $form->getData();
				$adapter = $this->service->getAdapter();
				$adapter->setIdentity($data['Email'])->setCredential($data['Password']);
				$result = $this->service->authenticate();

				if ($result->isValid()) {
					return $this->redirect()->toRoute('login/success');
				}
			}
		}

		return new ViewModel([
			'form' => $form
		]);
	}

	public function successAction() {
		return new ViewModel();
	}
}