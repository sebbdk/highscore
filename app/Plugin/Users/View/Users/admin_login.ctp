<?= $this->Html->css('signin'); ?>

<?= $this->Form->create('User', array('class' => 'form-signin', 'role'=>'form',  'inputDefaults' => array(
        'label' => false,
        'div' => false
    ))); ?>
	<?php echo $this->Session->flash('auth'); ?>
	<h2 class="form-signin-heading">Please sign in</h2>

	<?php 
		echo $this->Form->input('username', array(
			'class' => 'form-control', 
			'placeholder' => 'username', 
			'required', 
			'autofocus'
		));

		echo $this->Form->input('password', array(
			'class' => 'form-control', 
			'placeholder' => 'password', 
			'required', 
		));
	?>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	
<?= $this->Form->end(); ?>