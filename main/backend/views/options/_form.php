<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Questions;

/* @var $this yii\web\View */
/* @var $model backend\models\Options */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="options-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question_id')->dropDownList(
            #ArrayHelper::map(Questions::find()->where(['survey_id' => 1])->orderBy('title')->asArray()->all(),'id','title'),
            ArrayHelper::map(Questions::find()->orderBy('title')->asArray()->all(),'id','title'),
            ['prompt'=>'Select question']
        ) ?>

    <?= $form->field($model, 'state')->dropDownList(
        ['transitional' => 'Go to next question after this option is picked', 'end' => 'End after this option is picked'],
        ['prompt'=>'Select Option State']
    ) ?>

    <?= $form->field($model, 'choice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pointer')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
