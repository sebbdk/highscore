<?php

//admin menu configuration
Configure::write('adminMenu.users', array(
	'name' => 'Users',
	'url' => array(
		'plugin' => 'users',
		'controller' => 'users',
		'action' => 'admin_index'
	)
));

Configure::write('adminMenu.logout', array(
	'name' => 'Log out',
	'url' => array(
		'plugin' => 'users',
		'controller' => 'users',
		'action' => 'admin_logout',
	),
	'class' => 'logout',
	'sort' => 100
));		

//schema install configurations
Configure::write('Install.schemas.users', array(
	'plugin' => 'Users',
	'name' => 'User'
));