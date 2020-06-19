<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Surveys;

/* @var $this yii\web\View */
/* @var $model backend\models\Questions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'survey_id')->dropDownList(
            ArrayHelper::map(Surveys::find()->orderBy('survey_name')->asArray()->all(),'id','survey_name'),
            ['prompt'=>'Select Survey']
        ) ?>


    <?= $form->field($model, 'state')->dropDownList(
        [ 'transitional' => 'Transitional', 'end' => 'End'],
            ['prompt'=>'Select Question State']
    ) ?>


    <?= $form->field($model, 'question_type')->dropDownList(
        [ 'open' => 'Open', 'closed' => 'Closed'],
            ['prompt'=>'Select Question Type']
    ) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pointer')->textInput() ?>

    <?= $form->field($model, 'question_number')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
