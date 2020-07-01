<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SurveySessionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="survey-sessions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'survey_id') ?>

    <?= $form->field($model, 'session_name') ?>

    <?= $form->field($model, 'start_time') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'inserted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
