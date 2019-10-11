<?php
/**
 * @var @languageModel albertgeeca\language_manager\src\common\entities\Language
 * @var @backButtonUrl - link to the previous page
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;


$form = ActiveForm::begin([
        'action' => \yii\helpers\Url::to('/language/main/save'),
        'options' => ['enctype'=>'multipart/form-data'],
]); ?>

    <div class="col-md-8">
        <?= $form->field($languageModel, 'locale', [
            'inputOptions' => ['class' => 'form-control']
        ]); ?>

        <?= $form->field($languageModel, 'name', [
            'inputOptions' => ['class' => 'form-control']
        ]); ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($languageModel, 'is_default', [
            'inputOptions' => ['class' => 'form-control']
        ])->checkbox(); ?>

        <?= $form->field($languageModel, 'is_archived', [
            'inputOptions' => ['class' => 'form-control']
        ])->checkbox(); ?>

        <div class="pull-right">
            <a href="<?=$backButtonUrl; ?>" class="btn btn-danger m-r-xs">Back</a>
            <?= HTML::submitButton(Yii::t('language', 'Save'), [
                'class' => 'btn btn-primary m-r-xs'
            ]); ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>