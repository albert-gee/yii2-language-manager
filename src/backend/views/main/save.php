<?php

$this->title = (!empty($languageModel->id)) ? Yii::t('language', 'Update language') : Yii::t('language', 'Add new language');

?>

<div class="row">
    <div class="col-md-12">

        <h1><?= $this->title; ?></h1>

        <?= $this->render('_form', ['languageModel' => $languageModel, 'backButtonUrl' => \yii\helpers\Url::to('../main')]); ?>
    </div>
</div>