<?php

class BackendTranslationsController extends AppController {

	public $uses = array(
		'Translations.Translation'
	);

	public $paginate = array(
		'limit' => 200
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Crud->mapAction('admin_index', 'index');
		$this->Crud->enable('admin_index');
	}

}