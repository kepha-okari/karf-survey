<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Groups;

/* @var $this yii\web\View */
/* @var $model backend\models\Surveys */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surveys-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'survey_name')->textInput(['maxlength' => true, 'placeholder' => "Enter the name of the survey"]) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duration')->dropDownList(
            ['morning'=>"Morning",'afternoon'=>"Afternoon",'evening'=>"Evening",'all-day'=>"All-day"],
            ['prompt'=>'Select duration of day to run the survey']
    ) ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true, 'placeholder' => "Enter notification message to go out to respondents"]) ?>

    <?= $form->field($model, 'contact_group')->dropDownList(
            ArrayHelper::map(Groups::find()->orderBy('name')->asArray()->all(),'id','name'),
            ['prompt'=>'Select a  contact group']
    ) ?>

    <?= $form->field($model, 'frequency')->dropDownList(
            ['1'=>"1",'2'=>"2",'3'=>"3",'4'=>"4"],
            ['prompt'=>'Select number of times to notify respondents per hour']
    ) ?>

    <?= $form->field($model, 'is_active')->dropDownList(
            ['1'=>"YES",'0'=>"NO"]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
