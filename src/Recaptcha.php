<?php
namespace andrewdanilov\grecaptchav3;

use yii\base\Component;

class Recaptcha extends Component
{
	public $api_url = 'https://www.google.com/recaptcha/api/siteverify';
	public $sitekey;
	public $secret;
	public $threshold = 0.5; // from 0 to 1

	public function verify($token, $action)
	{
		$params = [
			'secret' => $this->secret,
			'response' => $token,
			'remoteip' => $_SERVER['REMOTE_ADDR'],
		];

		$ch = curl_init($this->api_url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec($ch);
		if (!empty($response)) {
			$decoded_response = json_decode($response);
			if ($decoded_response && $decoded_response->success && $decoded_response->action == $action && $decoded_response->score > $this->threshold) {
				return true;
			}
		}

		return false;
	}
}