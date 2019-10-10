<?php

namespace albertgeeca\language_manager\src\backend;

/**
 * backend module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'albertgeeca\language_manager\src\backend\controllers';

    /**
     * {@inheritdoc}
     */
    public $defaultRoute = 'language';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // Sets i18n
        $this->registerTranslations();
    }

    /**
     * If internationalization for this module is net set up in configuration, set it up to PhpMessageSource option
     */
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['language'] =
            \Yii::$app->i18n->translations['language'] ??
            [
                'class' => \yii\i18n\PhpMessageSource::className(),
                'sourceLanguage' => 'en-US',
                'basePath' => '@vendor/albertgeeca/yii2-language-manager/src/backend/messages'
            ];
    }
}
