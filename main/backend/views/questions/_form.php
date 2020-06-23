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
            ArrayHelper::map(Surveys::find()->where(['is_active' => 1])->orderBy('survey_name')->asArray()->all(),'id','survey_name'),
            ['prompt'=>'Select an active Survey']
        ) ?>


    <?= $form->field($model, 'state')->dropDownList(
        [ 'transitional' => 'Carry On To Next Question After this ', 'end' => 'End After This Question'],
            ['prompt'=>'Select Question Status )']
    ) ?>


    <?= $form->field($model, 'question_type')->dropDownList(
        [ 'open' => 'Open', 'closed' => 'Closed'],
            ['prompt'=>'Select Question Type']
    ) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => "Type the question e.g  What is your favourite city?"]) ?>

    <?= $form->field($model, 'pointer')->textInput(['placeholder' => "Enter question number of next question e.g   3"]) ?>

    <?= $form->field($model, 'question_number')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
