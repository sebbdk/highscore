<?php
/* 
* @Author: sebb
* @Date:   2014-06-14 03:38:51
* @Last Modified by:   sebb
* @Last Modified time: 2014-07-04 18:41:27
*/
App::uses('ModelBehavior', 'Model');
App::uses('String', 'Utility');
App::uses('Router', 'Routing');

class AssetFileBehavior extends ModelBehavior {

	public $assetFolder;

	public $extensionMap = [
		'image/jpeg' => 'jpg',
		'image/png' => 'png',
		'image/gif' => 'gif',
		'text/plain' => 'txt'
	];

	public function __construct() {
		$this->assetFolder = WWW_ROOT.'files/uploads';

		if(!file_exists($this->assetFolder)) {
			mkdir($this->assetFolder);
		}
	}

/**
 * Runs through the results and makes relative urls absolute.
 * 
 * @param  Model   $model
 * @param  Array  $results
 * @param  boolean $primary
 * @return Array
 */
	public function afterFind(Model $model, $results, $primary = false) {
		foreach ($results as $index => $row) {//for each result
			foreach ($row as $typeName => $type) {//for each type
				foreach ($type as $fieldName => $fieldValue) {//for each field
					if( !empty($fieldValue) && strrpos($fieldName, 'asset_') === 0  && strrpos($fieldValue, '://') === false) {
						$results[$index][$typeName][$fieldName . '_url'] = Router::url('/', true) . 'files/uploads/' . $results[$index][$typeName][$fieldName];
					} else if(strrpos($fieldName, 'asset_') === 0) {
						$results[$index][$typeName][$fieldName . '_url'] = $fieldValue;
					}
				}
			}
		}

		return $results;
	}

/**
 * Turns byte64 submitted data into files
 * 
 * @param  Model  $model
 * @param  Array $options
 * @return void
 */
	public function beforeSave(Model $model, $options = []) {
		foreach ($model->data[$model->alias] as $field => $value) {//for each result
			if(strrpos($field, 'asset_') === 0) {//if it's a asset field

				if(strrpos($value, 'data:') === 0) {//if the asset field has byte64 data

					$m = explode(':', $value);
					$m = array_pop($m);
					$r = $m = explode(';base64,', $m);
					$m = array_shift($m);
					$base64data = array_pop($r);

					if(isset($this->extensionMap[$m])) {
						$data = base64_decode($base64data);
						$name = String::uuid() . '.' . $this->extensionMap[$m];

						file_put_contents($this->assetFolder . DS . $name, $data);
						$model->data[$model->alias][$field] = $name;
					} else {
						throw new exception('Unknow mime type (' . $m . ') for asset file, please add the mime type to the extension map');
					}

				}

			}

		}
	}

	public function ensureUploadsFolderExist() {
		
		if(!is_dir($this->assetFolder)) {
			mkdir($this->assetFolder);
		}
	}

}