<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Surveys;


/* @var $this yii\web\View */
/* @var $model backend\models\Groups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="groups-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'survey_id')->dropDownList(
            ArrayHelper::map(Surveys::find()->where(['is_active' => 1])->orderBy('survey_name')->asArray()->all(),'id','survey_name'),
            ['prompt'=>'Select an active Survey']
    ) ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
