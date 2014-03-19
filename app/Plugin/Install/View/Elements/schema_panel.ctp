<div class="panel panel-default">
	<div class="panel-heading">Prepare application</div>
	<div class="panel-body">
		<?php echo $this->Form->create('install', array('method' => 'post', 'url' => array('controller' => 'install', 'action' => 'index'))); ?>
			<?php echo  $this->Form->submit('Install!', array('class' => 'btn btn-primary')); ?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>