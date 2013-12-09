<?php
$paths = App::path('Vendor', 'Facebook');
require_once($paths[0] . DS . 'facebook' . DS . 'src' . DS . 'facebook.php');

class FacebookComponent extends Component {

	public $facebook;
	public $signedRequest;

	function __construct($arg01, $args) {
		Configure::write('Facebook', $args);
		parent::__construct($arg01, $args);
	}

	public function initialize(Controller $controller) {
		//setup the facebook API
		$this->facebook = new Facebook(array(
			'appId' => Configure::read('Facebook.app_id'),
			'secret' => Configure::read('Facebook.app_secret')
		));	

		//decode the signed request
		$this->decodeSignedRequest();

		//@TODO, should i cache the signed request?!

		//handle deeplinking
		if(Configure::read('Facebook.app_data.redirect') !== null) {
			$controller->redirect(Configure::read('Facebook.app_data.redirect'));
		}
	}

	private function decodeSignedRequest() {
		$this->signedRequest = $this->facebook->getSignedRequest();

		if($this->signedRequest !== null) {
			if(isset($this->signedRequest['app_data'])) {
				$this->signedRequest['app_data'] = json_decode(urldecode($this->signedRequest['app_data']), true); 
			}

			Configure::write('Facebook', array_merge(Configure::read('Facebook'), $this->signedRequest));
		}
	}

}