<?php
/* 
* @Author: sebb
* @Date:   2014-06-14 03:38:51
* @Last Modified by:   sebb
* @Last Modified time: 2014-06-14 21:07:37
*/
App::uses('ModelBehavior', 'Model');
App::uses('String', 'Utility');
App::uses('Router', 'Routing');

class AssetFileBehavior extends ModelBehavior {

	public $assetFolder;

	public $extensionMap = [
		'image/jpeg' => 'jpg',
		'image/png' => 'png',
		'image/gif' => 'gif'
	];

	public function __construct() {
		$this->assetFolder = WWW_ROOT.'files/uploads';
	}

	public function beforeSave(Model $model, $options = []) {
		if(isset($model->data[$model->alias]['asset_file'])) {
			if(strrpos($model->data[$model->alias]['asset_file'], 'data:') === 0) {
				$m = explode(':', $model->data[$model->alias]['asset_file']);
				$m = array_pop($m);
				$r = $m = explode(';base64,', $m);
				$m = array_shift($m);
				$base64data = array_pop($r);

				if(isset($this->extensionMap[$m])) {
					$data = base64_decode($base64data);
					$name = String::uuid() . '.' . $this->extensionMap[$m];

					file_put_contents($this->assetFolder . DS . $name, $data);
					$model->data[$model->alias]['asset_file'] = $name;
				} else {
					throw new exception('Unknow mime type for asset file, please add the mime type to the extension map');
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