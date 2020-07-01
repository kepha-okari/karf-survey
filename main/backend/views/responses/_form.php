<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Responses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="responses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'survey_id')->textInput() ?>

    <?= $form->field($model, 'response')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
