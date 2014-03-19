<?php
/* 
* @Author: kasperjensen
* @Date:   2014-03-19 11:23:17
* @Last Modified by:   kasperjensen
* @Last Modified time: 2014-03-19 11:31:26
*/

Router::connect('/install', array(
	'plugin' => 'install',
	'controller' => 'install',
	'action' => 'index'
));