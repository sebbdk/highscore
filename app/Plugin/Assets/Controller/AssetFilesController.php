<?php
/**
 * Description
 * 
 * Copyright 2012, Nodes.dk. All Rights Reserved.
 *
 * @author Kasper Jensen <kj@nodes.dk>
 * @created 02-14-2012 06:24 PM
 */
class AssetFilesController extends AppController {
	
	public $cacheDir = 'imagecache'; // relative to 'img'.DS
	
	public $uses = array(
		'Assets.AssetFile'
	);
	
	public $paginate = array(
		'order' => 'created desc'
	);
	
	public function beforeFilter() {
		parent::beforeFilter();
		if($this->Auth) {
			$this->Auth->allow('resize');


			if(in_array($this->Auth->user('role'), array('admin', 'user'))) {
				$this->Auth->allow('add');
				$this->Auth->allow('index');
				$this->Auth->allow('edit');
				$this->Auth->allow('view');
			}
		}
	}
	
	public function admin_view($id){
		$this->data = $this->AssetFile->read(null, $id);
	}
	
	public function admin_add($id = null){
		$this->layout = 'upload';
		
		$data = null;
		
		$id = (isset($id) && isset($this->request->params['pass'][2])) ? $id:@$this->request->params['pass'][2];
		
		if($id != null){
			$data = $this->AssetFile->find('first', array(
				'conditions' => array(
					'id' => $id
					)
				));
		}
		
		if($this->request->is('post')){
			if(isset($this->data['AssetFile']['file'])) {
				$file = $this->data['AssetFile']['file'];
			}
			
			if(isset($this->data['AssetFile']['file_download'])) {
				$file = array(
					'file_download' => $this->data['AssetFile']['file_download'],
					'name' => time().(rand()*100).'.zip'
					);
			}
			
			$folder = (!empty($this->data['AssetFile']['folder'])) ? $this->data['AssetFile']['folder']:'unsorted';
			$data = $this->AssetFile->add($folder, $file);
		}
		
		$this->set('data', $data);
		
	//	$this->render('admin_form');
	}
	
	public function admin_ocr($id){
		$data = $this->AssetFile->ocr($id);
		debug($data);
		die();
	}	
	
	/** 
	   * Automatically resizes an image and returns formatted IMG tag 
	   * 
	   * @param string $path Path to the image file, relative to the webroot/img/ directory. 
	   * @param integer $width Image of returned image 
	   * @param integer $height Height of returned image 
	   * @param boolean $aspect Maintain aspect ratio (default: true) 
	   * @param array    $htmlAttributes Array of HTML attributes. 
	   * @param boolean $return Wheter this method should return a value or output it. This overrides AUTO_OUTPUT.
	   * @return mixed    Either string or echos the value, depends on AUTO_OUTPUT and $return. 
	   * @access public 
	   */ 
	//$path, $width, $height, $aspect = true, $htmlAttributes = array(), $return = false
	function resize() { 
		$file_name = $this->request->params['file_name'];
		$file = explode('.', $file_name);
		$extension = $file[1];
		$id = $file[0];
		$size = $this->request->params['size'];

		$width = Configure::read('Assets.sizes.'.$size.'.width');
		$height = Configure::read('Assets.sizes.'.$size.'.height');
		
		$original_path = $this->AssetFile->url($id, 'original', false);
		$new_path = $this->AssetFile->url($id, $size, false);
		
		$assetFolder = WWW_ROOT.DS.'files/assets';
		if(!is_dir($assetFolder)) {
			mkdir($assetFolder);
		}
		
		$this->AssetFile->ensureSizeFolder($id, $size);
		
		$aspect = true;
		
	    $types = array(1 => "gif", "jpeg", "png", "swf", "psd", "wbmp"); // used to determine image type 

	    $fullpath = WWW_ROOT; 
	    $url = $fullpath.$original_path; 
	    $url = str_replace('//', '/', $url);

	    if (!($size = getimagesize($url)))  
	      return; // image doesn't exist  

	    if ($aspect) { // adjust to aspect. 
	      if (($size[1]/$height) > ($size[0]/$width))  // $size[0]:width, [1]:height, [2]:type 
	      $width = ceil(($size[0]/$size[1]) * $height); 
	      else 
	      	$height = ceil($width / ($size[0]/$size[1])); 
	  } 

	    $relfile = $new_path; // relative file 
	    $cachefile = $fullpath.$new_path;  // location on server 

	    if (file_exists($cachefile)) { 
	    	$csize = getimagesize($cachefile); 
	      $cached = ($csize[0] == $width && $csize[1] == $height); // image is cached 
	      if (@filemtime($cachefile) < @filemtime($url)) // check if up to date 
	      $cached = false; 
	  } else { 
	  	$cached = false; 
	  } 

	  if (!$cached) { 
	  	$image = call_user_func('imagecreatefrom'.$types[$size[2]], $url); 
	  	if (function_exists("imagecreatetruecolor") && ($temp = imagecreatetruecolor ($width, $height))) { 
	  		imagecopyresampled ($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]); 
	  	} else { 
	  		$temp = imagecreatetruecolor ($width, $height); 
	  		imagecopyresampled ($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]); 
	  	} 
	  	call_user_func("image".$types[$size[2]], $temp, $cachefile); 
	  	imagedestroy ($image); 
	  	imagedestroy ($temp); 
	  }

	  $this->redirect(DS.$relfile);
	}
	
}