<?php


namespace TriLe\Authentication\Controller;


use Laminas\Authentication\AuthenticationService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Model\ViewModel;
use TriLe\Authentication\Form\Login;

class LoginController extends AbstractActionController
{
    protected $service;

    public function onDispatch(MvcEvent $e)
    {
        $this->service = $e->getApplication()->getServiceManager()->get(AuthenticationService::class);
        $this->layout('layout/login');
        return parent::onDispatch($e);
    }

    public function indexAction()
    {
        $form = new Login('LoginForm');
        $form->init();

        return new ViewModel([
            'form' => $form
        ]);
    }
}