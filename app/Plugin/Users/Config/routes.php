<?php
Router::connect('/admin', array(
	'admin' => true, 
	'prefix' => 'admin', 
	'plugin' => 'users',
	'controller' => 'users',
	'action' => 'login'
));

Router::connect('/admin/:plugin/:controller/:action/*', array(
	'admin' => true, 
	'prefix' => 'admin', 
	'plugin' => 'users',
	'controller' => 'users',
	'action' => 'index'
));