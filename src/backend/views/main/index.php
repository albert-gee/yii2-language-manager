<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var @searchModel albertgeeca\language_manager\src\common\models
 * @var $dataProvider ActiveDataProvider
 */
$this->title = Yii::t('language', 'Language manager');
\albertgeeca\language_manager\src\backend\assets\MainAsset::register($this);
?>

<?= $this->render('_form',
    [
        'languageModel' => new \albertgeeca\language_manager\src\common\entities\Language(),
        'backButtonUrl' => Url::to('/language/main')
    ]); ?>


<div class="row">
    <div class="col-md-12">

        <h1><?= $this->title; ?></h1>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id' => 'language-list',
            'emptyCell'=>'',
            'showFooter' => true,

            'columns' => [
                // CHECKBOXES
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'footer' => Html::button(
                            '<i class="glyphicon glyphicon-remove">',
                            ['id' => 'delete-rows', 'class' => 'btn btn-danger btn-sm', 'data-url' => Url::to('/language/main/delete-multiple')]),
                    'headerOptions' => ['class' => 'col-md-1 text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'footerOptions' => ['class' => 'text-center'],
                    'content' => function ($model, $key, $index, $column) {
                        $disabled = $model->is_default ? true : false;
                        return Html::checkbox($column->name, false, ['disabled' => $disabled]);
                    }
                ],

                // #
                [
                    'class' => 'yii\grid\SerialColumn',
                    'headerOptions' => ['class' => 'col-md-1 text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                ],

                // LOCALE
                [
                    'attribute' => 'locale',
                    'value' => function($model) {
                        return Html::a($model->locale, Url::toRoute(['main/save', 'id' => $model->id]));
                    },
                    'format' => 'html',
                    'headerOptions' => ['class' => 'col-md-3 text-center'],
                    'contentOptions' => ['class' => 'text-center']
                ],
                // DEFAULT
                [
                    'filter' => ["1" => "Default", "0" => "Not default"],
                    'filterInputOptions' => ['class' => 'form-control', 'prompt' => Yii::t('language', 'All')],
                    'attribute' => 'is_default',
                    'headerOptions' => ['class' => 'col-md-3 text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'format' => 'html',
                    'value' => function($model) {
                        $default = '<i class="glyphicon glyphicon-ok text-success">';
                        $notDefaultArchived = '<i class="glyphicon glyphicon-remove text-muted">';
                        $notDefault = $model->is_archived ? $notDefaultArchived : Html::a('<i class="glyphicon glyphicon-remove">', Url::toRoute(['main/switch-default', 'id' => $model->id]));
                        return $model->is_default ? $default : $notDefault;
                    }
                ],
                // ARCHIVED
                [
                    'filter' => ["1" => "Default", "0" => "Not default"],
                    'filterInputOptions' => ['class' => 'form-control', 'prompt' => Yii::t('language', 'All')],
                    'attribute' => 'is_archived',
                    'headerOptions' => ['class' => 'col-md-3 text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'format' => 'html',
                    'value' => function($model) {
                        $archivedIcon = Html::a('<i class="glyphicon glyphicon-ok">', Url::to(['main/archive', 'id' => $model->id]));
                        $unArchivedIcon = '<i class="glyphicon glyphicon-remove">';
                        $unArchivedIcon = $model->is_default ? $unArchivedIcon : Html::a($unArchivedIcon, Url::to(['main/archive', 'id' => $model->id]));

                        return $model->is_archived ? $archivedIcon: $unArchivedIcon;
                    }
                ],
                // ACTION BUTTONS
                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['class' => 'col-md-1'],
                    'contentOptions' => ['class' => 'text-center'],
                    'template' => '{save} {delete}',
                    'buttons' => [
                        'save' => function($url, $model){
                            return Html::a('<i class="glyphicon glyphicon-pencil"></i>', Url::toRoute(['main/save', 'id' => $model->id]));
                        },
                        'delete' => function($url, $model) {
                            $icon = '<i class="glyphicon glyphicon-trash"></i>';
                            $mutedIcon = '<i class="glyphicon glyphicon-trash text-muted"></i>';
                            $button = $model->is_default ? $mutedIcon : Html::a($icon, ['delete', 'id' => $model->id], [
                                'class' => '',
                                'data' => [
                                    'confirm' => 'Are you sure? You will not be able to revert this!',
                                    'method' => 'post',
                                ],
                            ]);
                            return $button;
                        }
                    ]
                ]
            ]
        ]); ?>
    </div>
</div>
