<div class="images view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h3><?php echo __('Image'); ?></h3>
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
			<?php echo h($image['Image']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($image['Image']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Asset File'); ?></th>
		<td>
			<?php echo h($image['Image']['asset_file']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($image['Image']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($image['Image']['created']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

