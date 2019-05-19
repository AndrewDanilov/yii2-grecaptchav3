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

	public $sitekey;

	public function init()
	{
		parent::init();
		if (empty($this->sitekey)) {
			if (isset(\Yii::$app->components['recaptcha'])) {
				$this->sitekey = \Yii::$app->recaptcha->sitekey;
			}
		}

		$this->js[] = ['https://www.google.com/recaptcha/api.js?render=' . $this->sitekey, 'position' => View::POS_HEAD];
	}
}