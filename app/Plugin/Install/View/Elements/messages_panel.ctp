<?php
	$msgs = array_merge($msgs, $errs);

	if(count($msgs) > 0) :
?>
	<div class="panel panel-default">
		<div class="panel-heading">Install log</div>
		<div class="panel-body">
			<ul class="list-group" style="margin: 0;">
				<?php
				foreach($errs as $err) {
					echo '<li class="list-group-item error">';
						echo $err;
					echo '</li>';
				}

				foreach($msgs as $msg) {
					echo '<li class="list-group-item">';
						echo $msg;
					echo '</li>';
				}
				?>
			</ul>
		</div>
	</div>
<?php endif; ?>