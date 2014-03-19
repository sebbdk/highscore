<?php
App::uses('AppModel', 'Model');
App::uses('AssetFile', 'Assets.Model');
include_once(App::pluginPath('Assets').'Model/AssetFile.php');

Configure::write('Assets.sizes.admin_100x100', array(
	'width' => 100,
	'height' => 100,
));

Configure::write('Assets.sizes.admin_248x300', array(
	'width' => 248,
	'height' => 300,
));

//schema install configurations
Configure::write('Install.schemas.assets', array(
	'plugin' => 'Assets',
	'name' => 'Asset'
));