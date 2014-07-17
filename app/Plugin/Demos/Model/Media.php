<?php
App::uses('AppModel', 'Model');

class Media extends AppModel {

	public $useTable = "media";

	public $actsAs = [
		'Assets.AssetFile'
	];

	public $belongsTo = [
		'Gallery'
	];

	private $rowsToUpdate = null;

	public $validate = [
		'asset_file' => array(
			'rule' => 'isUnique',
			'required' => 'create'
		)
	];

	public function beforeSave($options = []) {
		$others = $this->find('all', [
			'conditions' => [
				'Media.origin' => $this->data[$this->alias]['origin'],
				'NOT' => [
					'Media.id' => isset($this->data[$this->alias]['id']) ? $this->data[$this->alias]['id']:'' 
				]
			]
		]);

		$gallery = $this->Gallery->find('first', [
			'conditions' => [
				'Gallery.origin' => $this->data[$this->alias]['origin']
			]
		]);

		if(!$gallery && !empty($others)) {			
			$name = isset($this->data[$this->alias]['galley_name']) ? $this->data[$this->alias]['galley_name']:$others[0][$this->alias]['name'];
			$this->Gallery->create();
			$this->Gallery->save([
				'name' => $name,
				'origin' => $others[0][$this->alias]['origin'],
				'asset_preview' => $others[0][$this->alias]['asset_file'],
			]);

			foreach($others as $index => $otherFile) {
				$others[$index][$this->alias]['gallery_id'] = $this->Gallery->id;
			}
			$this->rowsToUpdate = $others;

			$this->data[$this->alias]['gallery_id'] = $this->Gallery->id;
		} else if(!empty($gallery)){
			$this->data[$this->alias]['gallery_id'] = $gallery['Gallery']['id'];
		}

		return true;
	}

	public function afterSave($created, $options = []) { 
		if($this->rowsToUpdate) {
			$rows = $this->rowsToUpdate;
			$this->rowsToUpdate = null;
			$this->saveAll($rows);
		}

		if($this->data[$this->alias]['gallery_id']) {
			$gallery = $this->Gallery->find('first', [
				'conditions' => [
					'id' => $this->data[$this->alias]['gallery_id']
				]
			]);

			$scores = $this->find('all', [
				'conditions' => [
					'Media.gallery_id' => $this->data[$this->alias]['gallery_id']
				]
			]);

			$scoreSum = 0;
			foreach($scores as $score) {
				$scoreSum += $score[$this->alias]['score'];
			}

			$gallery['Gallery']['score'] = $scoreSum;
			$this->Gallery->save($gallery);
		}
	}

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
}
