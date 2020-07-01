<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SurveySessions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="survey-sessions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'survey_id')->textInput() ?>

    <?= $form->field($model, 'last_session')->textInput() ?>

    <?= $form->field($model, 'next_session')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
