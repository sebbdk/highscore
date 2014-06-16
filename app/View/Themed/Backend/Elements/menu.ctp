<?php
	$menuItems = isset($this->request->params['admin']) ? Configure::read('adminMenu'):Configure::read('menu');
	
	if($menuItems) {
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
	} else {
		$menuItems = [];
	}
?>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<?php foreach($menuItems as $menuItem) : ?>
					<?php
						$isActive = $this->params['controller'] == $menuItem['url']['controller'] && 
									$this->action == $menuItem['url']['action'];
					?>
					<li <?= $isActive ? 'class="active"':''; ?>>
						<?= $this->Html->link($menuItem['name'], $menuItem['url']); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>



<!--


		<?php if(AuthComponent::user()) : ?>
			<div class="masthead">
				<h3 class="text-muted">Admin section</h3>
				<ul class="nav nav-justified">

				</ul>
			</div>

			<br />		
		<?php endif; ?>
-->