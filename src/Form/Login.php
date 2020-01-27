<?php
namespace TriLe\Authentication\Form;


use Laminas\Validator\EmailAddress;
use Laminas\Validator\NotEmpty;

class Login extends \Laminas\Form\Form {
	public function init() {
		parent::init();

		$this->add([
			'type' => 'submit',
			'name' => 'LoginButton',
			'attributes' => [
				'id' => 'log-in-button',
				'value' => 'Login'
			]
		])->add([
			'type' => 'csrf',
			'name' => 'csrf',
			'options' => [
				'csrf_options' => [
					'lifetime' => 3600
				]
			]
		])->add([
			'type' => 'email',
			'name' => 'Email',
			'attributes' => [
				'id' => 'email',
				'maxlength' => 255,
				'placeholder' => 'Email'
			],
			'options' => [
				'label' => 'Email'
			]
		])->add([
			'type' => 'password',
			'name' => 'Password',
			'attributes' => [
				'id' => 'password',
				'maxlength' => 255,
				'placeholder' => 'Password'
			],
			'options' => [
				'label' => 'Password'
			]
		])->getInputFilter()->add([
			'filters' => [

			],
			'validators' => [
				['name' => NotEmpty::class],
				['name' => EmailAddress::class]
			]
		],
			'Email')->add([
			'filters' => [],
			'validators' => [
				['name' => NotEmpty::class],
			]
		],
			'Password');
	}

}