<?php
/* 
* @Author: kasperjensen
* @Date:   2014-03-19 11:23:17
* @Last Modified by:   kasperjensen
* @Last Modified time: 2014-03-19 11:23:46
*/

Router::connect('/install', array(
	'admin' => true,
	'prefix' => 'admin',
	'plugin' => 'install',
	'controller' => 'install',
	'action' => 'index'
));