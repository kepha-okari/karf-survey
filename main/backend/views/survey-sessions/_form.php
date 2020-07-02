<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Surveys;
/* @var $this yii\web\View */
/* @var $model backend\models\SurveySessions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="survey-sessions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'survey_id')->dropDownList(
            ArrayHelper::map(Surveys::find()->where(['is_active' => 1])->orderBy('survey_name')->asArray()->all(),'id','survey_name'),
            ['prompt'=>'Select an active Survey']
    ) ?>

    <?= $form->field($model, 'session_name')->textInput(['maxlength' => true, 'placeholder' => "Enter name of the survey"]) ?>

    <?= $form->field($model, 'start_time')->textInput( ['placeholder' => "Enter starting time (YYYY-MM-DD hh:mm:ss)"]) ?>

    <?= $form->field($model, 'status')->dropDownList(
            ['1'=>"ACTIVE",'0'=>"INACTIVE"]
    ) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
