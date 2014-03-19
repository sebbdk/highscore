<div class="panel panel-default">
	<div class="panel-heading">Check list</div>
	<div class="panel-body">
		<ul class="list-group" style="margin: 0;">
			<?php
			if (Configure::read('debug') === 0):
				echo '<li class="list-group-item">';
					echo __d('cake_dev', 'Your version of PHP is 5.2.8 or higher.');
				echo '</li>';
			else:
				echo '<li class="list-group-item warning">';
					echo __d('cake_dev', 'Debug is enabled, please disable it in app/Config/core.php for production use');
				echo '</li>';
			endif;
			?>

			<?php
			if (version_compare(PHP_VERSION, '5.2.8', '>=')):
				echo '<li class="list-group-item">';
					echo __d('cake_dev', 'Your version of PHP is 5.2.8 or higher.');
				echo '</li>';
			else:
				echo '<li class="list-group-item error">';
					echo __d('cake_dev', 'Your version of PHP is too low. You need PHP 5.2.8 or higher to use CakePHP.');
				echo '</li>';
			endif;
			?>

			<?php
				if (is_writable(TMP)):
					echo '<li class="list-group-item">';
						echo __d('cake_dev', 'Your tmp directory is writable.');
					echo '</li>';
				else:
					echo '<li class="list-group-item error">';
						echo __d('cake_dev', 'Your tmp directory is NOT writable.');
					echo '</li>';
				endif;
			?>

			<?php
				$settings = Cache::settings();
				if (!empty($settings)):
					echo '<li class="list-group-item">';
						echo __d('cake_dev', 'The %s is being used for core caching. To change the config edit APP/Config/core.php ', '<em>'. $settings['engine'] . 'Engine</em>');
					echo '</li>';
				else:
					echo '<li class="list-group-item error">';
						echo __d('cake_dev', 'Your cache is NOT working. Please check the settings in APP/Config/core.php');
					echo '</li>';
				endif;
			?>

			<?php
				$filePresent = null;
				if (file_exists(APP . 'Config' . DS . 'database.php')):
					echo '<li class="list-group-item">';
						echo __d('cake_dev', 'Your database configuration file is present.');
						$filePresent = true;
					echo '</li>';
				else:
					echo '<li class="list-group-item error">';
						echo __d('cake_dev', 'Your database configuration file is NOT present.');
						echo '<br/>';
						echo __d('cake_dev', 'Rename APP/Config/database.php.default to APP/Config/database.php');
					echo '</li>';
				endif;
			?>

			<?php
			if (isset($filePresent)):
				App::uses('ConnectionManager', 'Model');
				try {
					$connected = ConnectionManager::getDataSource('default');
				} catch (Exception $connectionError) {
					$connected = false;
					$errorMsg = $connectionError->getMessage();
					if (method_exists($connectionError, 'getAttributes')) {
						$attributes = $connectionError->getAttributes();
						if (isset($errorMsg['message'])) {
							$errorMsg .= '<br />' . $attributes['message'];
						}
					}
				}
				if ($connected && $connected->isConnected()):
					echo '<li class="list-group-item">';
			 			echo __d('cake_dev', 'Cake is able to connect to the database.');
					echo '</li>';
				else:
					echo '<li class="list-group-item error">';
						echo __d('cake_dev', 'Cake is NOT able to connect to the database.');
						echo '<br /><br />';
						echo $errorMsg;
					echo '</li>';
				endif;
			endif; 
			?>
		</ul>
	</div>
</div>