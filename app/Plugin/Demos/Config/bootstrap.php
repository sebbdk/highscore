<?php
/* 
* @Author: sebb
* @Date:   2014-06-17 00:09:12
* @Last Modified by:   sebb
* @Last Modified time: 2014-06-17 00:12:10
*/

Configure::write('menu.image_index', array(
	'name' => 'All images',
	'url' => array(
		'plugin' => 'demos',
		'controller' => 'images',
		'action' => 'index'
	),
	'sort' => 100
));

Configure::write('menu.image_add', array(
	'name' => 'Create image',
	'url' => array(
		'plugin' => 'demos',
		'controller' => 'images',
		'action' => 'add'
	),
	'sort' => 200
));