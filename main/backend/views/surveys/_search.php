<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SurveySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surveys-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'survey_name') ?>

    <?= $form->field($model, 'company_name') ?>

    <?= $form->field($model, 'duration') ?>

    <?= $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'contact_group') ?>

    <?php // echo $form->field($model, 'frequency') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
