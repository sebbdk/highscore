<div class="locations view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h3><?php echo __('Location'); ?></h3>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-md-12">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($location['Location']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Latitude'); ?></th>
		<td>
			<?php echo h($location['Location']['latitude']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Longitude'); ?></th>
		<td>
			<?php echo h($location['Location']['longitude']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

