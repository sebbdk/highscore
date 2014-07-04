<?php
App::uses('AppController', 'Controller');
/**
 * UrlScores Controller
 *
 */
class UrlScoresController extends AppController {

	public $paginate = [
		'order' => 'created desc'
	];

	public function beforeFilter() {
		parent::beforeFilter();
		$this->header('Access-Control-Allow-Origin: *');
	}

}
