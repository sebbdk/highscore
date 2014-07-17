<div class="media form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h3><?php echo __('Edit Media'); ?></h3>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Form->create('Media', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('gallery_id', array('class' => 'form-control', 'placeholder' => 'Gallery Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->element('Assets.asset_file_uploader', ['field' => 'asset_file']);?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('origin', array('class' => 'form-control', 'placeholder' => 'Origin'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('sort', array('class' => 'form-control', 'placeholder' => 'Sort'));?>
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
