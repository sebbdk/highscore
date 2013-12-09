<?php
class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('admin_login');

		if($this->action === 'admin_add') {
			if($this->User->find('count') === 0 || $this->Auth->user()) {
				$this->Crud->mapAction('admin_add', 'add');
				$this->Crud->enable('admin_add');				
				$this->Auth->allow('admin_add');
				return;
			}			
		}

		if($this->action != 'admin_login' && !$this->Auth->user() && isset($this->request->params['admin'])) {
			$this->redirect(array('action' => 'admin_login'));
		}
	}

	public function admin_index() {
		$this->Crud->executeAction('index');
	}

	public function admin_login() {
		if($this->Auth->user() !== null) {
			$this->redirect(array('action' => 'index'));
		}

		if($this->User->find('count') === 0) {
			$this->redirect(array('action' => 'add'));
		}

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}

	public function admin_logout() {
		return $this->redirect($this->Auth->logout());
	}	

}