<?php
App::uses('AppController', 'Controller');
/**
 * Highscores Controller
 *
 */
class HighscoresController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->response->header('Access-Control-Allow-Origin: *');
	}

}
