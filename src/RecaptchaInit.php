<?php
namespace andrewdanilov\grecaptchav3;

use yii\base\Widget;

class RecaptchaInit extends Widget
{
	public $formID;
	public $action;
	public $sitekey;

	public function init()
	{
		parent::init();
		if (empty($this->sitekey)) {
			if (isset(\Yii::$app->components['recaptcha'])) {
				$this->sitekey = \Yii::$app->recaptcha->sitekey;
			}
		}
		if (empty($this->action)) {
			$this->action = \Yii::$app->controller->id . '_' . \Yii::$app->controller->action->id . '_' . $this->id;
		}
	}

	public function run()
	{
		$asset = RecaptchaAsset::register($this->getView());
		$asset->sitekey = $this->sitekey;

		$this->getView()->registerJs("grecaptcha.ready(function() {
			grecaptcha.execute('" . $this->sitekey . "', {action: '" . $this->action . "'})
				.then(function(token) {
					if (token) {
						var form = $('#" . $this->formID . "');
						form.append($('<input>', {type: 'hidden', name: 'g-recaptcha-token', value: token}));
						form.append($('<input>', {type: 'hidden', name: 'g-recaptcha-action', value: '" . $this->action . "'}));
					}
				});
		});");

		return;
	}
}