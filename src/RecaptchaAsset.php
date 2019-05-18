<?php
namespace andrewdanilov\grecaptchav3;

use yii\web\AssetBundle;
use yii\web\View;

class RecaptchaAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $js = [];
	public $depends = [
		'yii\web\JqueryAsset',
	];

	public $public_key;

	public function init()
	{
		parent::init();
		if (empty($this->public_key)) {
			$this->public_key = \Yii::$app->grecaptchav3->public_key;
		}
		$this->js[] = ['https://www.google.com/recaptcha/api.js?render=' . $this->public_key, 'position' => View::POS_HEAD];
	}
}