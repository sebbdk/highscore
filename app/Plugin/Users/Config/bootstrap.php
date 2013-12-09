<?php
/*
	Configure::write('adminMenu.users', array(
		'name' => 'users',
		'url' => array(
			'plugin' => 'users',
			'controller' => 'users',
			'action' => 'admin_index'
		)
	));
*/
	Configure::write('adminMenu.logout', array(
		'name' => 'Log out',
		'url' => array(
			'plugin' => 'users',
			'controller' => 'users',
			'action' => 'admin_logout',
		),
		'sort' => 100
	));		

?>