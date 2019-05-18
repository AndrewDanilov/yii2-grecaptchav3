<?php
namespace andrewdanilov\grecaptchav3;

use yii\base\Widget;

class RecaptchaInit extends Widget
{
	public $formID;
	public $action;
	public $public_key;

	public function init()
	{
		parent::init();
		if (empty($this->public_key)) {
			$this->public_key = \Yii::$app->grecaptchav3->public_key;
		}
	}

	public function run()
	{
		$asset = RecaptchaAsset::register($this->getView());
		$asset->public_key = $this->public_key;

		$this->getView()->registerJs("grecaptcha.ready(function() {
			grecaptcha.execute('" . $this->public_key . "', {action: '" . $this->action . "'})
				.then(function(token) {
					if (token) {
						var form = $('#" . $this->formID . "');
						form.append($('<input>', {type: 'hidden', name: 'token', value: token}));
						form.append($('<input>', {type: 'hidden', name: 'action', value: '" . $this->action . "'}));
					}
				});
		});");

		return;
	}
}