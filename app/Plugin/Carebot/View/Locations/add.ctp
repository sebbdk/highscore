<div class="locations form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h3><?php echo __('Add Location'); ?></h3>
			</div>
		</div>
	</div>



	<div class="row">

		<div class="col-md-12">
			<?php echo $this->Form->create('Location', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('latitude', array('class' => 'form-control', 'placeholder' => 'Latitude'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('longitude', array('class' => 'form-control', 'placeholder' => 'Longitude'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
