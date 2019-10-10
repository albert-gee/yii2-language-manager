<?php
namespace albertgeeca\language_manager\src\backend\assets;

use rmrevin\yii\fontawesome\FontAwesome;
use yii\web\AssetBundle;

/**
 * Class MainAsset represents a bundle of assets which are used in each view file
 * @package albertgeeca\language_manager\src\backend\assets
 * @author Albert Gee
 */
class MainAsset extends AssetBundle
{

    public $sourcePath = '@vendor/albertgeeca/yii2-language-manager/backend/web';

    public $depends = [
        \yii\bootstrap\BootstrapAsset::class,
        FontAwesome::
    ];

}