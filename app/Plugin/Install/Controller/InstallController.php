<?php
/* 
* @Author: kasperjensen
* @Date:   2014-03-19 11:17:45
* @Last Modified by:   kasperjensen
* @Last Modified time: 2014-03-19 13:48:51
*/
App::uses('CakeSchema', 'Model');

class InstallController extends AppController {

	public $uses = false;

	protected $messages = array();
	protected $errors = array();

	public function beforeFilter() {
		$this->theme = 'Backend';
		parent::beforeFilter();
	}

	public function index() {
		if($this->request->is('post')) {
			$this->install();
			$this->Session->setFlash(__('The app was set up, see the log below.'));
		}

		$this->set('msgs', $this->messages);
		$this->set('errs', $this->errors);
	}

	protected function install() {

		$drop = $create = array();

		foreach(Configure::read('Install.schemas') as $index => $schemaInfo) {
			$name = $path = $connection = $plugin = $file = null;
			$schemaInfo = array_merge(compact('name', 'path', 'file', 'connection', 'plugin'), $schemaInfo);

			$schema = new CakeSchema($schemaInfo);
			$db = ConnectionManager::getDataSource($schema->connection);

			$schema = $schema->load();

			foreach ($schema->tables as $table => $fields) {
				$drop[$table] = $db->dropSchema($schema, $table);
				$create[$table] = $db->createSchema($schema, $table);
			}

			$this->_run($create, 'create', $schema);
		}

		if (empty($drop) || empty($create)) {
			echo __d('cake_console', 'Schema is up to date.');
			die();
		}
	}

	protected function out($msg) {
		$this->messages[] = $msg;
	}

	protected function err($err) {
		$this->errors[] = $err;
	}

/**
 * Runs sql from _create() or _update()
 *
 * @param array $contents
 * @param string $event
 * @param CakeSchema $Schema
 * @return void
 */
	protected function _run($contents, $event, CakeSchema $Schema) {
		if (empty($contents)) {
			$this->err(__d('cake_console', 'Sql could not be run'));
			return;
		}
		Configure::write('debug', 2);
		$db = ConnectionManager::getDataSource($Schema->connection);

		foreach ($contents as $table => $sql) {
			if (empty($sql)) {
				$this->out(__d('cake_console', '%s is up to date.', $table));
			} else {
				if ($this->_dry === true) {
					$this->out(__d('cake_console', 'Dry run for %s :', $table));
					$this->out($sql);
				} else {
					if (!$Schema->before(array($event => $table))) {
						return false;
					}
					$error = null;
					try {
						$db->execute($sql);
					} catch (PDOException $e) {
						$error = $table . ': ' . $e->getMessage();
					}

					$Schema->after(array($event => $table, 'errors' => $error));

					if (!empty($error)) {
						$this->err($error);
					} else {
						$this->out(__d('cake_console', '%s updated.', $table));
					}
				}
			}
		}
	}



}