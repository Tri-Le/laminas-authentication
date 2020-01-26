<?php
namespace TriLe\Authentication\Controller;


use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class SuccessController extends AbstractActionController {
	public function indexAction() {
		$dest = $this->params()->fromQuery('_dest');
		if (!$dest) {
			$dest = $this->params()->fromRoute('_dest');

			if (!$dest) {
				$dest = $this->url()->fromRoute('home');
			}
		}

		return new ViewModel([
			'destination' => $dest
		]);
	}
}