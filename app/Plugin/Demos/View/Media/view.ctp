<div class="media view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h3><?php echo __('Media'); ?></h3>
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
			<?php echo h($media['Media']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Gallery'); ?></th>
		<td>
			<?php echo $this->Html->link($media['Gallery']['name'], array('controller' => 'galleries', 'action' => 'view', $media['Gallery']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($media['Media']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Asset File'); ?></th>
		<td>
			<?php echo h($media['Media']['asset_file']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Origin'); ?></th>
		<td>
			<?php echo h($media['Media']['origin']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sort'); ?></th>
		<td>
			<?php echo h($media['Media']['sort']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Score'); ?></th>
		<td>
			<?php echo h($media['Media']['score']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($media['Media']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($media['Media']['created']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

