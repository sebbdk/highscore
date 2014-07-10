<?php
	App::uses('AuthComponent', 'Controller/Component');

	//sort menu items
	$menuItems = array();
	if(Configure::read('adminMenu')) {
		$menuItems = Configure::read('adminMenu');

		usort($menuItems, function($a, $b) {
			if(!isset($a['sort'])) {
				return 0;
			}

			if(!isset($b['sort']) || $a['sort'] > $b['sort']) {
				return 1;
			} else {
				return 0;
			}
		});
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Backend</title>

	<meta id="Viewport" name="viewport" width="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');

		echo $this->Html->css('screen');
		echo $this->Html->css('/js/vendor/fancybox/source/jquery.fancybox');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Montserrat');
		echo $this->fetch('css');

		echo $this->Html->script([
			'vendor/jquery/dist/jquery.min',
			'vendor/fancybox/source/jquery.fancybox',
			'dropdown',
			'backend',
			'vendor/bootstrap.min'
		]);

		echo $this->fetch('script');
	?>

	<style type="text/css" media="screen">
		.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
			vertical-align: middle;
		}
	</style>	
	
</head>
<body>
	<?= $this->element('menu'); ?>

	<div class="container load">	
		<?= $this->Session->flash(); ?>

		<?= $this->fetch('content'); ?>		
	</div>

    <div class="sticky-footer">
    	<div class="container">
    		Cakebox was made by sebb.dk
    	</div>
		<?php //echo $this->element('sql_dump'); ?>
	</div>	
</body>
</html>