<?php
/**
 * Description
 * 
 * Copyright 2012, Nodes.dk. All Rights Reserved.
 *
 * @author Kasper Jensen <kj@nodes.dk>
 * @created 02-12-2012 03:49 PM
 */
App::uses('AppModel', 'Model');

use \Nodes\Command;

class AssetFile extends AppModel {
	public $imageTypes = array('png', 'gif', 'tiff', 'jpg', 'jpeg');
	
	public static function url($id, $size = 'original', $slash_prepend = true) {
		$item = ClassRegistry::init('Assets.AssetFile')->find('first', array(
			'conditions' => array('AssetFile.id' => $id)
		));
	
		$url = ($slash_prepend ? DS:'').'files'.DS.'assets'.DS.
				$item['AssetFile']['folder'].DS.$size.DS.
				$item['AssetFile']['id'].'.'.$item['AssetFile']['extension'];
		
		return $url;
	}
	
	public function ensureSizeFolder($id, $size = 'original') {
		$item = ClassRegistry::init('Assets.AssetFile')->find('first', array(
			'conditions' => array('AssetFile.id' => $id)
		));
		
		$basePath = WWW_ROOT.'files'.DS.'assets';
		if(!is_dir($basePath)) {
			mkdir($basePath);
		}
		
		$folderPath = WWW_ROOT.'files'.DS.'assets'.DS.$item['AssetFile']['folder'];
		if(!is_dir($folderPath)) {
			mkdir($folderPath);
		}
		
		$sizePath = WWW_ROOT.'files'.DS.'assets'.DS.$item['AssetFile']['folder'].DS.$size;
		if(!is_dir($sizePath)) {
			mkdir($sizePath);
		}
	}
	
	public function afterFind($items, $primary = false){
		parent::afterFind($items);
		foreach($items as $index => $item ) {
			if(isset($items[$index][$this->alias])) {
				$items[$index][$this->alias]['url'] = 	DS.'files'.DS.'assets'.DS.
														$item[$this->alias]['folder'].DS.'original'.DS.
														$item[$this->alias]['id'].'.'.$item[$this->alias]['extension'];
			}
		}
		
		return $items;
	}

/**
 * Handles files being added
 *
 * the file array can be eith:
 * 	- the raw data from $_FILE['somename']
 * 	- array('file_path' => '...', 'name' => 'xyz')
 * 		^ add a local file
 * 	- array('file_download' => '...', 'name' => 'xyz')
 * 		^ fetch a file from the web
 * 
 * @todo  clean up the uplaoded files if it fails...
 * 
 * @param  array  $options save options
 * @return boolean
 */
	public function beforeSave($options = array()) {
		/**
		 * Make sure we have a folder
		 */
		if(!isset($this->data[$this->alias]['folder'])) {
			$this->data[$this->alias]['folder'] = 'default';
		}
		$folder = $this->data[$this->alias]['folder'];

		/**
		 * Set up directories
		 */
		$folder_url = WWW_ROOT.'files/assets'.DS.$folder;
		$rel_url = $folder_url.DS.'original';
		
		if(!is_dir($folder_url)) {
			mkdir($folder_url, 0777, true);
		}
		
		if(!is_dir($rel_url)) {
			mkdir($rel_url, 0777, true);
		}		

		/**
		 * if we have a file, process it and add the file data to oure data array
		 */
		if(isset($this->data[$this->alias]['file'])) {
			try {
				$file = $this->data[$this->alias]['file'];
				$id = String::uuid();
				if(isset($file['tmp_name'])) {//is uploaded file object
					$parts = explode(".", $file['name']);
					$extention = array_pop($parts);
					$url = $rel_url.'/'.$id.'.'.$extention;
					$success = move_uploaded_file($file['tmp_name'], $url);
				} else if(isset($file['file_path'])){//is file on server
					$extention = array_pop(explode(".", $file['file_path']));
					$url = $rel_url.'/'.$id.'.'.$extention;
					copy($file['file_path'], $url);
					$success = true;
				} else if(isset($file['file_download'])){
					set_time_limit(30);//give php some time to fetch the file
					$extention = array_pop(explode(".", $file['name']));
					$url = $rel_url.'/'.$id.'.'.$extention;
					file_put_contents($url, file_get_contents($file['file_download']));
					$success = true;
				}

				//merge the resulting file info into oure data
				$this->data[$this->alias] = array_merge(array(				
					'id' => $id,
					'folder' => $folder,
					'name' => $file['name'],
					'size' => filesize($url),
					'is_image' => ((in_array(strtolower($extention), $this->imageTypes)) ? 1:0),
					'extension' => $extention
				), $this->data[$this->alias]);
			} catch(Exception $e) {
				echo 'Caught exception while saving file: ',  $e->getMessage(), "\n";
			}
		}

		return true;		
	}

	public function OCRIndex($item){
		$path = 'webroot'.AssetFile::url($item[$this->alias]['id']);
		$textPath = "tmp/tesseract/data";
		
		if(!is_dir('tmp/tesseract/')) {
			mkdir('tmp/tesseract/');
		}
		
		Command::execute('tesseract '.$path.' '.$textPath.' -l eng');
		$text = file_get_contents($textPath.'.txt');
		
		$this->save(array(
			'id' => $item[$this->alias]['id'],
			'text_content' => $text
		));
	}
	
