<table class="table table-striped">
	<thead>
		<tr>
			<th>Users</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($users as $user) : ?>
			<tr>
				<td><?= $user['User']['username']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>