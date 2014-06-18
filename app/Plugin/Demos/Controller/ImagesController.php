<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 * @property PaginatorComponent $Paginator
 */
class ImagesController extends AppController {

	public $paginate = [
		'limit' => 200
	];

}
