<div class="galleries form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h3><?php echo __('Add Gallery'); ?></h3>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Form->create('Gallery', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('asset_preview', array('class' => 'form-control', 'placeholder' => 'Asset Preview'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('origin', array('class' => 'form-control', 'placeholder' => 'Origin'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('score', array('class' => 'form-control', 'placeholder' => 'Score'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
