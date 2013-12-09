<div style="width: 400px; margin: auto;">
	<h2>Create a admin user</h2>
	<?php 
		echo $this->Form->create('Users.User', array(
			'inputDefaults' => array(
				'label' => false,
				'div' => false,
				'class' => 'form-control'
			)
		)); 
	?>

		<div class="input-group">
		  <span class="input-group-addon">Username</span>
		  <?= $this->Form->input('username', array('placeholder' => 'Username')); ?>
		</div>
		<br />
		<div class="input-group">
		  <span class="input-group-addon">Password</span>
		  <?= $this->Form->input('password', array('placeholder' => 'Password')); ?>
		</div>
		<br />
		<button type="submit" class="btn btn-primary">Create user</button>

	<?php echo $this->Form->end(); ?>
</div>