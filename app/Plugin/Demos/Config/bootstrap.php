<?php
/* 
* @Author: sebb
* @Date:   2014-06-17 00:09:12
* @Last Modified by:   sebb
* @Last Modified time: 2014-07-03 22:13:36
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

Configure::write('menu.urlscores', array(
	'name' => 'Url scores',
	'url' => array(
		'plugin' => 'demos',
		'controller' => 'UrlScores',
		'action' => 'index'
	),
	'sort' => 200
));