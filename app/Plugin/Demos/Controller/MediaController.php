<?php
App::uses('AppController', 'Controller');

class MediaController extends AppController {

	public $paginate = [
		'limit' => 20,
		'order' => 'Media.created desc',
		'conditions' => [
			'gallery_id' => ''
		]
	];

	public function beforeFilter() {
		parent::beforeFilter();
		$this->header('Access-Control-Allow-Origin: *');
	}

	public function index() {
		if( isset($this->request->params['named']['sort']) ) {
			$sort = $this->request->params['named']['sort'];
			switch($sort) {
				case 'group_origin':
					$this->paginate = [
						'limit' => 2,
						'group' => [
							'File.origin' 
						]
					];
					break;
				default;
					break;
			}
		}
		$this->Crud->execute('index');
	}

	public function fix() {
		$Files = $this->File->find('all');
		foreach($files as $File) {
			$doupes = $this->File->find('all', [
				'conditions' => [
					'File.asset_file' => $file['File']['asset_file'],
					'NOT' => [
						'File.id' => $file['File']['id']
					]
				]
			]);

			if($doupes) {
				foreach($doupes as $doupe) {
					$this->File->delete($doupe['File']['id']);
				}
			}

			$this->File->save($file);
		}

		die('Done');
	}

}
