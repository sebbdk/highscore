<hr />

<div class="btn-group">
	<?= $this->Html->link('Extract texts', array('action' => 'extract'), array('class' => 'btn btn-warning')); ?>
</div>

<hr />

<table class="table table-striped">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('key'); ?></th>
			<th><?= $this->Paginator->sort('value'); ?></th>
			<th><?= $this->Paginator->sort('locale'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($backendTranslations as $translation) : ?>
			<tr>
				<td><?= $translation['Translation']['key']; ?></td>
				<td><?= $translation['Translation']['value']; ?></td>
				<td><?= $translation['Translation']['locale']; ?></td>
			</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php

	echo $this->Paginator->numbers();

?>