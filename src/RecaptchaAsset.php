<?php
namespace andrewdanilov\grecaptchav3;

use yii\web\AssetBundle;

class RecaptchaAsset extends AssetBundle
{
	public $sourcePath = '@andrewdanilov/grecaptchav3/web';
	public $depends = [
		'yii\web\JqueryAsset',
	];
}