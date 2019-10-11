<?php
namespace albertgeeca\language_manager\src\backend\assets;

/**
 * Class MainAsset represents a bundle of assets which are used in each view file
 * @package albertgeeca\language_manager\src\backend\assets
 * @author Albert Gee
 */
class MainAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@vendor/albertgeeca/yii2-language-manager/src/backend/web';

    public $css = [];

    public $js = [
        'js/script.js'
    ];

    public $depends = [
        \yii\bootstrap\BootstrapAsset::class,
        \yii\web\JqueryAsset::class,
    ];

}