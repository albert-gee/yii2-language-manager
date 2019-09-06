Yii2 Language Manager
=====================
Language manager for Yii2 framework. Allows to add languages that can be used in other extensions.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist albertgeeca/yii2-language-manager "*"
```

or add

```
"albertgeeca/yii2-language-manager": "*"
```

to the require section of your `composer.json` file.

Apply migrations:
```
php yii migrate --migrationPath=@vendor/albertgeeca/yii2-language-manager/src/migrations
```

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \albertgeeca\language_manager\AutoloadExample::widget(); ?>```