	public function unzipTmp($id, $relative = false) {
		$zipPath = realpath(WWW_ROOT.AssetFile::url($id));
		
		$base_folder = WWW_ROOT."files/tmpgal/".DS;
	    // setup dir names absolute and relative 
		$folder = explode(".", $zipPath);
		$type = array_pop($folder);
		$folder = time();
		$folder_url = $base_folder . DS . $folder;
		
		//make sure our folders are there
        if(!is_dir($base_folder)) {  
            mkdir($base_folder);  
        }
	    if(!is_dir($folder_url)) {  
	        mkdir($folder_url);  
	    }
	
		$zip = zip_open($zipPath);

		if (!is_resource($zip)) {
		  die($this->zipFileErrMsg($zip));
		}
		
		$files = array();
		$found_image = false;
		$c = 0;
		
		while ($zip_entry = zip_read($zip)) {
			
			$name = explode('/', zip_entry_name($zip_entry));
			$name = array_pop($name);
			
			$type = array_pop(explode('.', $name));
			
			if(in_array($type, array('png', 'gif', 'jpg', 'jpeg'))) {
				if(is_resource($zip_entry) && $name != "" && substr($name, 0, 2) != "._") {
					$file = $folder_url.DS.$c.'.'.$type;
					file_put_contents(
						$file, 
						zip_entry_read($zip_entry, zip_entry_filesize($zip_entry))
					);
					
					if($relative) {
						$files[] = str_replace('///', '/', array_pop(explode('webroot', $file)));
					} else {
						$files[] = 'http://'.$_SERVER['HTTP_HOST'].DS.str_replace('//', '/', array_pop(explode('webroot', $file)));
					}
				}
			}
			$c++;
		}
		zip_close($zip);
		return $files;
	}

	public function getThumbFromZip($id) {
		$zipPath = realpath(WWW_ROOT.$this->url($id));
		$base_folder = WWW_ROOT."files/tmpgal";
	    // setup dir names absolute and relative 
		$folder = explode(".", $zipPath);
		$type = array_pop($folder);
		$folder = time();
		$folder_url = $base_folder . DS . $folder;
		
		//make sure our folders are there
        if(!is_dir($base_folder)) {  
            mkdir($base_folder);  
        }
	    if(!is_dir($folder_url)) {  
	        mkdir($folder_url);  
	    }
		
		$zip = zip_open($zipPath);
		
		if (!is_resource($zip)) {
		  die($this->zipFileErrMsg($zip));
		}
		
		$files = array();
		$found_image = false;
		while ($zip_entry = zip_read($zip)) {
			$name = explode('/', zip_entry_name($zip_entry));
			$name = array_pop($name);
			
			$type = array_pop(explode('.', $name));
			
			if(in_array(strtolower($type), array('png', 'gif', 'jpg', 'jpeg'))) {
				if(is_resource($zip_entry) && $name != "" && substr($name, 0, 2) != "._") {
					$file = $folder_url.DS.(rand()*10000000).'.'.$type;
					file_put_contents(
						$file, 
						zip_entry_read($zip_entry, zip_entry_filesize($zip_entry))
					);
					
					return $file;
					break;
				}
			}
		}
		zip_close($zip);	
	}
	
	public function zipFileErrMsg($errno) {
	  // using constant name as a string to make this function PHP4 compatible
	  $zipFileFunctionsErrors = array(
	    'ZIPARCHIVE::ER_MULTIDISK' => 'Multi-disk zip archives not supported.',
	    'ZIPARCHIVE::ER_RENAME' => 'Renaming temporary file failed.',
	    'ZIPARCHIVE::ER_CLOSE' => 'Closing zip archive failed', 
	    'ZIPARCHIVE::ER_SEEK' => 'Seek error',
	    'ZIPARCHIVE::ER_READ' => 'Read error',
	    'ZIPARCHIVE::ER_WRITE' => 'Write error',
	    'ZIPARCHIVE::ER_CRC' => 'CRC error',
	    'ZIPARCHIVE::ER_ZIPCLOSED' => 'Containing zip archive was closed',
	    'ZIPARCHIVE::ER_NOENT' => 'No such file.',
	    'ZIPARCHIVE::ER_EXISTS' => 'File already exists',
	    'ZIPARCHIVE::ER_OPEN' => 'Can\'t open file', 
	    'ZIPARCHIVE::ER_TMPOPEN' => 'Failure to create temporary file.', 
	    'ZIPARCHIVE::ER_ZLIB' => 'Zlib error',
	    'ZIPARCHIVE::ER_MEMORY' => 'Memory allocation failure', 
	    'ZIPARCHIVE::ER_CHANGED' => 'Entry has been changed',
	    'ZIPARCHIVE::ER_COMPNOTSUPP' => 'Compression method not supported.', 
	    'ZIPARCHIVE::ER_EOF' => 'Premature EOF',
	    'ZIPARCHIVE::ER_INVAL' => 'Invalid argument',
	    'ZIPARCHIVE::ER_NOZIP' => 'Not a zip archive',
	    'ZIPARCHIVE::ER_INTERNAL' => 'Internal error',
	    'ZIPARCHIVE::ER_INCONS' => 'Zip archive inconsistent', 
	    'ZIPARCHIVE::ER_REMOVE' => 'Can\'t remove file',
	    'ZIPARCHIVE::ER_DELETED' => 'Entry has been deleted',
	  );
	  $errmsg = 'unknown';
	  foreach ($zipFileFunctionsErrors as $constName => $errorMessage) {
	    if (defined($constName) and constant($constName) === $errno) {
	      return 'Zip File Function error: '.$errorMessage;
	    }
	  }
	  return 'Zip File Function error: unknown';
	}

}