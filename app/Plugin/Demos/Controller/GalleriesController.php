<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 * @property PaginatorComponent $Paginator
 */
class GalleriesController extends AppController {

	public $paginate = [
		'limit' => 20,
		'order' => 'created desc'
	];

	public function beforeFilter() {
		parent::beforeFilter();
		$this->header('Access-Control-Allow-Origin: *');
	}

}
