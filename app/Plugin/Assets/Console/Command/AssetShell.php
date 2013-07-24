<?php
/**
 * Description
 * 
 * Copyright 2012, Nodes.dk. All Rights Reserved.
 *
 * @author Kasper Jensen <kj@nodes.dk>
 * @created 06-20-2012 01:32 AM
 */
App::uses('Shell', 'Console');

class AssetShell extends Shell {

	public $uses = array(
		'Sys.AssetFile',
	);
	
	public function startup() {
	}
	
    public function main() {
		$this->out("Hello i am Ass'et");
    }

	/**
	 * Runs OCR on all records in the database and store it as text_content
	 *
	 * @return void
	 */
	public function check(){
		$this->out("Checking asset's for actions");
		$this->AssetFile->check();
	}

}