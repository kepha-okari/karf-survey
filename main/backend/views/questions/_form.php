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
            #ArrayHelper::map(Questions::find()->where(['survey_id' => 1])->orderBy('title')->asArray()->all(),'id','title'),
            ArrayHelper::map(Surveys::find()->orderBy('survey_name')->asArray()->all(),'id','survey_name'),
            ['prompt'=>'Select Survey']
        ) ?>
    <?= $form->field($model, 'survey_id')->textInput() ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'question_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pointer')->textInput() ?>

    <?= $form->field($model, 'question_number')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
