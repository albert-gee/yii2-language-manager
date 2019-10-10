<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var @languageModel albertgeeca\language_manager\src\common\entities\Language
 */
$this->title = (!empty($languageModel->id)) ? Yii::t('language', 'Update language') : Yii::t('language', 'Add new language');

?>

<div class="row">
    <div class="col-md-12">

        <h1><?= $this->title; ?></h1>

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($languageModel, 'locale', [
                    'inputOptions' => ['class' => 'form-control']
            ]); ?>

            <?= $form->field($languageModel, 'name', [
                'inputOptions' => ['class' => 'form-control']
            ]); ?>

            <?= $form->field($languageModel, 'is_default', [
                'inputOptions' => ['class' => 'form-control']
            ])->checkbox(); ?>

            <?= $form->field($languageModel, 'is_archived', [
                'inputOptions' => ['class' => 'form-control']
            ])->checkbox(); ?>

        <div class="pull-right">
            <a href="../main" class="btn btn-danger m-r-xs">Back</a>
            <?= HTML::submitButton(Yii::t('language', 'Save'), [
                'class' => 'btn btn-primary m-r-xs'
            ]); ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>