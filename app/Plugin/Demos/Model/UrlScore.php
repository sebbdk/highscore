<?php
App::uses('AppModel', 'Model');
/**
 * UrlScore Model
 *
 */
class UrlScore extends AppModel {

	public $belongsTo = [
		'Demos.Media'
	];

	public function beforeSave($options = []) {


		$media = $this->Media->find('first', [
			'conditions' => [
				'asset_file' => $this->data[$this->alias]['asset_file']
			]
		]);

		if($media) {
			$this->data[$this->alias]['media_id'] = $media['Media']['id'];
		}
	}

	public function afterSave($create, $options = []) {
		$media = $this->Media->find('first', [
			'conditions' => [
				'asset_file' => $this->data[$this->alias]['asset_file']
			]
		]);

		$scores = $this->find('all', [
			'conditions' => [
				'UrlScore.asset_file' => $this->data[$this->alias]['asset_file']
			]
		]);

		$scoreSum = 0;
		foreach($scores as $score) {
			$scoreSum += $score[$this->alias]['score'];
		}

		$media['Media']['score'] = $scoreSum;

		$this->Media->save($media);
	}

}
