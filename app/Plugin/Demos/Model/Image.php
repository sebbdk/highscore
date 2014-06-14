<?php
App::uses('AppModel', 'Model');
/**
 * Image Model
 *
 * @property AssetFile $AssetFile
 */
class Image extends AppModel {

	public $actsAs = [
		'Assets.AssetFile'
	];

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
}
