<div class="highscores view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h3><?php echo __('Highscore'); ?></h3>
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
			<?php echo h($highscore['Highscore']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($highscore['Highscore']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Score'); ?></th>
		<td>
			<?php echo h($highscore['Highscore']['score']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

