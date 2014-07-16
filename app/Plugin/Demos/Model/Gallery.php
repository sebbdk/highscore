<?php
/* 
* @Author: sebb
* @Date:   2014-07-11 19:41:00
* @Last Modified by:   sebb
* @Last Modified time: 2014-07-14 15:13:36
*/

class Gallery extends AppModel {

	public $actsAs = [
		'Assets.AssetFile'
	];

	public $hasMany = [
		'Media' => [
			'order' => 'sort ASC'
		]
	];

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
}
