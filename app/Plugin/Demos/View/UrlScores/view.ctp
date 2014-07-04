<div class="urlScores view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h3><?php echo __('Url Score'); ?></h3>
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
			<?php echo h($urlScore['UrlScore']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Asset File'); ?></th>
		<td>
			<?php echo h($urlScore['UrlScore']['asset_file']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Score'); ?></th>
		<td>
			<?php echo h($urlScore['UrlScore']['score']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($urlScore['UrlScore']['created']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

