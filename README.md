Google recaptcha v3 tools
===================
Classes and assets for using google recaptcha v3

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-grecaptchav3 "dev-master"
```

or add

```
"andrewdanilov/yii2-grecaptchav3": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

In site config
```php
<?php
// ...
return [
	// ...
	'components' => [
		// ...
		'recaptcha' => [
			'class' => \andrewdanilov\grecaptchav3\Recaptcha::class,
			'sitekey' => 'place your sitekey here', // optional, if not set, you need to define it in widget config
			'secret' => 'place yout secret here',
		],
	],
];
```

In controller action
```php
<?php
if ($model->load(Yii::$app->request->post()) && $model->validate()) {
	$token = Yii::$app->request->post('g-recaptcha-token');
	$action = Yii::$app->request->post('g-recaptcha-action');
	if (Yii::$app->recaptcha->verify($token, $action)) {
		// ...
		// additionally you can check your action here
	} else {
		$model->addError('recaptcha', 'Recaptcha error');
	}
}
```

In view
```php
<form action="/register" method="post" id="registerForm">
	<!-- form fields -->
</form>

<?= \andrewdanilov\grecaptchav3\RecaptchaInit::widget([
	'formID' => 'registerForm',
	'action' => 'my_register_action', // optional, default is <controller_id>_<action_id>_<widget_id>
	'sitekey' => 'place your sitekey here', // optional, if you defined sitekey in component config
]) ?>
```

Widget param ___action___ must contain only chars from set [A-Za-z_] and has to be unique per form on page.